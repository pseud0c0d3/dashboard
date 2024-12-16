<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    
  
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
        <button class="menu-toggle" onclick="toggleSidebar()">Menu</button>
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="logo.png" alt="Angel Logo" class="angel-logo">
            <div class="profile-section">
                <a href="userprofile.html" class="profile-link" onclick="showLoading('userprofile.html')">
                    <img src="modpic.jpg" alt="Profile" class="profile-pic">
                    <div class="profile-details">
                        <p><strong>Joseph Chan</strong></p>
                        <p>Father</p>
                    </div>
                </a>
            </div>
            
            <ul class="menu">
                <li><a href="user.html" onclick="showLoading('user.html')"><i class="fas fa-home"></i> Home</a></li>
                <li>
                    <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')"><i class="fas fa-tasks"></i> Activities ▼</a>
                    <ul class="dropdown" id="activitiesDropdown">
                        <li><a href="#"><i class="fas fa-running"></i> Activity 1</a></li>
                        <li><a href="#"><i class="fas fa-biking"></i> Activity 2</a></li>
                    </ul>
                </li>
                <li>
                    <a href="sched.html" onclick="toggleDropdown(event, 'calendarDropdown')"><i class="fas fa-calendar-alt"></i> Calendar ▼</a>
                    <ul class="dropdown" id="calendarDropdown">
                        <li><a href="#"><i class="fas fa-calendar-check"></i> Event 1</a></li>
                        <li><a href="#"><i class="fas fa-calendar-day"></i> Event 2</a></li>
                    </ul>
                </li>
                <li><a href="faq.html"><i class="fas fa-question-circle"></i> Help</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
            </ul>
        </div>      

        <div class="headers">
            <div class="header">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="icons">
      
                    <i class="calendar-icon" onclick="openCalendar()">📅</i>
                    <i class="notification-icon" onclick="openNotifications()">🔔</i>
                    <i class="settings-icon" onclick="toggleSettingsDropdown()">⚙️</i>
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
                    <div class="stats">
                      <div class="stat-box">
                        <h3>Total Registered Users</h3>
                        <p id="total-users">00</p>
                      </div>
                      <div class="stat-box">
                        <h3>Upcoming Appointments</h3>
                        <p id="upcoming-appointments">00</p>
                      </div>
                      <div class="stat-box">
                        <h3>Daily Interaction in Forums</h3>
                        <p id="daily-interaction">00</p>
                      </div>
                    </div>
                
                    <!-- Main Content Area -->
                    <div class="main">
                      <p>Main content goes here...</p>
                    </div>
                
                    <!-- Appointments Receipt Section -->
                    <div class="appointments">
                      <h3>Appointments Receipt</h3>
                      <ul id="appointment-list">
                        <li>Joseph Chan | 09/30/2024 | <span class="status accepted">Accepted</span></li>
                        <li>Example User | 10/02/2024 | <span class="status accepted">Accepted</span></li>
                        <li>Example User | 12/19/2024 | <span class="status reschedule">Reschedule</span></li>
                        <li>Example User | 02/03/2025 | <span class="status cancel">Cancel</span></li>
                      </ul>
                      <button id="view-all-btn">View All Appointments</button>
                    </div>
                  </div>
                
            </div>
        </div>
    </div>

    <script>
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

        function showLoading(url) {
            const loadingOverlay = document.getElementById("loadingOverlay");
            loadingOverlay.style.display = "flex"; 
          
            setTimeout(() => {
                window.location.href = url; 
            }, 1000); 
        }
        //Notifications 
        function openNotifications() {
            toggleDropdown(event, 'notificationsDropdown');
        }

        // Settings
        function toggleSettingsDropdown() {
            toggleDropdown(event, 'settingsDropdown');
        }

        //for settings options
        function changePassword() {
            alert("Change password functionality goes here.");
        }

        function updateProfile() {
            alert("Update profile functionality goes here.");
        }

        function logout() {
            alert("Log out functionality goes here.");
        }

        //Modal
        

        //Calendar
        function openCalendar() {
            document.getElementById("calendarModal").style.display = "block";
        }

        function closeCalendar() {
            document.getElementById("calendarModal").style.display = "none";
        }

        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isHidden = sidebar.style.display === 'none' || sidebar.style.display === '';
            sidebar.style.display = isHidden ? 'flex' : 'none';
        }

        let lastOpenedDropdown = null;

        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            const dropdown = document.getElementById(dropdownId);

            if (lastOpenedDropdown && lastOpenedDropdown !== dropdown) {
                lastOpenedDropdown.style.display = "none";
            }

            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";

            
            lastOpenedDropdown = dropdown.style.display === "block" ? dropdown : null;
        }

        // Close the menu if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('.menu-toggle')) {
                const dropdowns = document.getElementsByClassName("dropdown");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.style.display === 'block') {
                        openDropdown.style.display = 'none';
                    }
                }
            }
            
            if (event.target === document.getElementById('calendarModal')) {
                closeCalendar();
            }
        }

        function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.classList.add('show');
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.classList.remove('show');
}


    </script>
</body>
</html>
