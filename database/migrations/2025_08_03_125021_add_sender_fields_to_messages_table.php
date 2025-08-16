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
        Schema::table('messages', function (Blueprint $table) {
            // Only add fields that don't exist yet
            if (!Schema::hasColumn('messages', 'sender_type')) {
                $table->string('sender_type')->after('chat_id'); // 'user', 'admin', 'system'
            }
            if (!Schema::hasColumn('messages', 'sender_id')) {
                $table->unsignedBigInteger('sender_id')->nullable()->after('sender_type');
            }
            if (!Schema::hasColumn('messages', 'type')) {
                $table->string('type')->default('text')->after('message'); // 'text', 'file', 'image'
            }
            if (!Schema::hasColumn('messages', 'file_path')) {
                $table->string('file_path')->nullable()->after('type');
            }
            if (!Schema::hasColumn('messages', 'file_name')) {
                $table->string('file_name')->nullable()->after('file_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('admin_id')->nullable();
            
            $table->dropColumn([
                'sender_type',
                'sender_id', 
                'type',
                'file_path',
                'file_name'
            ]);
        });
    }
};
