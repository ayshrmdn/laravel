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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_url'); // Game thumbnail/icon
            $table->string('banner_url')->nullable(); // Large banner image
            $table->foreignId('provider_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['slot', 'live_casino', 'sports', 'lottery', 'arcade', 'poker', 'crash_game'])->default('slot');
            $table->decimal('min_bet', 10, 2)->default(0.10);
            $table->decimal('max_bet', 15, 2)->default(10000.00);
            $table->decimal('rtp', 5, 2)->nullable(); // Return to Player percentage
            $table->json('features')->nullable(); // Game features like free spins, bonus rounds, etc
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->string('game_url')->nullable(); // External game URL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
