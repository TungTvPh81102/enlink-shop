<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->boolean('is_ship_user_same_user')->default(1);
            $table->string('ship_user_name')->nullable();
            $table->string('ship_user_email')->nullable();
            $table->string('ship_user_phone')->nullable();
            $table->enum('payment_method', [\App\Models\Order::PAYMENT_METHOD_COD, \App\Models\Order::PAYMENT_METHOD_VNPAY])
                ->default(\App\Models\Order::PAYMENT_METHOD_COD);
            $table->boolean('status_delivery')->default(1);
            $table->boolean('payment_status')->default(0);
            $table->double('total_price');
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
