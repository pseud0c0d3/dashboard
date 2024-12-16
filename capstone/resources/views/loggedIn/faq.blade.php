<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AID OF ANGELS</title>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/faq.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Loading Overlay Styles */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: white; /* Transparent white background */
        z-index: 1000;
        justify-content: center;
        align-items: center;
        font-size: 24px;
    }

        /* Image styling and floating animation */
    #loadingImage {
        width: 300px; /* Adjust as needed */
        height: 300px; /* Adjust as needed */
        animation: float 2s ease-in-out infinite; /* Floating animation with ease-in-out */
    }


            /* Keyframes for floating animation */
    @keyframes float {
        0% {
            transform: translateY(0); /* Start at the original position */
        }
        50% {
            transform: translateY(-20px); /* Move up 20px */
        }
        100% {
            transform: translateY(0); /* Return to original position */
        }
    }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <img src="/img/angel.png" alt="Loading..." id="loadingImage">
    </div>

    <!-- Main content and other structure -->
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
                <li><a href="{{ route('loggedIn.user') }}" onclick="showLoading('user.html')"><i class="fas fa-home"></i> Home</a></li>
                <li>
                    <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')">
                        <i class="fas fa-tasks"></i> Activities <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown" id="activitiesDropdown">
                        <li><a href="{{ route('workspace.colormatch') }}" onclick="showLoading('workspace.colormatch')">Activity 1</a></li>
                            <li><a href="{{ route('workspace.sonar') }}" onclick="showLoading('workspace.colormatch')">Activity 2</a></li>
                    </ul>
                </li>
                <li><a href="#" onclick="showLoading('sched.html')"><i class="fas fa-calendar-alt"></i> Calendar</a></li>
            </ul>

            <div class="bottom-container">
                <ul class="menu">
                    <li><a href="{{ route('loggedIn.faq') }}" onclick="showLoading('faq.html')"><i class="fas fa-question-circle"></i> Help</a></li>
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
                    <i class="bi bi-chat-dots chat-icon" onclick="showLoading('{{ route('loggedIn.chat') }}')"></i>
                    <i class="bi bi-calendar-fill calendar-icon" onclick="openCalendar()"></i>
                    <i class="bi bi-bell notification-icon" onclick="openNotifications()"></i>
                    <i class="bi bi-gear settings-icon" onclick="toggleSettingsDropdown()"></i>
                </div>
                <!-- Settings Dropdown -->
                <div class="settings-dropdown" id="settingsDropdown">
                    <a href="#" onclick="changePassword()">Change Password</a>

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
                <div class="posts" id="postsContainer">
                    <div class="content-container">
                        <!-- FAQ Section -->
                        <div class="faq-section">
                            <h2>Frequently Asked Questions (FAQ)</h2>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h3>Q: Lorem?</h3>
                                    <i class="faq-toggle-icon"></i>
                                </div>
                                <p class="faq-answer">A: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis turpis euismod.</p>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h3>Q: How do I use the website?</h3>
                                    <i class="faq-toggle-icon"></i>
                                </div>
                                <p class="faq-answer">A: To use the website, create an account, and upload your items to start organizing your wardrobe.</p>
                            </div>
                        </div>

                        <!-- Forums Section -->
                        <div class="forums-section">
                            <h2>Using the Main Features</h2>
                            <h3>Forums</h3>
                            <p><strong>Overview:</strong> The Forums provide a space for users to discuss topics, share experiences, and seek advice.</p>
                            <h4>Step-by-Step Instructions:</h4>
                            <ol class="step-instructions">
                                <li><strong>Accessing the Forums:</strong>
                                    <ul>
                                        <li>Click on the Forums section in the main menu.</li>
                                        <li>Browse different categories and topics.</li>
                                    </ul>
                                </li>
                                <li><strong>Creating a New Post:</strong>
                                    <ul>
                                        <li>Select a Forum category that matches your topic.</li>
                                        <li>Click Create New Post.</li>
                                        <li>Enter a title and write your message in the provided text box.</li>
                                        <li>Click Post to publish your message.</li>
                                    </ul>
                                </li>
                            </ol>
                        </div>

                        <!-- Contact Section -->
                        <div class="contact-section">
                            <h2>Contact Us</h2>
                            <p>If you have any questions or feedback, feel free to reach out to us:</p>
                            <div class="contact-info">
                                <div class="visit-info">
                                    <h4>Visit Us:</h4>
                                    <p>San Juan General Trias, Cavite 4107<br>Inside, St. Francis School</p>
                                    <h4>Business Hours:</h4>
                                    <p>Mon-Fri: 8:00 AM – 5:00 PM</p>
                                </div>
                                <div class="social-media">
                                    <h4>Follow Us:</h4>
                                    <p><a href="https://www.facebook.com/aidofangels">Facebook</a></p>
                                    <p><a href="https://www.instagram.com/aidofangels">Instagram</a></p>
                                    <p><a href="https://www.twitter.com/aidofangels">Twitter</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
 <script>
            function openModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.classList.add('show');
}

function closeModal(modalId) {
    var modal = document.getElementById(modalId);
    modal.classList.remove('show');
}
        // Show loading overlay for navigation
        function showLoading(url) {
            const loadingOverlay = document.getElementById("loadingOverlay");
            loadingOverlay.style.display = "flex";
            setTimeout(() => {
                window.location.href = url;
            }, 2000);
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


        function openCalendar() {
            document.getElementById("calendarModal").style.display = "block";
        }
        function closeCalendar() {
            document.getElementById("calendarModal").style.display = "none";
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isHidden = sidebar.style.display === 'none' || sidebar.style.display === '';
            sidebar.style.display = isHidden ? 'flex' : 'none';
        }


        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

//<------------------------------------------------------------------------------------------------------------------------->

// Select all FAQ items
const faqItems = document.querySelectorAll('.faq-item');

// Add click event listener to each FAQ item
faqItems.forEach(item => {
    item.addEventListener('click', () => {
        // Toggle 'active' class to show or hide the answer
        item.classList.toggle('active');
    });
});


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




    </script>
</body>
</html>
