@extends('layouts.admin')

@section('title', 'Live Chat')
@section('subtitle', 'Kelola percakapan dengan pengguna secara real-time')

@section('content')
<div class="min-h-screen bg-black text-white p-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-cyan-400 to-purple-400 bg-clip-text text-transparent">
                    <i class="fas fa-comments mr-3"></i>Live Chat Management
                </h1>
                <p class="text-gray-400 mt-2">Kelola percakapan dengan pengguna secara real-time</p>
            </div>
            <button id="newChatBtn" class="cyber-btn-primary">
                <i class="fas fa-plus mr-2"></i>Chat Baru
            </button>
        </div>

        <!-- Chat Container -->
        <div class="cyber-card p-0 overflow-hidden" style="height: calc(100vh - 180px);">
            <div class="flex h-full flex-col md:flex-row">
                <!-- Chat List Sidebar -->
                <div class="w-full md:w-1/3 border-r border-gray-700 flex flex-col min-h-0">
                    <!-- Search Bar -->
                    <div class="p-4 border-b border-gray-700">
                        <div class="relative">
                            <input type="text" id="searchUsers" placeholder="Cari pengguna..." 
                                class="cyber-input pl-10">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-cyan-400"></i>
                        </div>
                    </div>

                    <!-- Online Users -->
                    <div class="p-4 border-b border-gray-700">
                        <h3 class="cyber-label mb-3">Pengguna Online</h3>
                        <div id="onlineUsers" class="space-y-2">
                            <!-- Online users will be loaded here -->
                        </div>
                    </div>

                    <!-- Chat List -->
                    <div class="flex-1 overflow-y-auto min-h-0">
                        <div class="p-4">
                            <h3 class="cyber-label mb-3">Percakapan</h3>
                            <div id="chatList" class="space-y-2">
                                @forelse($chats as $chat)
                                <div class="chat-item flex items-start p-3 rounded-xl hover:bg-gray-800 cursor-pointer transition-all duration-200 border border-transparent hover:border-cyan-400" 
                                     data-chat-id="{{ $chat->id }}" data-user-id="{{ $chat->user_id }}">
                                    <div class="relative flex-shrink-0">
                                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full {{ $chat->user ? 'bg-gradient-to-r from-cyan-400 to-purple-400' : 'bg-gradient-to-r from-yellow-400 to-orange-500' }} flex items-center justify-center text-black font-semibold text-sm md:text-lg">
                                            @if($chat->user)
                                                {{ strtoupper(substr($chat->user->full_name, 0, 1)) }}
                                            @else
                                                {{ strtoupper(substr($chat->guest_name, 0, 1)) }}
                                            @endif
                                        </div>
                                        @if($chat->user && $chat->user->is_online)
                                        <div class="absolute -bottom-1 -right-1 w-3 h-3 md:w-4 md:h-4 bg-green-400 rounded-full border-2 border-black"></div>
                                        @elseif(!$chat->user)
                                        <div class="absolute -bottom-1 -right-1 w-3 h-3 md:w-4 md:h-4 bg-yellow-400 rounded-full border-2 border-black" title="Guest User"></div>
                                        @endif
                                    </div>
                                    <div class="ml-3 flex-1 min-w-0">
                                        <div class="flex items-start justify-between space-x-2">
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <p class="text-sm font-semibold text-white truncate">
                                                        @if($chat->user)
                                                            {{ $chat->user->full_name }}
                                                        @else
                                                            {{ $chat->guest_name }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <p class="text-sm text-gray-400 truncate mb-1">
                                                    @if($chat->messages->count() > 0)
                                                        {{ Str::limit($chat->messages->first()->message, 25) }}
                                                    @else
                                                        Belum ada pesan
                                                    @endif
                                                </p>
                                                @if(!$chat->user && $chat->guest_email)
                                                <p class="text-xs text-gray-500 truncate">{{ $chat->guest_email }}</p>
                                                @endif
                                            </div>
                                            <div class="text-xs text-gray-500 flex-shrink-0 ml-2">
                                                {{ ($chat->last_message_at ?: $chat->created_at)->format('H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-8 text-gray-400">
                                    <i class="fas fa-comments text-6xl mb-4 text-gray-600"></i>
                                    <p class="text-lg">Belum ada percakapan</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="hidden md:flex flex-1 flex-col min-h-0" id="chatArea" style="min-height: 0;">
                    <!-- Chat Header -->
                    <div class="p-4 md:p-6 border-b border-gray-700 bg-gray-800 flex-shrink-0" id="chatHeader" style="display: none;">
                        <div class="flex items-center">
                            <button class="md:hidden mr-3 text-gray-400 hover:text-cyan-400" id="backToList">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <div class="relative flex-shrink-0">
                                <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-gradient-to-r from-cyan-400 to-purple-400 flex items-center justify-center text-black font-semibold text-base md:text-lg" id="chatUserAvatar">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-3 h-3 md:w-4 md:h-4 rounded-full border-2 border-black" id="chatUserStatusIndicator"></div>
                            </div>
                            <div class="ml-3 md:ml-4 flex-1 min-w-0">
                                <h3 class="font-semibold text-white text-sm md:text-base truncate" id="chatUserName"></h3>
                                <p class="text-xs md:text-sm text-gray-400 truncate" id="chatUserStatus">Online</p>
                            </div>
                        </div>
                    </div>

                    <!-- Messages Area -->
                    <div class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4 min-h-0 bg-gray-900" id="messagesArea" style="scroll-behavior: smooth;">
                        <!-- Default state -->
                        <div class="flex items-center justify-center h-full text-gray-400" id="defaultChatState">
                            <div class="text-center">
                                <i class="fas fa-comments text-6xl mb-4 text-gray-600"></i>
                                <h3 class="text-xl font-semibold mb-2 text-white">Pilih percakapan untuk memulai</h3>
                                <p class="text-gray-400">Klik pada salah satu percakapan di samping untuk mulai chatting</p>
                            </div>
                        </div>
                    </div>

                    <!-- Message Input -->
                    <div class="p-4 md:p-6 border-t border-gray-700 bg-gray-800 flex-shrink-0" id="messageInput" style="display: none;">
                        <form id="sendMessageForm" class="flex items-end space-x-2 md:space-x-3">
                            <div class="flex-1 min-w-0">
                                <textarea id="messageText" rows="1" 
                                    placeholder="Ketik pesan Anda..." 
                                    class="cyber-input resize-none"
                                    style="min-height: 40px; max-height: 120px;"></textarea>
                            </div>
                            <button type="submit" 
                                class="cyber-btn-primary p-2 md:p-3 disabled:opacity-50 disabled:cursor-not-allowed flex-shrink-0"
                                id="sendButton">
                                <i class="fas fa-paper-plane text-sm md:text-base"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Chat Modal -->
<div id="newChatModal" class="fixed inset-0 bg-black bg-opacity-75 hidden items-center justify-center z-50 p-4">
    <div class="cyber-card max-w-md w-full mx-4 transform transition-all duration-200 max-h-[90vh] overflow-hidden flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-cyan-400">Mulai Chat Baru</h3>
            <button id="closeModal" class="text-gray-400 hover:text-cyan-400">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mb-4">
            <input type="text" id="modalSearchUsers" placeholder="Cari pengguna..." 
                class="cyber-input">
        </div>
        <div id="modalUsersList" class="flex-1 overflow-y-auto space-y-2 min-h-0">
            <!-- Users will be loaded here -->
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Chat Layout Improvements */
.chat-item {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.chat-item:hover {
    background-color: rgba(0, 255, 255, 0.1);
    border-color: rgba(0, 255, 255, 0.3);
}

/* Message bubble improvements */
.break-words {
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
}

/* Cyberpunk message styling */
.message-bubble {
    border-radius: 12px;
    padding: 12px 16px;
    margin: 8px 0;
    max-width: 80%;
    word-wrap: break-word;
}

.message-bubble.user {
    background: linear-gradient(135deg, rgba(0, 255, 255, 0.2), rgba(139, 0, 255, 0.2));
    border: 1px solid rgba(0, 255, 255, 0.3);
    color: white;
    margin-left: auto;
}

.message-bubble.admin {
    background: linear-gradient(135deg, rgba(255, 0, 128, 0.2), rgba(139, 0, 255, 0.2));
    border: 1px solid rgba(255, 0, 128, 0.3);
    color: white;
    margin-right: auto;
}

/* Scrollbar styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.3);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #00FFFF, #8B00FF);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #00CCCC, #6600CC);
}

/* Mobile optimizations */
@media (max-width: 768px) {
    .cyber-card {
        height: calc(100vh - 160px) !important;
    }
    
    #messagesArea {
        padding: 0.75rem;
    }
    
    .chat-item {
        padding: 0.75rem;
    }
    
    /* Ensure text doesn't overflow on mobile */
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
}

/* Ensure proper scrolling */
.overflow-y-auto {
    scrollbar-width: thin;
    scrollbar-color: rgba(139, 92, 246, 0.3) transparent;
}

.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: transparent;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background-color: rgba(139, 92, 246, 0.3);
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background-color: rgba(139, 92, 246, 0.5);
}

/* Prevent text overflow in message bubbles */
.message-bubble {
    max-width: 100%;
    word-wrap: break-word;
}

/* Responsive text sizing */
@media (max-width: 640px) {
    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }
    
    .text-xs {
        font-size: 0.75rem;
        line-height: 1rem;
    }
}

/* Guest user styling */
.guest-avatar {
    background: linear-gradient(135deg, #fbbf24, #f59e0b) !important;
}

.guest-status {
    color: #92400e !important;
}

/* Clean up guest user display */
.guest-label {
    display: none !important;
}

/* Ensure proper text display for guest users */
#chatUserName {
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

#chatUserStatus {
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Guest user message styling */
.guest-message .message-content {
    background: linear-gradient(135deg, #fef3c7, #fde68a) !important;
    color: #92400e !important;
}
</style>
@endpush

@push('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
let currentChatId = null;
let currentUserId = null;

// Initialize chat functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeChat();
    loadOnlineUsers();
    setupEventListeners();
});

function initializeChat() {
    // Auto-resize textarea
    const messageText = document.getElementById('messageText');
    if (messageText) {
        messageText.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });

        // Submit on Enter (not Shift+Enter)
        messageText.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                document.getElementById('sendMessageForm').dispatchEvent(new Event('submit'));
            }
        });
    }
}

function setupEventListeners() {
    // Chat item click
    document.addEventListener('click', function(e) {
        const chatItem = e.target.closest('.chat-item');
        if (chatItem) {
            const chatId = chatItem.dataset.chatId;
            const userId = chatItem.dataset.userId;
            openChat(chatId, userId);
        }
    });

    // New chat button
    document.getElementById('newChatBtn').addEventListener('click', function() {
        document.getElementById('newChatModal').classList.remove('hidden');
        document.getElementById('newChatModal').classList.add('flex');
        loadUsersForModal();
    });

    // Close modal
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('newChatModal').classList.add('hidden');
        document.getElementById('newChatModal').classList.remove('flex');
    });

    // Send message form
    document.getElementById('sendMessageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessage();
    });

    // Search functionality
    document.getElementById('searchUsers').addEventListener('input', function() {
        // Implement search functionality
    });

    // Modal search
    document.getElementById('modalSearchUsers').addEventListener('input', function() {
        // Implement modal search functionality
    });

    // Back to list (mobile)
    document.getElementById('backToList').addEventListener('click', function() {
        // Hide chat area and show chat list on mobile
        const chatArea = document.getElementById('chatArea');
        chatArea.classList.add('hidden');
        chatArea.classList.remove('flex');
        
        // Reset active chat item
        document.querySelectorAll('.chat-item').forEach(item => {
            item.classList.remove('bg-purple-50', 'border-purple-300');
        });
        
        // Hide chat header and input
        document.getElementById('chatHeader').style.display = 'none';
        document.getElementById('messageInput').style.display = 'none';
        document.getElementById('defaultChatState').style.display = 'flex';
    });
}

function loadOnlineUsers() {
    fetch('{{ route("admin.chat.users") }}')
        .then(response => response.json())
        .then(users => {
            const onlineUsersContainer = document.getElementById('onlineUsers');
            const onlineUsers = users.filter(user => user.is_online);
            
            if (onlineUsers.length === 0) {
                onlineUsersContainer.innerHTML = '<p class="text-sm text-gray-500">Tidak ada pengguna online</p>';
                return;
            }

            onlineUsersContainer.innerHTML = onlineUsers.map(user => `
                <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer user-item" data-user-id="${user.id}">
                    <div class="relative flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-green-400 to-blue-500 flex items-center justify-center text-white font-semibold text-sm">
                            ${user.full_name.charAt(0).toUpperCase()}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">${user.full_name}</p>
                        <p class="text-xs text-green-600 truncate">Online</p>
                    </div>
                </div>
            `).join('');

            // Add click listeners for online users
            document.querySelectorAll('.user-item').forEach(item => {
                item.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    startNewChat(userId);
                });
            });
        })
        .catch(error => {
            console.error('Error loading online users:', error);
        });
}

function loadUsersForModal() {
    fetch('{{ route("admin.chat.users") }}')
        .then(response => response.json())
        .then(users => {
            const modalUsersList = document.getElementById('modalUsersList');
            
            modalUsersList.innerHTML = users.map(user => `
                <div class="flex items-center p-3 rounded-lg hover:bg-gray-50 cursor-pointer modal-user-item" data-user-id="${user.id}">
                    <div class="relative flex-shrink-0">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-400 to-purple-500 flex items-center justify-center text-white font-semibold">
                            ${user.full_name.charAt(0).toUpperCase()}
                        </div>
                        ${user.is_online ? '<div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white"></div>' : ''}
                    </div>
                    <div class="ml-3 flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate">${user.full_name}</p>
                        <p class="text-sm text-gray-500 truncate">@${user.username}</p>
                        <p class="text-xs ${user.is_online ? 'text-green-600' : 'text-gray-400'} truncate">
                            ${user.is_online ? 'Online' : 'Terakhir dilihat ' + new Date(user.last_seen_at).toLocaleString('id-ID')}
                        </p>
                    </div>
                </div>
            `).join('');

            // Add click listeners
            document.querySelectorAll('.modal-user-item').forEach(item => {
                item.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    startNewChat(userId);
                    document.getElementById('newChatModal').classList.add('hidden');
                    document.getElementById('newChatModal').classList.remove('flex');
                });
            });
        })
        .catch(error => {
            console.error('Error loading users for modal:', error);
        });
}

function startNewChat(userId) {
    fetch('{{ route("admin.chat.start") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ user_id: userId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the chat list or open the new chat
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error starting new chat:', error);
    });
}

function openChat(chatId, userId) {
    currentChatId = chatId;
    currentUserId = userId;

    // Show chat area on mobile
    const chatArea = document.getElementById('chatArea');
    chatArea.classList.remove('hidden');
    chatArea.classList.add('flex');

    // Load chat messages
    fetch(`/admin/chat/${chatId}`)
        .then(response => response.json())
        .then(data => {
            // Handle both user and guest chat data
            const chatData = data.chat;
            const userData = chatData.user || {
                guest_name: chatData.guest_name,
                guest_email: chatData.guest_email,
                username: 'guest'
            };
            
            updateChatHeader(userData);
            displayMessages(data.messages);
            
            // Show chat header and input
            document.getElementById('chatHeader').style.display = 'block';
            document.getElementById('messageInput').style.display = 'block';
            document.getElementById('defaultChatState').style.display = 'none';
            
            // Focus on message input after a short delay
            setTimeout(() => {
                document.getElementById('messageText').focus();
            }, 300);
        })
        .catch(error => {
            console.error('Error loading chat:', error);
        });

    // Update active chat item
    document.querySelectorAll('.chat-item').forEach(item => {
        item.classList.remove('bg-purple-50', 'border-purple-300');
    });
    document.querySelector(`[data-chat-id="${chatId}"]`).classList.add('bg-purple-50', 'border-purple-300');
}

function updateChatHeader(user) {
    const avatarElement = document.getElementById('chatUserAvatar');
    const nameElement = document.getElementById('chatUserName');
    const statusElement = document.getElementById('chatUserStatus');
    const statusIndicator = document.getElementById('chatUserStatusIndicator');
    
    // Handle guest user
    if (!user || user.username === 'guest' || user.guest_name) {
        const guestName = user?.guest_name || user?.full_name || 'Guest';
        const guestEmail = user?.guest_email || '';
        
        // Set avatar with first letter of guest name
        avatarElement.textContent = guestName.charAt(0).toUpperCase();
        avatarElement.className = 'w-10 h-10 md:w-12 md:h-12 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center text-white font-semibold text-base md:text-lg';
        
        // Set name
        nameElement.textContent = guestName;
        nameElement.className = 'font-semibold text-gray-900 text-sm md:text-base truncate';
        
        // Set status
        statusElement.textContent = guestEmail ? guestEmail : 'Online';
        statusElement.className = 'text-xs md:text-sm text-gray-500 truncate';
        
        // Set status indicator
        if (statusIndicator) {
            statusIndicator.className = 'absolute -bottom-1 -right-1 w-3 h-3 md:w-4 md:h-4 bg-yellow-400 rounded-full border-2 border-white';
            statusIndicator.title = 'Guest User';
        }
    } else {
        // Handle regular user
        avatarElement.textContent = user.full_name.charAt(0).toUpperCase();
        avatarElement.className = 'w-10 h-10 md:w-12 md:h-12 rounded-full bg-gradient-to-r from-red-400 to-purple-500 flex items-center justify-center text-white font-semibold text-base md:text-lg';
        
        nameElement.textContent = user.full_name;
        nameElement.className = 'font-semibold text-gray-900 text-sm md:text-base truncate';
        
        if (user.is_online) {
            statusElement.textContent = 'Online';
            statusElement.className = 'text-xs md:text-sm text-green-600 truncate';
            if (statusIndicator) {
                statusIndicator.className = 'absolute -bottom-1 -right-1 w-3 h-3 md:w-4 md:h-4 bg-green-400 rounded-full border-2 border-white';
                statusIndicator.title = 'Online';
            }
        } else {
            statusElement.textContent = 'Terakhir dilihat ' + new Date(user.last_seen_at).toLocaleString('id-ID');
            statusElement.className = 'text-xs md:text-sm text-gray-500 truncate';
            if (statusIndicator) {
                statusIndicator.className = 'absolute -bottom-1 -right-1 w-3 h-3 md:w-4 md:h-4 bg-gray-400 rounded-full border-2 border-white';
                statusIndicator.title = 'Offline';
            }
        }
    }
}

function displayMessages(messages) {
    const messagesArea = document.getElementById('messagesArea');
    
    messagesArea.innerHTML = messages.map(message => {
        const isAdmin = message.admin_id !== null;
        const time = message.time_hm ?? new Date(message.created_at).toLocaleTimeString('id-ID', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });

        // Handle guest user vs regular user
        const isGuest = !message.user || message.user.username === 'guest' || message.user.guest_name;
        const userName = isGuest ? (message.user?.guest_name || message.user?.full_name || 'Guest') : message.user.full_name;
        const userInitial = userName.charAt(0).toUpperCase();
        const avatarGradient = isGuest ? 'from-yellow-400 to-orange-500' : 'from-blue-400 to-green-500';
        
        return `
            <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} mb-4">
                <div class="flex items-end space-x-2 max-w-[85%] sm:max-w-xs lg:max-w-md">
                    ${!isAdmin ? `
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r ${avatarGradient} flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                            ${userInitial}
                        </div>
                    ` : ''}
                    
                    <div class="flex flex-col min-w-0 flex-1">
                        <div class="px-3 py-2 rounded-2xl ${isAdmin 
                            ? 'bg-gradient-to-r from-red-500 to-purple-600 text-white rounded-br-sm shadow-lg' 
                            : 'bg-white/90 backdrop-blur-sm text-gray-900 rounded-bl-sm shadow'
                        } break-words border border-white/10">
                            <p class="text-sm leading-relaxed">${message.message}</p>
                        </div>
                        <div class="text-xs text-gray-500 mt-1 ${isAdmin ? 'text-right' : 'text-left'} px-1">
                            ${time}
                        </div>
                    </div>
                    
                    ${isAdmin ? `
                        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-red-400 to-purple-500 flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                            A
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }).join('');

    // Scroll to bottom
    messagesArea.scrollTop = messagesArea.scrollHeight;
}

function sendMessage() {
    const messageText = document.getElementById('messageText');
    const message = messageText.value.trim();
    
    if (!message || !currentChatId) return;

    const sendButton = document.getElementById('sendButton');
    sendButton.disabled = true;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!csrfToken) {
        alert('CSRF token error. Please refresh the page.');
        sendButton.disabled = false;
        return;
    }

    // Use FormData with proper CSRF handling  
    const formData = new FormData();
    formData.append('chat_id', currentChatId);
    formData.append('message', message);
    formData.append('_token', csrfToken);

    fetch('{{ route("admin.chat.send") }}', {
        method: 'POST',
        headers: {
            'Accept': 'application/json'
            // Don't set Content-Type for FormData
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageText.value = '';
            messageText.style.height = 'auto';
            
            // Add message to chat immediately
            addMessageToChat(data.message);
        } else {
            console.error('Failed to send message:', data.error);
            alert('Failed to send message: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        alert('Error sending message: ' + error.message);
    })
    .finally(() => {
        sendButton.disabled = false;
        messageText.focus();
    });
}

function addMessageToChat(message) {
    const messagesArea = document.getElementById('messagesArea');
    const isAdmin = message.admin_id !== null;
    const time = message.time_hm ?? new Date(message.created_at).toLocaleTimeString('id-ID', { 
        hour: '2-digit', 
        minute: '2-digit' 
    });

    // Handle guest user vs regular user
    const isGuest = !message.user || message.user.username === 'guest' || message.user.guest_name;
    const userName = isGuest ? (message.user?.guest_name || message.user?.full_name || 'Guest') : message.user.full_name;
    const userInitial = userName.charAt(0).toUpperCase();
    const avatarGradient = isGuest ? 'from-yellow-400 to-orange-500' : 'from-blue-400 to-green-500';

    const messageHTML = `
        <div class="flex ${isAdmin ? 'justify-end' : 'justify-start'} mb-4">
            <div class="flex items-end space-x-2 max-w-[85%] sm:max-w-xs lg:max-w-md">
                ${!isAdmin ? `
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r ${avatarGradient} flex items-center justify-center text-black font-semibold text-sm flex-shrink-0">
                        ${userInitial}
                    </div>
                ` : ''}
                
                <div class="flex flex-col min-w-0 flex-1">
                    <div class="message-bubble ${isAdmin ? 'admin' : 'user'}">
                        <p class="text-sm leading-relaxed">${message.message}</p>
                    </div>
                    <div class="text-xs text-gray-400 mt-1 ${isAdmin ? 'text-right' : 'text-left'} px-1">
                        ${time}
                    </div>
                </div>
                
                ${isAdmin ? `
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-cyan-400 to-purple-400 flex items-center justify-center text-black font-semibold text-sm flex-shrink-0">
                        A
                    </div>
                ` : ''}
            </div>
        </div>
    `;

    messagesArea.insertAdjacentHTML('beforeend', messageHTML);
    messagesArea.scrollTop = messagesArea.scrollHeight;
}

// Real-time functionality will be added with Pusher
// TODO: Add Pusher integration for real-time messages
</script>
@endpush
