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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->string('title')->nullable(); // Chat subject/title
            $table->enum('status', ['active', 'closed', 'waiting'])->default('waiting');
            $table->timestamp('last_message_at')->nullable();
            $table->boolean('has_unread_admin')->default(false); // Unread for admin
            $table->boolean('has_unread_user')->default(false); // Unread for user
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
