<?php

namespace App\Jobs;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAdminMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $chatId;
    public string $messageText;

    public int $tries = 1;

    public function __construct(int $chatId, string $messageText)
    {
        $this->chatId = $chatId;
        $this->messageText = $messageText;
    }

    public function handle(): void
    {
        $chat = Chat::find($this->chatId);
        if (!$chat) {
            return;
        }

        Message::create([
            'chat_id' => $chat->id,
            'sender_type' => 'admin',
            'sender_id' => null,
            'message' => $this->messageText,
            'type' => 'text',
            'is_read' => false,
        ]);

        $chat->update(['last_message_at' => now()]);
    }
}