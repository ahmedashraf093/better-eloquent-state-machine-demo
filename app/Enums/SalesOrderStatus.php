<?php

namespace App\Enums;


enum SalesOrderStatus: string
{

    case pending = 'pending';
    case processing = 'processing';
    case completed = 'completed';
    case declined = 'declined';
    case refunded = 'refunded';


    /**
     * Get all statues statuses.
     *
     * @return array<string>
     */
    public static function toArray(): array
    {
        return array_column(SalesOrderStatus::cases(), 'value');
    }
}
