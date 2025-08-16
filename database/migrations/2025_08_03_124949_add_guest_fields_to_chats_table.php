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
        Schema::table('chats', function (Blueprint $table) {
            // Only add fields that don't exist yet
            if (!Schema::hasColumn('chats', 'guest_name')) {
                $table->string('guest_name')->nullable()->after('admin_id');
            }
            if (!Schema::hasColumn('chats', 'guest_email')) {
                $table->string('guest_email')->nullable()->after('guest_name');
            }
            if (!Schema::hasColumn('chats', 'subject')) {
                $table->string('subject')->nullable()->after('guest_email');
            }
            if (!Schema::hasColumn('chats', 'status')) {
                $table->string('status')->default('open')->after('subject');
            }
            if (!Schema::hasColumn('chats', 'priority')) {
                $table->string('priority')->default('medium')->after('status');
            }
            if (!Schema::hasColumn('chats', 'last_message_at')) {
                $table->timestamp('last_message_at')->nullable()->after('priority');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn([
                'admin_id',
                'guest_name', 
                'guest_email',
                'subject',
                'status',
                'priority',
                'last_message_at'
            ]);
        });
    }
};
