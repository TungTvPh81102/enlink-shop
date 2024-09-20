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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('message');
            $table->text('response')->nullable();
            $table->boolean('response_status')->default(0);
            $table->enum('status', [\App\Models\Contact::STATUS_PENDING, \App\Models\Contact::STATUS_RESOLVED, \App\Models\Contact::STATUS_IN_PROGRESS])
                ->default(\App\Models\Contact::STATUS_PENDING);
            $table->timestamp('response_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
