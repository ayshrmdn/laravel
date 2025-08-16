<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Chat;
use App\Models\Message;

class LiveChatController extends Controller
{
    public function index()
    {
        return view('live-chat.index');
    }

    public function startGuestChat(Request $request)
    {
        try {
            $request->validate([
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|email|max:255', 
                'issue_description' => 'required|string|max:1000',
            ]);

            // Check if there's already an active chat for this guest
            $existingChat = Chat::where('guest_email', $request->guest_email)
                ->where('status', 'active')
                ->where('created_at', '>=', now()->subHours(24)) // Only check chats from last 24 hours
                ->first();

            if ($existingChat) {
                // Return existing chat session
                return response()->json([
                    'success' => true,
                    'chat_id' => $existingChat->id,
                    'message' => 'Sesi chat yang sudah ada telah dipulihkan',
                    'existing_session' => true
                ]);
            }

            // Create new chat record
            $chat = Chat::create([
                'user_id' => null,
                'guest_name' => $request->guest_name,
                'guest_email' => $request->guest_email,
                'status' => 'active',
                'last_message_at' => now()
            ]);

            // Create initial message with issue description
            Message::create([
                'chat_id' => $chat->id,
                'sender_type' => 'guest',
                'sender_id' => null,
                'message' => "Masalah: " . $request->issue_description,
                'type' => 'text',
                'is_read' => false
            ]);

            // Store session data
            Session::put('guest_chat_session', [
                'chat_id' => $chat->id,
                'name' => $request->guest_name,
                'email' => $request->guest_email,
            ]);

            return response()->json([
                'success' => true,
                'chat_id' => $chat->id,
                'message' => 'Sesi chat berhasil dimulai'
            ]);

        } catch (\Exception $e) {
            Log::error('Error starting guest chat: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Gagal memulai sesi chat'
            ], 500);
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000',
                'session_id' => 'required',
            ]);

            // Get chat ID
            $chatId = $request->session_id;
            
            // Find chat
            $chat = Chat::find($chatId);
            if (!$chat) {
                return response()->json(['error' => 'Chat tidak ditemukan'], 404);
            }

            // Create message
            $message = Message::create([
                'chat_id' => $chat->id,
                'sender_type' => 'guest',
                'sender_id' => null,
                'message' => $request->message,
                'type' => 'text',
                'is_read' => false
            ]);

            // Update chat timestamp
            $chat->update([
                'last_message_at' => now(),
                'status' => 'active'
            ]);

            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_type' => 'guest',
                    'sender_name' => $chat->guest_name ?? 'Tamu',
                    'timestamp' => $message->created_at->toISOString(),
                    'created_at' => $message->created_at,
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending message: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Gagal mengirim pesan'
            ], 500);
        }
    }

    public function getMessages($sessionId)
    {
        try {
            // Find chat
            $chat = Chat::find($sessionId);
            if (!$chat) {
                return response()->json(['error' => 'Chat tidak ditemukan'], 404);
            }

            // Get messages
            $messages = Message::where('chat_id', $chat->id)
                ->orderBy('created_at', 'asc')
                ->get()
                ->map(function ($message) use ($chat) {
                    return [
                        'id' => $message->id,
                        'message' => $message->message,
                        'sender_type' => $message->sender_type === 'admin' ? 'admin' : 'guest',
                        'sender_name' => $message->sender_type === 'admin' 
                            ? 'Admin Dukungan' 
                            : ($chat->guest_name ?? 'Tamu'),
                        'timestamp' => $message->created_at->toISOString(),
                        'created_at' => $message->created_at,
                    ];
                });

            return response()->json([
                'success' => true,
                'messages' => $messages
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting messages: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Gagal mengambil pesan'
            ], 500);
        }
    }
}
