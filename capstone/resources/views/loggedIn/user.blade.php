    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AID OF ANGELS</title>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/user.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    </head>
    <body>
        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <img src="img/angel.png" alt="Loading..." id="loadingImage">
        </div>

        <!-- Main content and other structure -->
        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <img src="img/logo.png" alt="Angel Logo" class="angel-logo">
                <div class="profile-section">
                    <a href="#" class="profile-link" onclick="showLoading('userprofile.html')">
                        <img src="modpic.jpg" alt="Profile" class="profile-pic">
                        <div class="profile-details">
                            <p><strong>Joseph Chan</strong></p>
                            <p>Father</p>
                        </div>
                    </a>
                </div>

                <ul class="menu">
                    <li><a href="#" onclick="showLoading('user.html')"><i class="fas fa-home"></i> Home</a></li>
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
                        <i class="bi bi-chat-dots chat-icon" onclick="showLoading('chat.html')"></i>
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
                    <div class="posts" id="postsContainer"></div>
                </div>
            </div>
        </div>
            <!-- Calendar Modal Structure -->
            <div id="calendarModal" class="calendar-modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                <div class="calendar-modal-content bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 p-6">
                    <span class="close-calendar cursor-pointer text-gray-500 hover:text-gray-800" onclick="closeCalendar()">&times;</span>
                    <h3 class="font-semibold mb-2">Scheduled Events:</h3>
                    <ul id="scheduledEventsList" class="list-disc pl-5">
                        <li>Meeting with John - Oct 12, 2024</li>
                        <li>Doctor's Appointment - Oct 14, 2024</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bi bi-plus-circle add-post-icon" onclick="openModal()"></div>
    <!------------------------------------------------------------------------------------------------------------------------------>
        <!-- Modal for Adding Post -->
        <div id="addNewPost" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Create Post</h4>
                    <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <!-- User Profile Section -->
                    <div class="user-profile">
                        <img src="profile.jpg" class="profile-pic">
                        <div class="user-details">
                            <span class="user-name">Joseph Chan</span>
                        </div>
                    </div>
                    <!-- Post Content Section -->
                    <div class="post-content">
                        <input type="text" id="postTitle" class="post-title-input" placeholder="Title of your Post" required>
                        <textarea id="postContent" class="post-body-input" placeholder="Add more details to your post..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="post-button" onclick="addNewPost()">Post</button>
                    <button class="cancel-button" onclick="closeModal()">Cancel</button>
                </div>
            </div>
        </div>
    <!------------------------------------------------------------------------------------------------------------------------->
        <script>
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
    //<------------------------------------------------------------------------------------------------------------------------->
            // Modal handling for adding new posts
            function openModal() {
                document.getElementById("addNewPost").style.display = "block";
            }

            function closeModal() {
                document.getElementById("addNewPost").style.display = "none";
            }

            let postIdCounter = 0;
            // Add a new post
            function addNewPost() {
                const title = document.getElementById("postTitle").value;
                const content = document.getElementById("postContent").value;
                const timestamp = new Date().toLocaleDateString();

                if (title && content) {
                    postIdCounter++;
                    const postId = postIdCounter;

                    const post = document.createElement("div");
                    post.className = "post";
                    post.id = `post-${postId}`;
                    post.innerHTML = `
                        <div class="user-info">
                            <div class="user-avatar"></div>
                            <div class="user-details">
                                <p class="username">exampleUser</p>
                                <p class="timestamp">${timestamp}</p>
                            </div>
                            <div class="ellipsis-container">
                                <button class="ellipsis-btn" onclick="toggleMenu(this)">...</button>
                                <div class="dropdown-content">
                                    <button onclick="reportPost()">Report Post</button>
                                </div>
                            </div>
                        </div>
                        <div class="post-title">${title}</div>
                        <div class="post-content">${content}</div>
                        <div class="post-buttons">
                            <button class="action-btn">Like</button>
                            <button class="action-btn" onclick="goToPostPage('${postId}')">Comment</button>
                            <button class="action-btn" onclick="copyPostLink('${postId}')">Share</button>
                        </div>
                    `;

                    const postsContainer = document.querySelector(".posts");
                    postsContainer.appendChild(post);

                    document.getElementById("postTitle").value = "";
                    document.getElementById("postContent").value = "";

                    closeModal();
                } else {
                    alert("Please fill in both fields.");
                }
            }

            // Function to navigate to the post page
            function goToPostPage(postId) {
                window.location.href = `postPage.html?postId=${postId}`;
            }

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
                // Close settings dropdown
                const notificationsDropdown = document.getElementById('notificationsDropdown');
                if (notificationsDropdown.style.display === "block") {
                    notificationsDropdown.style.display = "none";
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
