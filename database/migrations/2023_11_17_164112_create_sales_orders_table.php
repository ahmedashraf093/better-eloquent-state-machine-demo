<?php

use App\Enums\SalesOrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            # have user id as foreign key to users table
            $table->foreignId('user_id')->constrained();
            # status of the order
            $table->enum('status', SalesOrderStatus::toArray())->default(SalesOrderStatus::pending->value);
            # total amount of the order
            $table->decimal('total_amount', 10, 2);
            # shipping address
            $table->string('shipping_address');
            # billing address
            $table->string('billing_address');
            # payment method
            $table->enum('payment_method', ['cod', 'paypal'])->default('cod');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
