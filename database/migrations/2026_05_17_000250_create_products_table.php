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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('features')->nullable();
            $table->decimal('new_price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('image');
            $table->json('thumbnails')->nullable();
            $table->json('variants')->nullable(); 
            $table->timestamp('flash_sale_ends')->nullable();

            // UI Placement Flags
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_pos_equipment')->default(false);
            $table->boolean('is_supply_item')->default(false);
            $table->boolean('is_toner')->default(false);

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
