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
            $table->string('base_name')->nullable();
            $table->string('variant_name')->nullable();
            $table->double('price')->nullable();
            $table->double('discount_price')->nullable();
            $table->double('tax')->nullable();
            $table->integer('available_stock_qty')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_display')->nullable();
            $table->boolean('is_available')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->foreignId('sub_category_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
