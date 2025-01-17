@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 mt-4 grid-margin">
        <div class="row">
            <!-- Left column: Chat list -->
            <div class="col-md-4 col-lg-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Chats</h4>
                    </div>
                    <div class="list-group chat-list" id="chatList" style="max-height: 500px; overflow-y: auto;">
                        <ul class="list-group list-group-flush">
                            @if($chats->isEmpty())
                                <!-- If no chats found, show all users -->
                                @isset($users)  <!-- Check if $users is set -->
                                    @foreach ($users as $user)
                                        <li class="list-group-item d-flex align-items-center chat-item">
                                            <img src="{{ asset('storage/' . $user->picture) }}" class="profile_img rounded-circle mr-3" style="width: 40px; height: 40px;" alt="Profile Picture">
                                            <div class="profile_info">
                                                <span class="profile_name font-weight-bold">{{ $user->name }}</span>
                                                <span class="id" style="display: none;">{{ $user->id }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                @endisset
                            @else
                                <!-- If chats are found, display chat profiles -->
                                @foreach ($chats as $chat)
                                    <li class="list-group-item d-flex align-items-center chat-item">
                                        @if ($chat->sender_id == session('LoggedAdminInfo'))
                                            <!-- Display receiver profile -->
                                            @if ($chat->receiver)
                                                <img src="{{ asset('storage/' . $chat->receiver->picture) }}" class="profile_img rounded-circle mr-3" style="width: 40px; height: 40px;" alt="Profile Picture">
                                                <div class="profile_info">
                                                    <span class="profile_name font-weight-bold">{{ $chat->receiver->name }}</span>
                                                </div>
                                            @else
                                                <div class="profile_info">
                                                    <span class="profile_name font-weight-bold">Receiver not found</span>
                                                </div>
                                            @endif
                                        @else
                                            <!-- Display sender profile -->
                                            @if ($chat->sender)
                                                <img src="{{ asset('storage/' . $chat->sender->picture) }}" class="profile_img rounded-circle mr-3" style="width: 40px; height: 40px;" alt="Profile Picture">
                                                <div class="profile_info">
                                                    <span class="profile_name font-weight-bold">{{ $chat->sender->name }}</span>
                                                </div>
                                            @else
                                                <div class="profile_info">
                                                    <span class="profile_name font-weight-bold">Sender not found</span>
                                                </div>
                                            @endif
                                        @endif
                                        <span class="id" style="display: none;">{{ $chat->sender_id == session('LoggedAdminInfo') ? $chat->receiver_id : $chat->sender_id }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        
                    </div>
                </div>
            </div>

            <!-- Right column: Chat area -->
            <div class="col-md-8 col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <img id="chat_img" src="" class="rounded-circle mr-3" alt="Profile Picture" style="width: 40px; height: 40px;">
                            <h4 class="mb-0" id="chat_name">Chatting with</h4>
                        </div>
                    </div>

                    <div class="card-body chat-window" style="height: 400px; overflow-y: auto;">
                        <div class="chat-message-container" id="chatMessageContainer">
                            <!-- Chat messages will be dynamically loaded here -->
                        </div>
                    </div>

                    <div class="card-footer">
                        <form id="messageForm" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" id="receiver_id">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type your message here..." id="messageInput" name="message">
                                <button class="btn btn-primary" type="submit" id="sendMessageButton">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




                </div>

                <div class="col-12 grid-margin stretch-card">
                    <div class="card">

                    </div>
                </div>



        </div>
        <!-- Calendar Modal Structure -->

    </div>
<!------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------->
    <script>
        // Show loading overlay for navigation
        function showLoading(url) {
            const loadingOverlay = document.getElementById("loadingOverlay");
            loadingOverlay.style.display = "flex";
            setTimeout(() => {
                window.location.href = url;
            }, 1000);
        }

        function openNotifications() {
            toggleDropdown(event, 'notificationsDropdown');
        }

        function toggleSettingsDropdown() {
            toggleDropdown(event, 'settingsDropdown');
        }

        function changePassword() {
            alert("Change password functionality goes here.");
        }

        function updateProfile() {
            alert("Update profile functionality goes here.");
        }

        function openCalendar() {
            document.getElementById("calendarModal").style.display = "block";
        }
        function closeCalendar() {
            document.getElementById("calendarModal").style.display = "none";
        }

                // Toggle sidebar visibility
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isHidden = sidebar.style.display === 'none' || sidebar.style.display === '';
            sidebar.style.display = isHidden ? 'flex' : 'none';
        }

                // Toggle dropdown menus
        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }
        function logout() {
            alert("Log out functionality goes here.");
        }
//<------------------------------------------------------------------------------------------------------------------------->

    // Dummy data to simulate chat histories for each contact
    const chats = {
        'User 1': [
            { sender: 'contact', message: "Hello! How can I assist you today?" },
            { sender: 'user', message: "I have a question regarding the recent diagnosis." }
        ],
        'User 2': [
            { sender: 'contact', message: "Hi! How are you doing?" },
            { sender: 'user', message: "I'm doing well, thank you!" }
        ],
        'User 3': [
            { sender: 'contact', message: "Good morning!" },
            { sender: 'user', message: "Good morning! Can you help me?" }
        ]
    };

    let currentContact = 'User 1'; // Default contact to display chat

    // Function to load chat messages for a specific contact
    function loadChat(contact) {
        const chatMessages = document.querySelector('.chat-messages');
        chatMessages.innerHTML = ''; // Clear existing messages
        currentContact = contact;

        // Load chat history for selected contact
        chats[contact].forEach(chat => {
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', chat.sender);

            // Profile image
            const img = document.createElement('img');
            img.src = chat.sender === 'contact' ? '/img/profile.jpg' : `${contact.toLowerCase().replace(' ', '')}.jpg`;
            img.alt = contact;

            // Message bubble
            const messageBubble = document.createElement('div');
            messageBubble.classList.add('message-bubble');
            messageBubble.innerText = chat.message;

            messageElement.appendChild(img);
            messageElement.appendChild(messageBubble);
            chatMessages.appendChild(messageElement);
        });
    }

    // Load chat when a contact is clicked
    document.querySelectorAll('.contacts-list li').forEach(contactEl => {
        contactEl.addEventListener('click', () => {
            const contactName = contactEl.innerText;
            document.querySelector('.chat-box h3').innerText = `Chat with ${contactName}`;
            loadChat(contactName);
        });
    });

    // Function to send a new message
    document.querySelector('.chat-input button').addEventListener('click', sendMessage);
    document.querySelector('.chat-input input').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') sendMessage();
    });

    function sendMessage() {
        const inputField = document.querySelector('.chat-input input');
        const messageText = inputField.value.trim();
        if (!messageText) return; // Don't send empty messages

        // Display the new message in the chat box
        const chatMessages = document.querySelector('.chat-messages');
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', 'user');

        // Profile image for the user
        const img = document.createElement('img');
        img.src = `${currentContact.toLowerCase().replace(' ', '')}.jpg`;
        img.alt = currentContact;

        // Message bubble for the user message
        const messageBubble = document.createElement('div');
        messageBubble.classList.add('message-bubble');
        messageBubble.innerText = messageText;

        messageElement.appendChild(img);
        messageElement.appendChild(messageBubble);
        chatMessages.appendChild(messageElement);

        // Add to chat history (simulating database update)
        if (!chats[currentContact]) chats[currentContact] = [];
        chats[currentContact].push({ sender: 'user', message: messageText });

        // Clear input field and scroll to bottom
        inputField.value = '';
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Load the default contact's chat history initially
    loadChat(currentContact);

        // Close dropdowns if clicked outside
        window.onclick = function(event) {
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                if (dropdown.style.display === "block") {
                    dropdown.style.display = "none";
                }
            });
            // Close settings dropdown
            const settingsDropdown = document.getElementById('settingsDropdown');
            if (settingsDropdown.style.display === "block") {
                settingsDropdown.style.display = "none";
            }
        };



        function copyPostLink(postId) {
            const postLink = `${window.location.origin}/post/${postId}`;
            navigator.clipboard.writeText(postLink).then(() => {
                alert("Post link copied to clipboard!");
            }).catch(err => {
                console.error("Failed to copy: ", err);
            });
        }

    </script>
</body>
</html>
@endsection
