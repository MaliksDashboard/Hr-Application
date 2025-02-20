{{-- @extends('layouts.master')
@section('title', 'Live Chat')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-id" content="{{ Auth::check() ? Auth::id() : '' }}">

<!-- Pusher JS Link -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.1/echo.iife.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

@section('main')
    <div class="main">
        <h2>Chat</h2>
        <div class="container chat-container">

            <!-- User List -->
            <div class="user-list">
                <input type="search" placeholder="Search.." style="width: 100%; padding: 10px; margin-bottom: 10px;">
                @foreach ($users as $user)
                    <div class="user-item {{ $user->id === $mostRecentUserId ? 'active' : '' }}"
                        data-id="{{ $user->id }}">
                        <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="user-avatar">
                        <div class="user-info" style="width:100%;">
                            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                <h4>{{ $user->name }}</h4>
                                <p style="font-weight: bold; color: var(--primary-color);">
                                    @if (isset($lastMessages[$user->id]))
                                        @php
                                            $messageTime = \Carbon\Carbon::parse($lastMessages[$user->id]->created_at);
                                            $currentDate = \Carbon\Carbon::now();

                                            if ($messageTime->isToday()) {
                                                echo $messageTime->format('h:i A'); // e.g., "3:00 PM"
                                            } elseif ($messageTime->isYesterday()) {
                                                echo 'Yesterday';
                                            } elseif ($messageTime->diffInDays($currentDate) <= 6) {
                                                echo $messageTime->format('l'); // e.g., "Monday"
                                            } else {
                                                echo $messageTime->format('d-m-Y'); // e.g., "01-01-2025"
                                            }
                                        @endphp
                                    @endif
                                </p>
                            </div>
                            <p class="last-message">
                                {{ $lastMessages[$user->id]->message ?? 'Click to start chatting' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="chat-box-main" style="position: relative;">
                <div class="chat-box-receiver">
                    @if ($receiver)
                        <img src="{{ $receiver->image ? asset('storage/' . $receiver->image) : '/path/to/default-image.jpg' }}"
                            alt="{{ $receiver->name }}">
                        <p>{{ $receiver->name }}</p>
                    @else
                        <img src="/path/to/default-image.jpg" alt="No Receiver">
                        <p>Select a user to start chatting</p>
                    @endif
                </div>

                <span class="line" style="top: 14%"></span>

                <div id="chat-box" class="chat-box"></div>
                <!-- Message Input -->
                <form id="chat-form" class="chat-form">
                    <input type="text" id="message-input" placeholder="Type a message..." required>
                    <button type="submit"> <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M48 0H0v48h48z" fill="#fff" fill-opacity=".01" />
                            <path d="M43 5 29.7 43l-7.6-17.1L5 18.3z" stroke="#fff" stroke-width="4"
                                stroke-linejoin="round" />
                            <path d="M43 5 22.1 25.9" stroke="#fff" stroke-width="4" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {
        let selectedUserId = document.querySelector('.user-item.active')?.dataset.id || null;
        const chatBox = document.getElementById('chat-box');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const userId = document.querySelector('meta[name="user-id"]').content;
        let pollInterval;

        // Load messages for a selected user
        function loadMessages(userId) {
            fetch(`/chat/messages?receiver_id=${userId}`)
                .then(response => response.json())
                .then(messages => {
                    chatBox.innerHTML = ''; // Clear existing messages
                    messages.forEach(msg => {
                        const senderName = msg.sender ? msg.sender.name : 'Unknown';
                        const senderImage = msg.sender && msg.sender.image ?
                            `/storage/${msg.sender.image}` :
                            '/path/to/default-image.jpg';
                        addMessageToChatBox(senderName, msg.message, senderImage, msg.sender_id ===
                            parseInt(userId));
                    });
                })
                .catch(error => console.error('Error loading messages:', error));
        }

        // Start polling for new messages
        function startPolling() {
            if (pollInterval) clearInterval(pollInterval); // Avoid overlapping intervals
            pollInterval = setInterval(() => {
                if (selectedUserId) loadMessages(selectedUserId);
            }, 4000);
        }

        // Stop polling
        function stopPolling() {
            if (pollInterval) clearInterval(pollInterval);
        }

        // Send a new message
        chatForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const message = messageInput.value.trim();

            if (!selectedUserId) {
                alert('Please select a user to chat with!');
                return;
            }

            if (!message) {
                alert('Message cannot be empty!');
                return;
            }

            fetch('/chat/messages', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        receiver_id: selectedUserId,
                        message,
                    }),
                })
                .then(async (response) => {
                    if (!response.ok) {
                        const errorText = await response.text();
                        throw new Error(`Server error: ${response.status} - ${errorText}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    addMessageToChatBox('Me', message, data.sender.image ||
                        '/path/to/default-image.jpg', true);
                    messageInput.value = ''; // Clear input field
                })
                .catch((error) => {
                    console.error('Error sending message:', error);
                    alert(`Error: ${error.message}`);
                });
        });

        // Add message to chat box
        function addMessageToChatBox(sender, message, avatar, isMe = false) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', isMe ? 'message-receiver' : 'message-sender');

            const avatarImage = avatar ?
                `<img src="${avatar}" alt="${sender}" class="message-avatar">` :
                '';

            messageDiv.innerHTML = `
        ${isMe ? avatarImage : ''}
        <div class="message-content">
            <span>${isMe ? sender : 'Me'}</span>
            <p>${message}</p>
        </div>
        ${!isMe ? avatarImage : ''}
    `;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll
        }


        // Select a user for private chat
        document.querySelectorAll('.user-item').forEach(user => {
            user.addEventListener('click', () => {
                selectedUserId = user.dataset.id;
                document.querySelectorAll('.user-item').forEach(u => u.classList.remove(
                    'active'));
                user.classList.add('active');

                // Update receiver info
                const receiverImage = user.querySelector('img').src;
                const receiverName = user.querySelector('h4').innerText;

                const receiverImgElement = document.querySelector('.chat-box-receiver img');
                const receiverNameElement = document.querySelector('.chat-box-receiver p');

                receiverImgElement.src = receiverImage;
                receiverImgElement.alt = receiverName;
                receiverNameElement.textContent = receiverName;

                loadMessages(selectedUserId); // Load messages
                startPolling(); // Start polling for new messages
            });
        });

        // Load the most recent chat on page load
        if (selectedUserId) {
            document.querySelector(`.user-item[data-id="${selectedUserId}"]`)?.classList.add('active');
            loadMessages(selectedUserId);
            startPolling();
        }

        // Clean up on page unload
        window.addEventListener('beforeunload', stopPolling);
    });
</script>


<style>
    .chat-container {
        margin: 0 auto;
        display: flex;
        gap: 20px;
        width: 100%;
    }

    .user-list {
        width: 30%;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background-color: white;
        overflow-y: auto;
        height: 700px;
    }

    .user-item {
        display: flex;
        gap: 10px;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
        align-items: center;
    }

    .user-item:hover,
    .user-item.active {
        background-color: #e6f7ff;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .user-info h4 {
        margin: 0;
        font-size: 16px;
    }

    .user-info p {
        margin: 0;
        font-size: 12px;
        color: gray;
    }

    .chat-box {
        border-radius: 8px;
        height: 500px;
        width: 100%;
        overflow-y: auto;
        padding: 10px;
        width: 100%;
        overflow: auto;
    }

    .chat-form {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        justify-content: center;
        align-items: center;
    }

    #message-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    button {
        padding: 10px 20px;
        background-color: var(--third-color);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: .2s ease-in-out;
        margin-top: 4px;
    }

    button:hover {
        transform: scale(1.05);
    }

    .message {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 10px;
    }

    .message-sender {
        justify-content: flex-end;
        text-align: right;
    }

    .message-sender .message-content {
        background-color: #007bff;
        color: white;
        border-top-right-radius: 0;
    }

    .message-receiver .message-content {
        background-color: #e6e6e6;
        border-top-left-radius: 0;
    }

    .message-receiver {
        justify-content: flex-start;
        text-align: left;
    }

    .message-content {
        max-width: 60%;
        padding: 10px;
        border-radius: 8px;
        background-color: #f1f1f1;
    }

    .message-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .message span {
        font-weight: bold;
        display: block;
    }

    .chat-box-main {
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: center;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid var(--light-color);
        max-height: 700px;
    }

    .chat-box-receiver {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .chat-box-receiver img {
        width: 40px;
        height: 40px;
        border-radius: 5px;
    }

    .chat-box-receiver p {
        font-weight: bold;
        color: var(--primary-color);
    }
</style> --}}
