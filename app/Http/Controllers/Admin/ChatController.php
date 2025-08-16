<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with(['user', 'messages' => function($query) {
            $query->latest()->limit(1);
        }])
        ->whereHas('messages')
        ->orderBy('last_message_at', 'desc')
        ->get();

        return view('admin.chat.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        $messages = $chat->messages()
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) use ($chat) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_type' => $message->sender_type,
                    'sender_id' => $message->sender_id,
                    'admin_id' => $message->sender_type === 'admin' ? $message->sender_id : null,
                    'user' => $chat->user ? $chat->user : (object) [
                        'id' => null,
                        'full_name' => $chat->guest_name ?? 'Guest User',
                        'username' => 'guest',
                        'is_online' => false
                    ],
                    'created_at' => $message->created_at,
                    'is_read' => $message->is_read,
                ];
            });

        // Mark messages as read
        $chat->messages()
            ->where('is_read', false)
            ->where('sender_type', '!=', 'admin')
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json([
            'chat' => [
                'id' => $chat->id,
                'user' => $chat->user ? $chat->user : (object) [
                    'id' => null,
                    'full_name' => $chat->guest_name ?? 'Guest User',
                    'username' => 'guest',
                    'is_online' => false,
                    'last_seen_at' => null
                ],
                'guest_name' => $chat->guest_name,
                'guest_email' => $chat->guest_email,
                'status' => $chat->status,
                'created_at' => $chat->created_at,
                'last_message_at' => $chat->last_message_at
            ],
            'messages' => $messages
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'chat_id' => 'required|exists:chats,id',
                'message' => 'required|string|max:1000'
            ]);

            // Find chat
            $chat = Chat::findOrFail($request->chat_id);

            // Create message
            $message = Message::create([
                'chat_id' => $chat->id,
                'sender_type' => 'admin',
                'sender_id' => Auth::guard('admin')->id(),
                'message' => $request->message,
                'type' => 'text',
                'is_read' => false
            ]);

            // Update chat timestamp
            $chat->update([
                'last_message_at' => now(),
                'status' => 'active'
            ]);

            // Format response
            $messageResponse = [
                'id' => $message->id,
                'message' => $message->message,
                'sender_type' => 'admin',
                'admin_id' => Auth::guard('admin')->id(),
                'user' => $chat->user ? $chat->user : (object) [
                    'id' => null,
                    'full_name' => $chat->guest_name ?? 'Guest User',
                    'username' => 'guest',
                    'is_online' => false
                ],
                'created_at' => $message->created_at,
                'is_read' => false
            ];

            return response()->json([
                'success' => true,
                'message' => $messageResponse
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending admin message: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Failed to send message'
            ], 500);
        }
    }

    public function getUsers()
    {
        $users = User::select('id', 'full_name', 'username', 'is_online', 'last_seen_at')
            ->orderBy('is_online', 'desc')
            ->orderBy('last_seen_at', 'desc')
            ->get();

        return response()->json($users);
    }

    public function startChat(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $chat = Chat::firstOrCreate([
            'user_id' => $request->user_id
        ]);

        return response()->json([
            'success' => true,
            'chat_id' => $chat->id
        ]);
    }
}
