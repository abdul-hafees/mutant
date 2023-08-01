<?php

use App\Enums\PaymentStatus;
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
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('order_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('coupon_code')->nullable();
            $table->double('total_tax_amount')->default(0.0)->nullable();
            $table->double('delivery_fee')->default(0.0)->nullable();
            $table->double('coupon_discount_amount')->default(0.0)->nullable();
            $table->double('sub_total')->default(0.0)->nullable();
            $table->double('total_amount')->default(0.0)->nullable();
            $table->string('payment_status')->default(PaymentStatus::PENDING())->nullable();
            $table->foreignId('delivery_address_id')->nullable()->constrained('delivery_addresses')->cascadeOnDelete();
            $table->string('razorpay_order_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
