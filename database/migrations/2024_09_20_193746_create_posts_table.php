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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\BlogCategories::class)->constrained();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->text('content');
            $table->bigInteger('views')->default(0);
            $table->enum('status', [\App\Models\Post::STATUS_PENDING, \App\Models\Post::STATUS_DRAFT, \App\Models\Post::STATUS_PUBLISHED])
                ->default(\App\Models\Post::STATUS_PENDING);
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
