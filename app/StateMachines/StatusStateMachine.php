<?php

namespace App\StateMachines;

use App\Enums\SalesOrderStatus;
use Ashraf\EloquentStateMachine\StateMachines\StateMachine;

class StatusStateMachine extends StateMachine
{
    public function recordHistory(): bool
    {
        return true;
    }

    public function transitions(): array
    {
        return [
            "*" => [
                SalesOrderStatus::pending->value,
            ],

            SalesOrderStatus::pending->value => [
                SalesOrderStatus::processing->value => fn ($model, $who) => $model->created_at->diffInDays(now()) < 1,
                SalesOrderStatus::declined->value => fn ($model, $who) =>  $who != null && $who->tableName() === 'users' && $model->user_id === $who->id,
            ],

            SalesOrderStatus::processing->value => [
                SalesOrderStatus::completed->value => fn ($model, $who) => true,
                SalesOrderStatus::declined->value => fn ($model, $who) => true,
            ],

            SalesOrderStatus::completed->value => [
                SalesOrderStatus::refunded->value => fn ($model, $who) => true,
            ],

            SalesOrderStatus::declined->value => [
                SalesOrderStatus::pending->value => fn ($model, $who) => $model->created_at->diffInDays(now()) < 7,
            ],
        ];
    }

    public function defaultState(): ?string
    {
        return SalesOrderStatus::pending->value;
    }
}
