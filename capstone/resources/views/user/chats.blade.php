@extends('layouts.user-nav')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <br>
                    <div class="col-md-12 mt-4 grid-margin">
                        <div class="row">
                            <!-- Left column: Chat area (moved to the left) -->
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

                            <!-- Right column: Chat list (moved to the right) -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0">Chats</h4>
                                    </div>
                                    <div class="list-group chat-list" id="chatList" style="max-height: 500px; overflow-y: auto;">
                                        <ul class="list-group list-group-flush">
                                            @foreach ($admins as $admin)
                                            <li class="list-group-item d-flex align-items-center chat-item">
                                                <img src="{{ asset('storage/' . $admin->picture) }}" class="profile_img rounded-circle mr-3" style="width: 40px; height: 40px;" alt="Profile Picture">
                                                <div class="profile_info">
                                                    <span class="profile_name font-weight-bold">{{ $admin->name }}</span>
                                                    <span class="id" style="display: none;">{{ $admin->id }}</span>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
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

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<script src="{{ asset('/build/assets/app-D1ylovWN.js') }}"></script>

<!-- container-scroller -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- plugins:js -->
<script src="/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="/vendors/chart.js/Chart.min.js"></script>
<script src="/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="/js/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="/js/off-canvas.js"></script>
<script src="/js/hoverable-collapse.js"></script>
<script src="/js/template.js"></script>
<script src="/js/settings.js"></script>
<script src="/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/js/dashboard.js"></script>
<script src="/js/Chart.roundedBarCharts.js"></script>
<!-- End custom js for this page-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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

</script> 
<!-- JavaScript to handle profile card click -->
<script>
$(document).ready(function() {
// Bind click event to the chat-item list elements
$('.chat-item').on('click', function() {
let profileImage = $(this).find('.profile_img').attr('src');
let profileName = $(this).find('.profile_name').text();
let receiverId = $(this).find('.id').text();
$('#receiver_id').val(receiverId);
$('#chat_img').attr('src', profileImage);
$('#chat_name').text('Chatting with ' + profileName);

// Fetch messages
$.ajax({
url: '{{ route('fetch.messagesFromSellerToAdmin') }}',
method: 'GET',
data: {
    receiver_id: receiverId
},
success: function(response) {
    $('#chatMessageContainer').empty();

    response.messages.forEach(function(message) {
        let isSender = message.sender_id == '{{ Auth::id() }}';
        let userAvatar = isSender ? '{{ asset('storage/' . Auth::user()->picture) }}' : profileImage;
        let userName = isSender ? '{{ Auth::user()->name }}' : profileName;

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
});

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
// Disable the send button and change its text to "Sending..."
$('#sendMessageButton').text('Sending...').attr('disabled', true);
},
success: function(response) {
if (response.success) {
    toastr.success(response.message, "Success");
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
// Re-enable the send button and change its text back to "Send"
$('#sendMessageButton').text('Send').attr('disabled', false);
}
});
});
});
</script>
@endsection
