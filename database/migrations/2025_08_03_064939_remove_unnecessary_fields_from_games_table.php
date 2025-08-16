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
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'banner_url',
                'min_bet',
                'max_bet',
                'rtp',
                'features'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug');
            $table->string('banner_url')->nullable()->after('image_url');
            $table->decimal('min_bet', 10, 2)->default(0.10)->after('category_id');
            $table->decimal('max_bet', 15, 2)->default(10000.00)->after('min_bet');
            $table->decimal('rtp', 5, 2)->nullable()->after('max_bet');
            $table->json('features')->nullable()->after('rtp');
        });
    }
};
