    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AID OF ANGELS</title>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/user.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <style>
        .modal-content {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #a8dadc, #f1faee);
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.5s ease, transform 0.5s ease;
          }

          .modal.show .modal-content {
            opacity: 1;
            transform: translateY(0);
          }

          .modal-header {
            background-color: #457b9d;
            color: white;
            padding: 16px;
            text-align: center;
          }

          .modal-header h5 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
          }

          .modal-body {
            background-color: #f1faee;
            padding: 20px;
            animation: fadeIn 0.5s ease;
          }

          .modal-body img {
            width: 60px;
            height: 60px;
          }

          .modal-body input[type="text"],
          .modal-body textarea {
            border: 2px solid #457b9d;
            border-radius: 15px;
            padding: 12px;
            font-size: 16px;
            background-color: #ffffff;
          }

          .modal-footer {
            background-color: #e9f5f5;
            padding: 16px;
          }

          .modal-footer button {
            border-radius: 15px;
            transition: transform 0.2s ease;
          }

          .btn-primary {
            background-color: #457b9d;
            border-color: #457b9d;
            font-size: 16px;
          }

          .btn-primary:hover {
            background-color: #1d3557;
            border-color: #1d3557;
            transform: scale(1.05);
          }

          .btn-secondary {
            font-size: 16px;
            transition: transform 0.2s ease;
          }

          .btn-secondary:hover {
            transform: scale(1.05);
          }

          .modal-body small {
            font-size: 14px;
            color: #1d3557;
          }

            .modal-dialog {
                margin: auto;
                top: 0;
                transform: translate(0, 0);
            }.modal-backdrop {
                background-color: rgba(0, 0, 0, 0.5) !important;
            background-color: rgba(0, 0, 0, 0.5) !important;
            pointer-events: none;
            }

          /* Fade In Animation */
          @keyframes fadeIn {
            0% {
              opacity: 0;
            }
            100% {
              opacity: 1;
            }
          }

        </style>
    </head>

    <body>
        {{-- <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <img src="img/angel.png" alt="Loading..." id="loadingImage">
        </div> --}}

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
                    <li><a href="{{ route('loggedIn.user') }}" ><i class="fas fa-home"></i> Forum</a></li>
                    <li>
                        <a href="" onclick="toggleDropdown(event, 'activitiesDropdown')">
                            <i class="fas fa-tasks"></i> Activities <span class="dropdown-arrow">▼</span>
                        </a>
                        <ul class="dropdown" id="activitiesDropdown">
                            <li><a href="{{ route('workspace.colormatch') }}" onclick="showLoading('workspace.colormatch')">Activity 1</a></li>
                            <li><a href="{{ route('workspace.sonar') }}" onclick="showLoading('workspace.colormatch')">Activity 2</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('admin.calendar_admin') }}"><i class="fas fa-calendar-alt"></i> Calendar</a></li>                </ul>

                <div class="bottom-container">
                    <ul class="menu">
                        <li><a href="{{ route('loggedIn.faq') }}" onclick="showLoading('faq.html')"><i class="fas fa-question-circle"></i> Help</a></li>
                        <li>
                            <li><a href="{{ route('logout') }}" onclick="showLoading('logout.html')"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                        </li>
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

                            {{-- <a class="navbar-brand" href="{{ route('posts.index') }}">Forum</a> --}}

                    <main class="py-4">
                        @include('posts.index')
                    </main>
                </div>
            </div>
            <div class="bi bi-plus-circle add-post-icon" href="#" data-bs-toggle="modal" data-bs-target="#PostModal"></div>

            <!-- Modal -->
            <div class="modal fade" id="PostModal" tabindex="-1" aria-labelledby="PostModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="PostModalLabel">Create a Post!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <!-- Title Input -->
                                <input type="text" name="title" class="form-control mb-3" placeholder="Give your post a title!" required>

                                <!-- Body Input -->
                                <textarea name="body" class="form-control mb-3" placeholder="What do you want to share today?" rows="4" required></textarea>

                                <!-- Image Input (optional) -->
                                <input type="file" name="image" class="form-control mb-3" accept="image/webp, image/png, image/jpg">
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Post</button>
                            </div>
                        </form>
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

            let postIdCounter = 0;

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

    document.getElementById('currentDate').textContent = new Date().toLocaleString();
  </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
