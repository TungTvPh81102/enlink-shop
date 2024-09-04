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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->enum('type', [\App\Models\Coupon::TYPE_PERCENT, \App\Models\Coupon::TYPE_FIXED])
                ->default(\App\Models\Coupon::TYPE_PERCENT);
            $table->double('value');
            $table->double('max_discount_percentage')->nullable()->default(0);
            $table->double('min_order_total')->nullable()->default(0);
            $table->integer('max_uses')->nullable();
            $table->boolean('status')->default(1);
            $table->date('expire_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
