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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->foreignIdFor(\App\Models\Brand::class)->constrained();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->double('price_regular')->nullable();
            $table->double('price_sale')->default(0)->nullable();
            $table->string('thumbnail_image');
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('view')->default(0)->nullable();
            $table->enum('product_type', [\App\Models\Product::PRODUCT_TYPE_HOME, \App\Models\Product::PRODUCT_TYPE_HOT, \App\Models\Product::PRODUCT_TYPE_NEW])
                ->nullable()->default(\App\Models\Product::PRODUCT_TYPE_NEW);
            $table->enum('status',[\App\Models\Product::STATUS_DRAFT, \App\Models\Product::STATUS_PENDING, \App\Models\Product::STATUS_PUBLISH])
                ->default(\App\Models\Product::STATUS_DRAFT);
            $table->softDeletes();
            $table->fullText('name');
            $table->timestamps();
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
