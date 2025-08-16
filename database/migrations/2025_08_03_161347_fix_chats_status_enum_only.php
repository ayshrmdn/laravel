<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update status enum to include 'active' option
        DB::statement("ALTER TABLE chats MODIFY COLUMN status ENUM('active', 'closed', 'waiting') DEFAULT 'waiting'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum
        DB::statement("ALTER TABLE chats MODIFY COLUMN status ENUM('open', 'closed', 'waiting') DEFAULT 'waiting'");
    }
};
