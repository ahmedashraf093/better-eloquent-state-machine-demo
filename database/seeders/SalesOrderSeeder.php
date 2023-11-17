<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SalesOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sales_orders')->insert([
            'user_id' => 1,
            'total_amount' => 100,
            'shipping_address' => 'shipping address',
            'billing_address' => 'billing address',
            'payment_method' => 'cod',
        ]);

        DB::table('sales_orders')->insert([
            'user_id' => 1,
            'total_amount' => 100,
            'shipping_address' => 'shipping address',
            'billing_address' => 'billing address',
            'payment_method' => 'cod',
        ]);

        DB::table('sales_orders')->insert([
            'user_id' => 1,
            'total_amount' => 100,
            'shipping_address' => 'shipping address',
            'billing_address' => 'billing address',
            'payment_method' => 'cod',
        ]);
    }
}
