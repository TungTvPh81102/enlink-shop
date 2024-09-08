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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Order::class)->constrained();
            $table->foreignIdFor(\App\Models\ProductVariant::class)->constrained();
            $table->integer('quantity');
            $table->string('product_name');
            $table->string('product_sku');
            $table->string('product_image_thumbnail')->nullable();
            $table->decimal('product_price_regular', 10, 2);
            $table->decimal('product_price_sale', 10, 2)->nullable();
            $table->string('variant_size_name');
            $table->string('variant_color_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
