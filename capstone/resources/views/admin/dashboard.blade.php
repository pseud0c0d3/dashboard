<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Admin</title>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js   "></script>

    <style>
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
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">Loading...</div>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="/img/logo.png" alt="Angel Logo" class="angel-logo">
            <div class="profile-section">
                <a href="{{ route('loggedIn.userprofile') }}" class="profile-link" onclick="showLoading('userprofile.html')">
                    <img src="/img/modpic.jpg" alt="Profile" class="profile-pic">
                    <div class="profile-details">
                        <p><strong>Joseph Chan</strong></p>
                        <p>Father</p>
                    </div>
                </a>
            </div>
            <ul class="menu">
                <li><a href="{{ route('loggedIn.user') }}" onclick="showLoading('user.html')"><i class="fas fa-home"></i> Forum</a></li>
                <li>
                    <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')">
                        <i class="fas fa-tasks"></i> Activities <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown" id="activitiesDropdown">
                        <li><a href="{{ route('workspace.colormatch') }}" onclick="showLoading('workspace.colormatch')">Activity 1</a></li>
                            <li><a href="{{ route('workspace.sonar') }}" onclick="showLoading('workspace.colormatch')">Activity 2</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('loggedIn.calendar') }}" onclick="showLoading('loggedIn.calendar')"><i class="fas fa-calendar-alt"></i> Calendar</a></li>            </ul>
            <div class="bottom-container">
                <ul class="menu">
                    <li><a href="#" onclick="showLoading('faq.html')"><i class="fas fa-question-circle"></i> Help</a></li>
                    <li><a href="#" onclick="showLoading('logout.html')"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                </ul>
            </div>
        </div>
        <div class="headers">
            <div class="header">
                <div class="search-container">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="icons">
                    <i class="bi bi-calendar-fill calendar-icon" onclick="openCalendar()"></i>
                    <i class="bi bi-bell notification-icon" onclick="openNotifications()"></i>
                    <i class="bi bi-gear settings-icon" onclick="toggleSettingsDropdown()"></i>
                </div>
                <!-- Settings Dropdown -->
                <div class="settings-dropdown" id="settingsDropdown">
                    <a href="#" onclick="changePassword()">Change Password</a>
                    <a href="#" onclick="updateProfile()">Update Profile</a>
                    <a href="#" onclick="logout()">Log Out</a>
                </div>
            </div>
            <!-- Notification Dropdown -->
            <div class="notifications-dropdown" id="notificationsDropdown">
                <ul>
                    <li><strong>New Comment:</strong> Someone commented on your post!</li>
                    <li><strong>New Like:</strong> Your post got a new like!</li>
                    <li><strong>Reminder:</strong> You have a meeting tomorrow at 10 AM.</li>
                </ul>
            </div>
            <div class="main-content">
                <div class="dashboard">
                    <div class="main">

                    </div>
                    <!-- Calendar Section -->
                    <div id='calendar'></div>
                </div>

            </div>
        <!-- Calendar Modal Structure -->
        <div id="calendarModal" class="calendar-modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="calendar-modal-content bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 p-6">
                <span class="close-calendar cursor-pointer text-gray-500 hover:text-gray-800" onclick="closeCalendar()">&times;</span>
                <h2 class="text-lg font-bold mb-4">Calendar</h2>
                <div id="calendar" class="mb-4">
                    <p>This is where your calendar will be displayed.</p>
                </div>
                <h3 class="font-semibold mb-2">Scheduled Events:</h3>
                <ul id="scheduledEventsList" class="list-disc pl-5">
                    <li>Meeting with John - Oct 12, 2024</li>
                    <li>Doctor's Appointment - Oct 14, 2024</li>
                </ul>
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

    </script>
</body>
</html>
