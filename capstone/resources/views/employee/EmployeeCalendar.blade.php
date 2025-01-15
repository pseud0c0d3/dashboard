@extends('layouts.employee')
@section('content')
{{-- <style>
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }
</style> --}}

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



    <div class="card mb4">
        <div class="card-body">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#scheduleModal">
                Add New Schedule
            </button>
            <h4 class="card-title">AOA Calendar</h4>
            <!-- Embed Google Calendar using iframe -->
            <iframe src="https://calendar.google.com/calendar/embed?src=516f3464e40f5ff34efa39bb945e36b6ad4f2ef00cbc164da549b86cc923a6ad%40group.calendar.google.com&ctz=Asia%2FManila"
                style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            <br><br>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel">New Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('calendar.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Appointment For</label>
                        <textarea name="name" id="name" class="form-control" cols="60" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description</label>
                        <textarea name="description" id="description" class="form-control" cols="60" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="meeting_date" class="form-label">Choose a Date</label>
                        <input type="date" name="meeting_date" id="meeting_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="meeting_time" class="form-label">Choose a Time</label>
                        <input type="time" name="meeting_time" id="meeting_time" class="form-control" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!------------------------------------------------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------------------------------------------->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar')
    const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: { center: 'dayGridMonth,timeGridWeek,timeGridDay' },

        views: {
            dayGridMonth: { // name of view
            titleFormat: { year: 'numeric', month: 'long' }
            // other view-specific options here
            }
        }

    })
    calendar.render()
    })
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

    //calendar section
    // //calendar


    document.addEventListener('DOMContentLoaded', function() {
      // Initialize stats (mock data)
      const totalUsers = 50;
      const upcomingAppointments = 5;
      const dailyInteraction = 10;

      document.getElementById('total-users').textContent = totalUsers;
      document.getElementById('upcoming-appointments').textContent = upcomingAppointments;
      document.getElementById('daily-interaction').textContent = dailyInteraction;

      // View all appointments button functionality
      document.getElementById('view-all-btn').addEventListener('click', function() {
        alert('View All Appointments clicked!');
      });
    });

    //make fulcalendar fetch google calendar data

    document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            center: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '/admin/get-google-calendar-events', // Fetch events from your controller
    });
    calendar.render();
    });

    </script>


@endsection
