<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('order_number')->unique();
            $table->string('invoice_number')->unique();
            $table->string('status')->default('Pending');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->string('delivery_status')->default('processing');

            // Financial Summary
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping_fee', 10, 2);
            $table->decimal('discount_applied', 10, 2)->default(0.00);
            $table->decimal('total_order_amount', 10, 2);
            $table->decimal('shipping_paid', 10, 2)->default(0.00);
            $table->decimal('amount_due_on_delivery', 10, 2)->default(0.00);

            // Shipping Addr Snapshots
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');

            $table->string('promo_used')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
