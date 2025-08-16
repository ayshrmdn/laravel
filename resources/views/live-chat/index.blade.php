@extends('layouts.main')

@section('title', 'Live Chat Support - ' . \App\Models\Setting::get('site_name', 'MPOELOT'))

@section('content')
<div class="cyber-chat-container relative overflow-hidden">
    <!-- Cyber Background Effects -->
    <div class="cyber-bg-effects absolute inset-0">
        <div class="cyber-grid-overlay"></div>
        <div class="cyber-particles"></div>
        <div class="cyber-data-stream"></div>
    </div>

    <!-- Main Chat Container -->
    <div class="relative z-10 container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            
            <!-- Chat Header -->
            <div class="cyber-chat-header text-center mb-8">
                <div class="cyber-header-glow">
                    <h1 class="text-4xl md:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mb-4 cyber-title-glow">
                        LIVECHAT BOSSCUAN69
                    </h1>
                </div>

            <!-- Pre-Chat Form (Guest) -->
            <div id="preChatForm" class="cyber-pre-chat-form">
                <div class="cyber-form-container">
                    <div class="cyber-form-header">
                        <p class="text-gray-400 text-sm">Harap berikan detail Anda untuk terhubung dengan tim support kami</p>
                    </div>

                    <form id="guestChatForm" class="cyber-form">
                        @csrf
                        <div class="cyber-input-group">
                            <label class="cyber-label">Identitas Nama</label>
                            <div class="cyber-input-container">
                                <i class="fas fa-user cyber-input-icon"></i>
                                <input type="text" id="guestName" name="guest_name" class="cyber-input" placeholder="Masukkan nama Anda" required>
                                <div class="cyber-input-line"></div>
                            </div>
                        </div>

                        <div class="cyber-input-group">
                            <label class="cyber-label">Alamat Email</label>
                            <div class="cyber-input-container">
                                <i class="fas fa-envelope cyber-input-icon"></i>
                                <input type="email" id="guestEmail" name="guest_email" class="cyber-input" placeholder="Masukkan email Anda" required>
                                <div class="cyber-input-line"></div>
                            </div>
                        </div>

                        <div class="cyber-input-group">
                            <label class="cyber-label">Deskripsi Masalah</label>
                            <div class="cyber-input-container">
                                <i class="fas fa-exclamation-triangle cyber-input-icon"></i>
                                <textarea id="issueDescription" name="issue_description" class="cyber-textarea" placeholder="Jelaskan masalah atau pertanyaan Anda..." rows="4" required></textarea>
                                <div class="cyber-input-line"></div>
                            </div>
                        </div>

                        <button type="submit" class="cyber-submit-btn" id="startChatBtn">
                            <span class="cyber-btn-text">MULAI CHAT</span>
                            <div class="cyber-btn-effects">
                                <div class="cyber-btn-glow"></div>
                                <div class="cyber-btn-particles"></div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Chat Interface -->
            <div id="chatInterface" class="cyber-chat-interface hidden">
                <div class="cyber-chat-window">
                    <!-- Chat Header -->
                    <div class="cyber-chat-window-header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="cyber-avatar-container">
                                    <div class="cyber-admin-avatar">
                                        @if(\App\Models\Setting::get('support_agent_image'))
                                            <img src="{{ asset('storage/' . \App\Models\Setting::get('support_agent_image')) }}" 
                                                 alt="Support Agent" 
                                                 class="w-full h-full object-cover rounded-full">
                                        @else
                                            <i class="fas fa-headset text-cyan-400"></i>
                                        @endif
                                    </div>
                                    <div class="cyber-status-dot online"></div>
                                </div>
                                <div>
                                    <h3 class="text-cyan-400 font-bold font-mono">Agen Dukungan</h3>
                                    <p class="text-green-400 text-sm font-mono">• Online</p>
                                </div>
                            </div>
                            
                            <div class="cyber-chat-controls">
                                <button class="cyber-control-btn" id="minimizeChat">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button class="cyber-control-btn" id="closeChat">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Messages Area -->
                    <div class="cyber-chat-messages" id="chatMessages">
                        <div class="cyber-welcome-message">
                        </div>
                    </div>

                    <!-- Chat Input Area -->
                    <div class="cyber-chat-input-area">
                        <form id="chatMessageForm" class="cyber-message-form">
                            <div class="cyber-input-container">
                                <input type="text" id="messageInput" class="cyber-message-input" placeholder="Ketik pesan Anda..." autocomplete="off">
                                <button type="submit" class="cyber-send-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                        
                        <div class="cyber-input-footer">
                            <span class="text-gray-500 text-xs font-mono">Tekan Enter untuk mengirim • Shift+Enter untuk baris baru</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Cyber Chat Background Effects */
.cyber-chat-container {
    background: linear-gradient(135deg, #0A0F2C 0%, #1A0B1A 25%, #0D0D0D 50%, #2D1B69 75%, #1A0B1A 100%);
    min-height: calc(100vh - 140px);
}

.cyber-grid-overlay {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(rgba(0, 255, 255, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: gridFlow 20s linear infinite;
    opacity: 0.3;
}

@keyframes gridFlow {
    0% { background-position: 0 0; }
    100% { background-position: 50px 50px; }
}

.cyber-particles {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

.cyber-particles::before,
.cyber-particles::after {
    content: '';
    position: absolute;
    width: 4px;
    height: 4px;
    background: radial-gradient(circle, #00FFFF, transparent);
    border-radius: 50%;
    animation: particleFloat 8s linear infinite;
}

.cyber-particles::before {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.cyber-particles::after {
    top: 60%;
    right: 15%;
    animation-delay: 4s;
}

@keyframes particleFloat {
    0% { transform: translateY(0) translateX(0) scale(0); opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { transform: translateY(-100vh) translateX(50px) scale(1); opacity: 0; }
}

/* Chat Header Styling */
.cyber-chat-header {
    position: relative;
}

.cyber-header-glow {
    position: relative;
    padding: 2rem;
    border-radius: 20px;
    background: rgba(0, 255, 255, 0.05);
    border: 1px solid rgba(0, 255, 255, 0.2);
    backdrop-filter: blur(10px);
}

.cyber-title-glow {
    animation: titleGlow 3s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    0% { 
        text-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        transform: scale(1);
    }
    100% { 
        text-shadow: 0 0 40px rgba(255, 0, 128, 0.7), 0 0 60px rgba(139, 0, 255, 0.5);
        transform: scale(1.02);
    }
}

/* Status Indicators */
.cyber-status-bar {
    margin-top: 1.5rem;
    padding: 1rem;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 15px;
    border: 1px solid rgba(0, 255, 255, 0.2);
}

.cyber-status-item {
    display: flex;
    align-items: center;
}

.cyber-status-item > * + * {
    margin-left: 0.5rem;
}

.status-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 0.5rem;
    animation: statusPulse 2s ease-in-out infinite;
}

.status-indicator.online {
    background: radial-gradient(circle, #10B981, #059669);
    box-shadow: 0 0 10px #10B981;
}

.status-indicator.connected {
    background: radial-gradient(circle, #06B6D4, #0891B2);
    box-shadow: 0 0 10px #06B6D4;
    animation-delay: 0.5s;
}

.status-indicator.secure {
    background: radial-gradient(circle, #8B5CF6, #7C3AED);
    box-shadow: 0 0 10px #8B5CF6;
    animation-delay: 1s;
}

@keyframes statusPulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.2); opacity: 0.8; }
}

/* Pre-Chat Form Styling */
.cyber-pre-chat-form {
    max-width: 600px;
    margin: 0 auto;
}

.cyber-form-container {
    background: linear-gradient(135deg, rgba(0, 255, 255, 0.1) 0%, rgba(139, 0, 255, 0.1) 100%);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    padding: 2rem;
    backdrop-filter: blur(15px);
    position: relative;
    overflow: hidden;
}

.cyber-form-container::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #00FFFF, #FF0080, #8B00FF, #00FFFF);
    border-radius: 22px;
    z-index: -1;
    opacity: 0.3;
    animation: borderGlow 3s linear infinite;
}

@keyframes borderGlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.cyber-form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.cyber-input-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.cyber-label {
    display: block;
    color: #06B6D4;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    letter-spacing: 0.5px;
}

.cyber-input-container {
    position: relative;
}

.cyber-input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #06B6D4;
    z-index: 10;
}

.cyber-input, .cyber-textarea {
    width: 100%;
    background: rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 10px;
    padding: 1rem 1rem 1rem 3rem;
    color: white;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    outline: none;
}

.cyber-input:focus, .cyber-textarea:focus {
    border-color: #00FFFF;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
    background: rgba(0, 255, 255, 0.05);
}

.cyber-input::placeholder, .cyber-textarea::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.cyber-input-line {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #00FFFF, #FF0080);
    transition: width 0.3s ease;
}

.cyber-input:focus + .cyber-input-line,
.cyber-textarea:focus + .cyber-input-line {
    width: 100%;
}

/* Submit Button */
.cyber-submit-btn {
    width: 100%;
    position: relative;
    background: linear-gradient(135deg, #00FFFF 0%, #8B00FF 100%);
    border: none;
    border-radius: 15px;
    padding: 1rem 2rem;
    color: white;
    font-family: 'Courier New', monospace;
    font-weight: bold;
    font-size: 1rem;
    letter-spacing: 1px;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.cyber-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
}

.cyber-btn-text {
    position: relative;
    z-index: 10;
}

.cyber-btn-glow {
    position: absolute;
    inset: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.cyber-submit-btn:hover .cyber-btn-glow {
    transform: translateX(100%);
}

/* Chat Interface */
.cyber-chat-interface {
    max-width: 800px;
    margin: 0 auto;
}

.cyber-chat-window {
    background: linear-gradient(135deg, rgba(0, 255, 255, 0.1) 0%, rgba(139, 0, 255, 0.1) 100%);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 20px;
    overflow: hidden;
    backdrop-filter: blur(15px);
    height: 70vh;
    display: flex;
    flex-direction: column;
}

.cyber-chat-window-header {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 255, 255, 0.1) 100%);
    padding: 1rem;
    border-bottom: 1px solid rgba(0, 255, 255, 0.3);
}

.cyber-avatar-container {
    position: relative;
    width: 50px;
    height: 50px;
}

.cyber-admin-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #06B6D4, #8B5CF6);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border: 2px solid rgba(0, 255, 255, 0.5);
    overflow: hidden;
}

.cyber-admin-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.cyber-status-dot {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #000;
}

.cyber-status-dot.online {
    background: #10B981;
    animation: statusPulse 2s ease-in-out infinite;
}

.cyber-chat-controls {
    display: flex;
    gap: 0.5rem;
}

.cyber-control-btn {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    color: #06B6D4;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.cyber-control-btn:hover {
    background: rgba(0, 255, 255, 0.2);
    transform: scale(1.1);
}

/* Chat Messages */
.cyber-chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
    background: rgba(0, 0, 0, 0.2);
}

.cyber-welcome-message {
    text-align: center;
    margin-bottom: 1rem;
}

.cyber-system-message {
    display: inline-flex;
    align-items: center;
    background: rgba(0, 255, 255, 0.1);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 15px;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

/* Message Bubbles */
.message-bubble {
    margin-bottom: 1rem;
    animation: messageSlideIn 0.3s ease-out;
}

@keyframes messageSlideIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.message-bubble.guest {
    text-align: right;
}

.message-bubble.admin {
    text-align: left;
}

.message-content {
    display: inline-block;
    max-width: 70%;
    padding: 0.75rem 1rem;
    border-radius: 15px;
    font-size: 0.875rem;
    position: relative;
}

.message-bubble.guest .message-content {
    background: linear-gradient(135deg, #00FFFF 0%, #06B6D4 100%);
    color: #000;
    border-bottom-right-radius: 5px;
}

.message-bubble.admin .message-content {
    background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    color: white;
    border-bottom-left-radius: 5px;
}

.message-meta {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.6);
    margin-top: 0.25rem;
    font-family: 'Courier New', monospace;
}

/* Chat Input */
.cyber-chat-input-area {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.8) 0%, rgba(0, 255, 255, 0.1) 100%);
    padding: 1rem;
    border-top: 1px solid rgba(0, 255, 255, 0.3);
}

.cyber-message-form {
    display: flex;
    align-items: center;
}

.cyber-message-input {
    flex: 1;
    background: rgba(0, 0, 0, 0.5);
    border: 1px solid rgba(0, 255, 255, 0.3);
    border-radius: 25px;
    padding: 0.75rem 1rem;
    color: white;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    outline: none;
    margin-right: 0.5rem;
    transition: all 0.3s ease;
}

.cyber-message-input:focus {
    border-color: #00FFFF;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
    background: rgba(0, 255, 255, 0.05);
}

.cyber-message-input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.cyber-send-btn {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #00FFFF, #8B5CF6);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.cyber-send-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
}

.cyber-input-footer {
    text-align: center;
    margin-top: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .cyber-chat-window {
        height: 80vh;
        border-radius: 15px;
    }
    
    .cyber-form-container {
        padding: 1.5rem;
        border-radius: 15px;
    }
    
    .cyber-header-glow {
        padding: 1.5rem;
        border-radius: 15px;
    }
    
    .cyber-title-glow {
        font-size: 2rem;
    }
    
    .cyber-status-bar {
        flex-direction: column;
        gap: 1rem;
    }
    
    .cyber-status-item {
        justify-content: center;
        margin-bottom: 0.5rem;
    }
}

/* Custom Scrollbar */
.cyber-chat-messages::-webkit-scrollbar {
    width: 8px;
}

.cyber-chat-messages::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 4px;
}

.cyber-chat-messages::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #00FFFF, #8B5CF6);
    border-radius: 4px;
}

.cyber-chat-messages::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #06B6D4, #7C3AED);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const preChatForm = document.getElementById('preChatForm');
    const chatInterface = document.getElementById('chatInterface');
    const guestChatForm = document.getElementById('guestChatForm');
    const chatMessageForm = document.getElementById('chatMessageForm');
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    
    let sessionId = null;
    let messagePollingInterval = null;
    
    // Guest form fields
    const guestNameInput = document.getElementById('guestName');
    const guestEmailInput = document.getElementById('guestEmail');
    const issueDescriptionInput = document.getElementById('issueDescription');
    
    // Load saved guest data from localStorage
    function loadGuestData() {
        const savedData = localStorage.getItem('guestChatData');
        if (savedData) {
            try {
                const data = JSON.parse(savedData);
                if (data.name) guestNameInput.value = data.name;
                if (data.email) guestEmailInput.value = data.email;
                if (data.issue) issueDescriptionInput.value = data.issue;
                
                // Check if there's an active session
                if (data.sessionId) {
                    sessionId = data.sessionId;
                    // Try to restore the chat session
                    restoreChatSession();
                }
            } catch (e) {
                console.error('Error loading guest data:', e);
                localStorage.removeItem('guestChatData');
            }
        }
    }
    
    // Save guest data to localStorage
    function saveGuestData() {
        const data = {
            name: guestNameInput.value,
            email: guestEmailInput.value,
            issue: issueDescriptionInput.value,
            sessionId: sessionId
        };
        localStorage.setItem('guestChatData', JSON.stringify(data));
        
        // Show save indicator
        showSaveIndicator();
    }
    
    // Show save indicator
    function showSaveIndicator() {
        // Remove existing indicator
        const existingIndicator = document.querySelector('.save-indicator');
        if (existingIndicator) {
            existingIndicator.remove();
        }
        
        const indicator = document.createElement('div');
        indicator.className = 'save-indicator';
        indicator.style.cssText = `
            position: fixed;
            bottom: 80px;
            right: 20px;
            background: rgba(16, 185, 129, 0.9);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-family: 'Courier New', monospace;
            z-index: 1000;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        `;
        indicator.textContent = 'Data saved';
        
        document.body.appendChild(indicator);
        
        // Animate in
        setTimeout(() => {
            indicator.style.opacity = '1';
            indicator.style.transform = 'translateY(0)';
        }, 100);
        
        // Auto remove after 2 seconds
        setTimeout(() => {
            indicator.style.opacity = '0';
            indicator.style.transform = 'translateY(20px)';
            setTimeout(() => {
                if (indicator.parentNode) {
                    indicator.parentNode.removeChild(indicator);
                }
            }, 300);
        }, 2000);
    }
    
    // Clear saved guest data
    function clearGuestData() {
        localStorage.removeItem('guestChatData');
    }
    
    // Restore chat session if exists
    async function restoreChatSession() {
        if (!sessionId) return;
        
        try {
            const response = await fetch(`{{ url('/live-chat/messages') }}/${sessionId}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            });
            
            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    // Show chat interface
                    preChatForm.classList.add('hidden');
                    chatInterface.classList.remove('hidden');
                    
                    // Load messages
                    updateChatMessages(result.messages);
                    
                    // Start polling
                    startMessagePolling();
                    
                    // Focus on message input
                    messageInput.focus();
                    
                    // Show notification
                    showNotification('Sesi chat berhasil dipulihkan!', 'success');
                    
                    console.log('Chat session restored successfully');
                } else {
                    // Session not found, clear it
                    sessionId = null;
                    clearGuestData();
                }
            } else {
                // Session not found, clear it
                sessionId = null;
                clearGuestData();
            }
        } catch (error) {
            console.error('Error restoring chat session:', error);
            sessionId = null;
            clearGuestData();
        }
    }
    
    // Auto-save form data when user types (with debouncing)
    let saveTimeout;
    function debouncedSave() {
        clearTimeout(saveTimeout);
        saveTimeout = setTimeout(saveGuestData, 500); // Save after 500ms of no typing
    }
    
    guestNameInput.addEventListener('input', debouncedSave);
    guestEmailInput.addEventListener('input', debouncedSave);
    issueDescriptionInput.addEventListener('input', debouncedSave);
    
    // Load data on page load
    loadGuestData();
    
    // Notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `cyber-notification ${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'info' ? 'linear-gradient(135deg, #06B6D4, #0891B2)' : 'linear-gradient(135deg, #10B981, #059669)'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            border: 1px solid rgba(0, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            z-index: 10000;
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            box-shadow: 0 4px 20px rgba(0, 255, 255, 0.3);
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
        `;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 5000);
    }



    // Handle pre-chat form submission
    guestChatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = document.getElementById('startChatBtn');
        
        // Add loading state
        submitBtn.innerHTML = '<span class="cyber-btn-text">MENGHUBUNGKAN...</span>';
        submitBtn.disabled = true;
        
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                throw new Error('CSRF token not found');
            }
            
            const response = await fetch('/live-chat/guest-start', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const result = await response.json();
            
            if (result.success) {
                sessionId = result.chat_id;
                
                // Save session ID to localStorage
                saveGuestData();
                
                // Show notification if existing session restored
                if (result.existing_session) {
                    showNotification('Sesi chat sebelumnya telah dipulihkan!', 'info');
                }
                
                // Show chat interface with animation
                preChatForm.style.transform = 'translateY(-20px)';
                preChatForm.style.opacity = '0';
                
                setTimeout(() => {
                    preChatForm.classList.add('hidden');
                    chatInterface.classList.remove('hidden');
                    chatInterface.style.transform = 'translateY(20px)';
                    chatInterface.style.opacity = '0';
                    
                    setTimeout(() => {
                        chatInterface.style.transform = 'translateY(0)';
                        chatInterface.style.opacity = '1';
                        chatInterface.style.transition = 'all 0.5s ease-out';
                        
                        // Start polling for messages
                        startMessagePolling();
                        
                        // Focus on message input
                        messageInput.focus();
                    }, 100);
                }, 500);
                
            } else {
                alert('Gagal memulai sesi chat. Silakan coba lagi.');
                submitBtn.innerHTML = '<span class="cyber-btn-text">MULAI KONEKSI</span>';
                submitBtn.disabled = false;
            }
        } catch (error) {
            console.error('Error starting chat:', error);
            
            // Show detailed error to user
            let errorMessage = 'Kesalahan koneksi. ';
            if (error.message.includes('HTTP error')) {
                errorMessage += `Kesalahan server: ${error.message}`;
            } else if (error.message.includes('CSRF')) {
                errorMessage += 'Kesalahan token keamanan. Harap muat ulang halaman.';
            } else {
                errorMessage += 'Harap periksa koneksi internet Anda dan coba lagi.';
            }
            
            alert(errorMessage);
            submitBtn.innerHTML = '<span class="cyber-btn-text">MULAI KONEKSI</span>';
            submitBtn.disabled = false;
        }
    });

    // Handle message sending
    function sendMessage() {
        const message = messageInput.value.trim();
        if (!message || !sessionId) return Promise.resolve();
        
        // Disable send button temporarily
        const sendBtn = document.querySelector('.cyber-send-btn');
        const originalHTML = sendBtn.innerHTML;
        sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        sendBtn.disabled = true;
        
        // Clear input
        messageInput.value = '';
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        if (!csrfToken) {
            alert('Kesalahan token CSRF. Harap muat ulang halaman.');
            sendBtn.innerHTML = originalHTML;
            sendBtn.disabled = false;
            return Promise.reject(new Error('CSRF token not found'));
        }
        
        // Use FormData with proper CSRF handling
        const formData = new FormData();
        formData.append('message', message);
        formData.append('session_id', sessionId);
        formData.append('_token', csrfToken);

        return fetch('/live-chat/send-message', {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
                // Don't set Content-Type, let browser set it with boundary for FormData
            },
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        }).then(result => {
            if (result.success) {
                console.log('Message sent successfully');
                // Trigger immediate polling to get the new message faster
                if (sessionId) {
                    fetch(`{{ url('/live-chat/messages') }}/${sessionId}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                        }
                    }).then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            updateChatMessages(result.messages);
                        }
                    }).catch(err => console.log('Immediate polling failed:', err));
                }
            } else {
                console.error('Failed to send message:', result.error);
                // Re-add message to input if failed
                messageInput.value = message;
                alert('Gagal mengirim pesan: ' + (result.error || 'Kesalahan tidak diketahui'));
                throw new Error(result.error || 'Failed to send message');
            }
        }).catch(error => {
            console.error('Error sending message:', error);
            // Re-add message to input if failed
            messageInput.value = message;
            alert('Kesalahan mengirim pesan: ' + error.message);
            throw error;
        }).finally(() => {
            // Re-enable send button
            sendBtn.innerHTML = originalHTML;
            sendBtn.disabled = false;
        });
    }

    let isSending = false;
    
    // Debounced send message function
    function sendMessageDebounced() {
        if (isSending) {
            return;
        }
        isSending = true;
        sendMessage().finally(() => {
            isSending = false;
        });
    }
    
    // Attach event listeners for sending message
    chatMessageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessageDebounced();
    });
    
    // Also attach click event directly to send button
    document.addEventListener('click', function(e) {
        if (e.target.closest('.cyber-send-btn')) {
            e.preventDefault();
            sendMessageDebounced();
        }
    });

    let lastMessageIds = new Set();
    
    // Start polling for new messages
    function startMessagePolling() {
        messagePollingInterval = setInterval(async () => {
            if (!sessionId) return;
            
            try {
                const response = await fetch(`{{ url('/live-chat/messages') }}/${sessionId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    }
                });
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const result = await response.json();
                
                if (result.success) {
                    updateChatMessages(result.messages);
                } else {
                    console.error('Error fetching messages:', result.error);
                }
            } catch (error) {
                console.error('Error polling messages:', error);
                // Reduce polling frequency on error
                clearInterval(messagePollingInterval);
                setTimeout(() => {
                    if (sessionId) startMessagePolling();
                }, 10000); // Retry after 10 seconds
            }
        }, 3000); // Poll every 3 seconds (reduced frequency)
    }

    // Update chat messages (optimized to prevent flickering)
    function updateChatMessages(messages) {
        let shouldScroll = false;
        
        // Only add new messages that haven't been displayed yet
        messages.forEach(message => {
            if (!lastMessageIds.has(message.id)) {
                addMessageToChat(message.message, message.sender_type, message.sender_name, true, message.id);
                lastMessageIds.add(message.id);
                shouldScroll = true;
            }
        });
        
        // Only scroll if new messages were added
        if (shouldScroll) {
            setTimeout(() => {
                chatMessages.scrollTo({
                    top: chatMessages.scrollHeight,
                    behavior: 'smooth'
                });
            }, 100);
        }
    }

    // Add message to chat
    function addMessageToChat(message, senderType, senderName, animate = true, messageId = null) {
        const messageElement = document.createElement('div');
        messageElement.className = `message-bubble ${senderType}`;
        
        // Add message ID for duplicate prevention
        if (messageId) {
            messageElement.setAttribute('data-message-id', messageId);
        }
        
        if (animate) {
            messageElement.style.opacity = '0';
            messageElement.style.transform = 'translateY(20px)';
        }
        
        const timestamp = new Date().toLocaleTimeString('en-US', { 
            hour12: false, 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        messageElement.innerHTML = `
            <div class="message-content">
                <div>${message}</div>
            </div>
            <div class="message-meta">
                ${senderName} • ${timestamp}
            </div>
        `;
        
        chatMessages.appendChild(messageElement);
        
        if (animate) {
            setTimeout(() => {
                messageElement.style.transition = 'all 0.3s ease-out';
                messageElement.style.opacity = '1';
                messageElement.style.transform = 'translateY(0)';
            }, 50);
        }
        
        // Don't increment counter here - let updateChatMessages handle it
        
        // Scroll to bottom smoothly
        chatMessages.scrollTo({
            top: chatMessages.scrollHeight,
            behavior: 'smooth'
        });
    }

    // Handle Enter key in message input
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatMessageForm.dispatchEvent(new Event('submit'));
        }
    });

    // Chat control buttons
    document.getElementById('minimizeChat')?.addEventListener('click', function() {
        chatInterface.style.transform = 'scale(0.8)';
        chatInterface.style.opacity = '0.5';
        setTimeout(() => {
            chatInterface.style.transform = 'scale(1)';
            chatInterface.style.opacity = '1';
        }, 200);
    });

    document.getElementById('closeChat')?.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin menutup sesi chat?')) {
            if (messagePollingInterval) {
                clearInterval(messagePollingInterval);
            }
            
            chatInterface.style.transform = 'translateY(20px)';
            chatInterface.style.opacity = '0';
            
            setTimeout(() => {
                chatInterface.classList.add('hidden');
                preChatForm.classList.remove('hidden');
                preChatForm.style.transform = 'translateY(0)';
                preChatForm.style.opacity = '1';
                
                // Clear session but keep form data
                sessionId = null;
                saveGuestData(); // Save without session ID
            }, 500);
        }
    });

    // Add transition styles
    preChatForm.style.transition = 'all 0.5s ease-out';
    chatInterface.style.transition = 'all 0.5s ease-out';
    
    // Handle page unload - save current state
    window.addEventListener('beforeunload', function() {
        saveGuestData();
    });
    
    // Add a button to clear saved data (for testing/debugging)
    const clearDataBtn = document.createElement('button');
    clearDataBtn.textContent = '';
    clearDataBtn.className = 'cyber-btn-outline text-xs mt-2';
    clearDataBtn.style.cssText = 'position: fixed; bottom: 20px; right: 20px; z-index: 1000; padding: 8px 12px; font-size: 12px;';
    clearDataBtn.addEventListener('click', function() {
        if (confirm('Clear all saved chat data?')) {
            clearGuestData();
            location.reload();
        }
    });
    document.body.appendChild(clearDataBtn);
});
</script>
@endsection
