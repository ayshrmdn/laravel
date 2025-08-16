<div class="chat-container">
    <div class="chat-header">
        <h1>Chat Modern Cyberpunk</h1>
    </div>
    <div class="chat-messages">
        <!-- Messages will be displayed here -->
    </div>
    <div class="chat-input">
        <input type="text" placeholder="Type your message..." />
        <button>Send</button>
    </div>
</div>
<style>
    .chat-container {
        background-color: #2b2b2b;
        color: #ffffff;
        border-radius: 10px;
        padding: 20px;
    }
    .chat-header {
        border-bottom: 2px solid #00ffcc;
        margin-bottom: 10px;
    }
    .chat-messages {
        max-height: 400px;
        overflow-y: auto;
        margin-bottom: 10px;
    }
    .chat-input {
        display: flex;
    }
    .chat-input input {
        flex: 1;
        padding: 10px;
        border: 1px solid #00ffcc;
        border-radius: 5px;
    }
    .chat-input button {
        background-color: #00ffcc;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
    }
</style>