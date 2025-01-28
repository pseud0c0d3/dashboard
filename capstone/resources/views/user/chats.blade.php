@extends('layouts.user-nav')
@section('content')

<link rel="stylesheet" href="/css/nav.css">

<style>
/* Prevent overlap of chat container with navbar */
.main-panel {
    margin-top: 50px; /* Adjust this value to match the height of the navbar */
}

.content-wrapper {
    padding-top: 20px; /* Extra space if needed */
}

/* Chat Window Styling */
.chat-window {
    height: 400px;
    overflow-y: auto;
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.chat-message-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.chat-message {
    display: flex;
    flex-direction: column;
    max-width: 70%;
}
.chat-message.sender {
    align-self: flex-end;
    background-color: #007bff;
    color: #fff;
    border-radius: 15px;
    padding: 10px;
    position: relative;
}
.chat-message.receiver {
    align-self: flex-start;
    background-color: #f1f1f1;
    color: #333;
    border-radius: 15px;
    padding: 10px;
}
.message-content {
    display: flex;
    flex-direction: column;
}

.timestamp {
    font-size: 0.8rem;
    color: #888;
    margin-top: 5px;
}

/* Input Styling */
.input-group {
    display: flex;
    align-items: center;
    border-top: 1px solid #ddd;
    padding-top: 10px;
}

#messageInput {
    border-radius: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    flex-grow: 1;
    margin-right: 10px;
    transition: border-color 0.3s ease;
}
#messageInput:focus {
    border-color: #007bff;
}

#sendMessageButton {
    border-radius: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

#sendMessageButton:hover {
    background-color: #0056b3;
}

.dropdown-menu {
    border-radius: 8px;
}

#chat_name {
    font-size: 1.25rem;
    font-weight: 600;
}

/* Smooth scrolling for chat */
.chat-window {
    scroll-behavior: smooth;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('posts.index') }}">CHAT</a>
        <!-- Dropdown Button with Image -->
<div class="dropdown ms-4">
    <button 
        class="btn btn-light dropdown-toggle d-flex align-items-center" 
        type="button" 
        id="navbarDropdown" 
        data-bs-toggle="dropdown" 
        aria-expanded="false"
    >
        <!-- Profile Picture or Initials -->
        @if(Auth::user()->picture)
            <img 
                src="{{ asset('storage/' . Auth::user()->picture) }}" 
                alt="Profile Picture" 
                class="rounded-circle img-fluid" 
                width="40" 
                height="40" 
                style="object-fit: cover; border: 2px solid #ddd;" 
            >
        @else
            <div 
                class="bg-light rounded-circle d-flex justify-content-center align-items-center shadow-sm" 
                style="width: 40px; height: 40px; border: 2px solid #ff5722;">
                <span class="h6 text-muted m-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
            </div>
        @endif

        <!-- User Name (Visible except on mobile) -->
        <span class="ms-2 user-name">{{ Auth::user()->name }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ route('user.faq') }}">Help</a></li>
        <li><a class="dropdown-item" href="{{ route('user.logout') }}">Log Out</a></li>
        <li><hr class="dropdown-divider"></li>
    </ul>
</div>

    </div>
</nav>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <br>
                    <div class="col-md-12 mt-4 grid-margin">
                        <div class="row">
                            <!-- Left column: Chat area (full width) -->
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <div class="d-flex align-items-center">
                                            <img src="/img/logo.png" class="rounded-circle mr-3"  style="width: 70px; height: 40px;">
                                            <h4 class="mb-0" id="chat_name">Aid of Angels</h4>
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
                                            <input type="hidden" name="receiver_id" id="receiver_id" value="1"> <!-- Default receiver ID -->
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
        <!-- content-wrapper ends -->
    </div>
</div>
<!-- Toggle Sidebar Button -->
<button class="btn toggle-sidebar-btn d-md-none" onclick="toggleSidebar()">
    ☰
</button>

<script src="{{ asset('/build/assets/app-D1ylovWN.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/7.0.3/pusher.min.js"></script>
<script>
var pusher = new Pusher('56ae557b83a4903265fc', {
cluster: 'ap1', // Ensure the cluster matches your Pusher configuration
encrypted: true
});

var channel = pusher.subscribe('my-channel'); // Subscribe to the channel

channel.bind('my-event', function(data) { // Bind the event
console.log('Message received:', data);

// Display the message in the chat container
if (data && data.message) {
let messageHtml = `
<div class="chat-message">
    <div class="message-content">
        <p><strong>${data.admin.name}:</strong> ${data.message}</p>
        <div class="timestamp">${new Date(data.created_at).toLocaleTimeString()}</div>
    </div>
</div>`;

$('#chatMessageContainer').append(messageHtml);

// Scroll to the bottom
$('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0].scrollHeight);
}
});


$(document).ready(function() {
    // Default receiver ID and profile setup
    const defaultReceiverId = 1; // Replace with the actual ID of the admin
    const defaultProfileName = "Aid of Angels";
    const defaultProfileImg = "{{ asset('public/img/logo.png') }}";

    // Set default values
    $('#receiver_id').val(defaultReceiverId);
    $('#chat_img').attr('src', defaultProfileImg);
    $('#chat_name').text('Chatting with ' + defaultProfileName);

    // Fetch and load messages on page load
    function loadMessages() {
        $.ajax({
            url: '{{ route('fetch.messagesFromSellerToAdmin') }}',
            method: 'GET',
            data: {
                receiver_id: defaultReceiverId
            },
            success: function(response) {
                $('#chatMessageContainer').empty();

                response.messages.forEach(function(message) {
                    let isSender = message.sender_id == '{{ Auth::id() }}';
                    let userAvatar = isSender ? '{{ asset('storage/' . Auth::user()->picture) }}' : defaultProfileImg;
                    let userName = isSender ? '{{ Auth::user()->name }}' : defaultProfileName;

                    let messageTime = new Date(message.created_at).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    let messageHtml = `
                        <div class="chat-message ${isSender ? 'sender' : 'receiver'}">
                            <div class="message-content">
                                <p><strong>${userName}:</strong> ${message.message}</p>
                                <div class="timestamp">${messageTime}</div>
                            </div>
                        </div>`;
                    $('#chatMessageContainer').append(messageHtml);
                });

                // Scroll to the bottom of the chat container
                $('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0].scrollHeight);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching messages:', error);
            }
        });
    }

    // Load messages on page load
    loadMessages();

    // Handle sending messages
    $('#messageForm').on('submit', function(e) {
        e.preventDefault();

        let message = $('#messageInput').val().trim();
        let receiverId = $('#receiver_id').val();

        if (message === "") {
            alert("Message cannot be empty.");
            return;
        }

        $.ajax({
            type: 'POST',
            url: '{{ route('send.Messageofsellertoadmin') }}',
            data: {
                _token: $('input[name="_token"]').val(),
                message: message,
                receiver_id: receiverId
            },
            beforeSend: function() {
                $('#sendMessageButton').text('Sending...').attr('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    // toastr.success(response.message, "Success");
                    $('#messageInput').val(''); // Clear the input

                    let userAvatar = '{{ asset('storage/' . Auth::user()->picture) }}';
                    let userName = '{{ Auth::user()->name }}';

                    let messageTime = new Date().toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    let messageHtml = `
                        <div class="chat-message sender">
                            <div class="message-content">
                                <p><strong>${userName}:</strong> ${message}</p>
                                <div class="timestamp">${messageTime}</div>
                            </div>
                        </div>`;
                    $('#chatMessageContainer').append(messageHtml);

                    // Scroll to the bottom of the chat container after sending a message
                    $('#chatMessageContainer').scrollTop($('#chatMessageContainer')[0].scrollHeight);
                } else {
                    toastr.error(response.message, "Error");
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseJSON.message);
                toastr.error('Failed to send message', "Error");
            },
            complete: function() {
                $('#sendMessageButton').text('Send').attr('disabled', false);
            }
        });
    });
});
</script>
@endsection
