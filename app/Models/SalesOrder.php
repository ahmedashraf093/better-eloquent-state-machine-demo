<?php

namespace App\Models;

use App\StateMachines\StatusStateMachine;
use Ashraf\EloquentStateMachine\Traits\HasStateMachines;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{

    use HasFactory, HasStateMachines;

    protected $fillable = [
        'user_id',
        'total_amount',
        'shipping_address',
        'billing_address',
        'payment_method',
    ];

    /**
     *  mark the `status` to be controlled by `StatusStateMachine`
     */
    public $stateMachines = [
        'status' => StatusStateMachine::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
