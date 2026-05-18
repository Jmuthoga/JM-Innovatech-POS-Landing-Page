<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // ADD ONLY ONCE (NO DUPLICATES)

            $table->string('first_name')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('first_name');

            $table->string('phone')->nullable()->after('email');

            // Stage 2 Fields
            $table->text('address')->nullable();
            $table->string('town')->nullable();
            $table->string('county')->nullable();

            // Billing
            $table->text('billing_address')->nullable();
            $table->string('billing_town')->nullable();
            $table->string('billing_county')->nullable();

            // Shipping
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_email')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_town')->nullable();
            $table->string('shipping_county')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'first_name',
                'last_name',
                'phone',
                'address',
                'town',
                'county',
                'billing_address',
                'billing_town',
                'billing_county',
                'shipping_name',
                'shipping_phone',
                'shipping_email',
                'shipping_address',
                'shipping_town',
                'shipping_county'
            ]);
        });
    }
};