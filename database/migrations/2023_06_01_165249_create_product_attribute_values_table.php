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
        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->cascadeOnDelete();

            $table->foreignId('attribute_id')
                ->nullable()
                ->constrained('attributes')
                ->cascadeOnDelete();

            $table->foreignId('attribute_value_id')
                ->nullable()
                ->constrained('attribute_values')
                ->cascadeOnDelete();

            $table->foreignId('base_product_id')
                ->nullable()
                ->constrained('products')
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_values');
    }
};
