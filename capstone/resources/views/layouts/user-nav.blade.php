    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AID OF ANGELS</title>
        <link rel="icon" type="image/x-icon" href="/img/logo.png">
        
        <!-- Consolidated CSS Imports -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet">
        
        <!-- Local CSS -->
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/userprofile.css">
        <link rel="stylesheet" href="/css/forum.css">
        <link rel="stylesheet" href="/css/faq.css">
        <link rel="stylesheet" href="/css/chat.css">
        <link rel="stylesheet" href="/css/calendar.css">
        <link rel="stylesheet" href="/css/adminchat.css">
        
        <!-- JavaScript Libraries -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
    </head>

    <style>
        :root {
            --primary-color: rgb(9, 9, 121);
            --secondary-color: rgba(0,212,255,1);
            --sidebar-gradient: linear-gradient(180deg, rgba(2,0,36,1) 0%, var(--primary-color) 0%, var(--secondary-color) 74%);
            --text-light: #ffffff;
            --text-dark: #333333;
            --transition-speed: 0.3s;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }
        /* Angelic Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%) !important;
            backdrop-filter: blur(12px);
            padding: 0.8rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1050;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.3);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.6rem;
            color: white;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            margin-right: 3rem;
        }

        /* Celestial Notification Dropdown */
        .notification-wrapper {
            position: relative;
            margin-right: 1.8rem;
        }

        .notification-btn {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
        }

        .notification-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px) scale(1.05);
        }

        .notification-badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background: #ff9a9e;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 800;
            color: white;
            border: 2px solid rgba(255,255,255,0.3);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.8; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); opacity: 0.8; }
        }

        .notification-dropdown {
            min-width: 360px;
            border-radius: 12px;
            border: none;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 0;
            overflow: hidden;
            margin-top: 15px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Heavenly Profile Dropdown */
        .profile-wrapper {
            position: relative;
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            border-radius: 50px;
            padding: 0.5rem 1rem 0.5rem 0.8rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .profile-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        .profile-dropdown {
            min-width: 240px;
            border-radius: 12px;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Divine Dropdown Items */
        .dropdown-item {
            color: #333 !important;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(58, 123, 213, 0.1) !important;
        }

        .dropdown-divider {
            border-color: rgba(0,0,0,0.05);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .navbar {
                padding: 0.8rem 1.5rem;
            }
            .profile-name {
                display: none;
            }
        }
        

        /* Sidebar Styles */
        .sidebar {
            background: var(--sidebar-gradient);
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1020;
            transition: all var(--transition-speed) ease;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            padding-top: 60px;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar.closed {
            transform: translateX(-100%);
        }

        .angel-logo {
            width: 80px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
            filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.5));
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin-bottom: 5px;
        }

        .menu li a {
            color: var(--text-light);
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-radius: 8px;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
        }

        .menu li a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .menu li a i {
            margin-right: 15px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .dropdown-list {
            list-style: none;
            padding-left: 20px;
            margin-top: 5px;
            display: none;
            background-color: rgba(0, 116, 224, 0.8);
            border-radius: 8px;
            overflow: hidden;
        }

        .dropdown-list li a {
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .dropdown-list li a:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .list-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            object-fit: contain;
        }

        .dropdown-arrow {
            margin-left: auto;
            font-size: 0.8rem;
            transition: transform var(--transition-speed) ease;
        }

        .menu li.active .dropdown-arrow {
            transform: rotate(180deg);
        }
        /* ONLY CHANGED THE DROPDOWN LIST ITEM HOVER - EVERYTHING ELSE REMAINS THE SAME */
    .dropdown-list li a:hover {
    background: rgba(255, 255, 255, 0.7) !important;
    color: #0d47a1 !important;
    transform: translateX(8px) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
    }

    /* EVERYTHING BELOW THIS IS EXACTLY THE SAME AS YOUR ORIGINAL CODE */

    :root {
    --sidebar-width: 280px;
    --transition-speed: 0.3s;
    --celestial-blue: #1976d2;
    --sky-gradient: #64b5f6;
    --halo-glow: #bbdefb;
    --cloud-white: #e3f2fd;
    }

    .sidebar {
    background: linear-gradient(160deg, 
        var(--celestial-blue) 0%, 
        var(--sky-gradient) 100%) !important;
    width: var(--sidebar-width);
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1020;
    box-shadow: 0 0 30px rgba(25, 118, 210, 0.4);
    overflow-y: auto;
    padding-top: 60px;
    }

    .cloud {
    position: absolute;
    background: white;
    border-radius: 50%;
    filter: blur(15px);
    opacity: 0.4;
    z-index: 0;
    }

    .cloud-1 {
    width: 120px;
    height: 40px;
    top: 20%;
    left: -30px;
    animation: cloudFloat 25s linear infinite;
    }

    .cloud-2 {
    width: 180px;
    height: 60px;
    top: 50%;
    right: -50px;
    animation: cloudFloat 30s linear infinite reverse;
    }

    .cloud-3 {
    width: 150px;
    height: 50px;
    bottom: 30%;
    left: 40%;
    animation: cloudFloat 35s linear infinite;
    }

    @keyframes cloudFloat {
    0% { transform: translateX(-100px) translateY(0); }
    50% { transform: translateX(50px) translateY(-20px); }
    100% { transform: translateX(300px) translateY(0); }
    }

    .angel-logo {
    width: 80px;
    height: auto;
    display: block;
    margin: 0 auto 20px;
    filter: 
        drop-shadow(0 0 8px rgba(100, 181, 246, 0.7))
        drop-shadow(0 0 15px rgba(187, 222, 251, 0.5));
    animation: gentleFloat 4s infinite ease-in-out;
    position: relative;
    z-index: 1;
    }

    @keyframes gentleFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
    }

    .menu li a {
    color: #0d47a1;
    text-decoration: none;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    border-radius: 8px;
    transition: all var(--transition-speed) ease;
    font-weight: 500;
    margin: 0 15px 5px;
    background: rgba(227, 242, 253, 0.9);
    border: 1px solid rgba(100, 181, 246, 0.3);
    position: relative;
    z-index: 1;
    }

    .menu li a:hover {
    background: rgba(255, 255, 255, 1);
    transform: translateX(5px);
    box-shadow: 
        0 0 10px rgba(100, 181, 246, 0.5),
        0 0 20px rgba(187, 222, 251, 0.3);
    }

    .dropdown-list {
    background: rgba(25, 118, 210, 0.15);
    border-radius: 8px;
    margin: 5px 15px;
    border-left: 3px solid var(--halo-glow);
    backdrop-filter: blur(5px);
    position: relative;
    z-index: 1;
    }

    .menu li a i {
    color: var(--celestial-blue);
    margin-right: 15px;
    transition: all 0.3s ease;
    }

    .menu li a:hover i {
    color: #0d47a1;
    transform: scale(1.1);
    }

    .close-sidebar-btn {
    background: rgba(100, 181, 246, 0.2);
    border: 1px solid var(--halo-glow);
    color: var(--celestial-blue);
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
    }

    .close-sidebar-btn:hover {
    background: var(--celestial-blue);
    color: white;
    }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all var(--transition-speed) ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Toggle Buttons */
        .toggle-sidebar-btn, .close-sidebar-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1040;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .close-sidebar-btn {
            left: auto;
            right: 10px;
            background-color: #dc3545;
        }

        /* Dropdown Menu */
        .custom-dropdown {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .custom-dropdown .dropdown-item {
            padding: 10px 15px;
            transition: all 0.2s ease;
        }

        .custom-dropdown .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 80%;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .user-name {
                display: none;
            }
        }

        /* Animation for active menu items */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .menu li a.active {
            animation: pulse 1s ease;
            background-color: rgba(255, 255, 255, 0.3);
        }
    </style>

    <body>
        <!-- Include Preloader -->
        @include('components.preloader')


    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                @yield('navbar_title')
            </a>
            
            <div class="d-flex align-items-center">
                <!-- Notifications -->
                <div class="notification-wrapper">
                    <button class="notification-btn" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-bell-fill fs-5"></i>
                        @if(count(Auth::user()->notifications->where('read_at', null)) > 0)
                            <span class="notification-badge" id="notificationBadge">
                                {{ count(Auth::user()->notifications->where('read_at', null)) }}
                            </span>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                        <div class="px-3 py-2" style="background: rgba(58, 123, 213, 0.1); border-bottom: 1px solid rgba(0,0,0,0.05);">
                            <h6 class="mb-0 fw-semibold" style="color: #3a7bd5;">LATEST NOTIFICATIONS</h6>
                        </div>
                        @forelse (Auth::user()->notifications->sortByDesc('created_at') as $notification)
                            <a class="dropdown-item d-flex justify-content-between align-items-center py-3 px-3" 
                            href="{{ route('notifications.showPost', $notification->id) }}"
                            style="border-bottom: 1px solid rgba(0,0,0,0.05);">
                                <span>{{ $notification->message }}</span>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        @empty
                            <a class="dropdown-item text-muted py-3 px-3 text-center" href="#">
                                No new notifications
                            </a>
                        @endforelse
                    </div>
                </div>

                <!-- Profile -->
                <div class="profile-wrapper ms-3">
                    <button class="profile-btn" type="button" data-bs-toggle="dropdown">
                        @if(Auth::check() && Auth::user()->picture)
                            <img src="{{ asset('storage/' . Auth::user()->picture) }}" 
                                class="rounded-circle" width="38" height="38" 
                                style="object-fit: cover; border: 2px solid rgba(255,255,255,0.5);">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=3a7bd5&color=fff&size=50" 
                                class="rounded-circle" width="38" height="38" 
                                style="border: 2px solid rgba(255,255,255,0.5);">
                        @endif
                        <span class="profile-name d-none d-lg-inline">{{ Auth::user()->name ?? 'Guest' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown mt-2 py-1">
                        <li><a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3" 
                            href="{{ route('user.faq') }}">
                            <i class="bi bi-question-circle fs-5" style="color: #3a7bd5;"></i> Help Center
                            </a></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li><a class="dropdown-item d-flex align-items-center gap-3 py-2 px-3" 
                            href="{{ route('user.logout') }}" style="color: #ff6b6b !important;">
                            <i class="bi bi-box-arrow-right fs-5"></i> Log Out
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

        <!-- Toggle Sidebar Button -->
        <button class="btn toggle-sidebar-btn d-md-none">
            <i class="bi bi-list"></i>
        </button>
        
        <div class="container-fluid p-0">


    <div class="sidebar">
    <div class="cloud cloud-1"></div>
    <div class="cloud cloud-2"></div>
    <div class="cloud cloud-3"></div>
    
    <img src="/img/logo.png" alt="Angel Logo" class="angel-logo">
    <button class="close-sidebar-btn d-md-none"><i class="bi bi-x-lg"></i></button>

    <ul class="menu">
        <li><a href="{{ route('user.profile') }}" id="prof"><i class="bi bi-person"></i> Profile</a></li>
        <li><a href="{{ route('user.forum') }}" id="form"><i class="fas fa-home"></i> Forum</a></li>
        <li>
        <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')">
            <i class="fas fa-tasks" id="act"></i> Activities <span class="dropdown-arrow">▼</span>
        </a>
        <ul class="dropdown-list" id="activitiesDropdown">
            <li>
            <a href="{{ route('workspace.colormatch') }}" id="act" onclick="showLoading('workspace.colormatch')">
                <img src="/img/colorgame.png" alt="Colormatch Icon" id="color" class="list-icon"> Colormatch Game
            </a>
            </li>
            <li>
            <a href="{{ route('workspace.game') }}" id="sound" onclick="showLoading('workspace.game')">
                <img src="/img/sound.png" alt="Sound Game Icon" class="list-icon"> Sound Game
            </a>
            </li>
        </ul>
        </li>
        <li><a href="{{ route('user.fullcalendar') }}" id="full"><i class="fas fa-calendar-alt"></i> Calendar</a></li>
        <li><a href="{{ route('user.support') }}" id="chat"><i class="bi bi-chat-dots"></i> Support</a></li>
    </ul>
    </div>
            <!-- Main Content -->
            <main class="py-4">
                <div class="main-content">
                    @yield('content')
                </div>
            </main>
        </div>

        <script>
            // Initialize variables
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            const toggleBtn = document.querySelector('.toggle-sidebar-btn');
            const closeBtn = document.querySelector('.close-sidebar-btn');
            
            // Toggle Sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('open');
                mainContent.classList.toggle('expanded');
            }
            
            // Close Sidebar
            function closeSidebar() {
                sidebar.classList.remove('open');
                mainContent.classList.remove('expanded');
            }
            
            // Toggle Dropdown
            function toggleDropdown(event, dropdownId) {
                event.preventDefault();
                event.stopPropagation();
                const dropdown = document.getElementById(dropdownId);
                const arrow = event.currentTarget.querySelector('.dropdown-arrow');
                
                if (dropdown.style.display === "block") {
                    dropdown.style.display = "none";
                    arrow.style.transform = "rotate(0deg)";
                } else {
                    dropdown.style.display = "block";
                    arrow.style.transform = "rotate(180deg)";
                }
            }
            
            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.dropdown-list') && !e.target.closest('.menu li a')) {
                    document.querySelectorAll('.dropdown-list').forEach(dropdown => {
                        dropdown.style.display = 'none';
                    });
                    document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
                        arrow.style.transform = "rotate(0deg)";
                    });
                }
            });
            
            // Event Listeners
            toggleBtn.addEventListener('click', toggleSidebar);
            closeBtn.addEventListener('click', closeSidebar);
            
            // Notification Badge
            const notificationBadge = document.getElementById('notificationBadge');
            const unreadNotifications = document.querySelectorAll('.notification-unread').length;
            
            if (unreadNotifications > 0) {
                notificationBadge.style.display = 'flex';
                notificationBadge.innerText = unreadNotifications;
            }
            
            // Preloader Functionality
            function showPreloaderAndRedirect(event) {
                event.preventDefault();
                document.getElementById('preloader').style.display = 'flex';
                const href = event.target.getAttribute('href');
                
                setTimeout(function() {
                    window.location.href = href;
                }, 1000);
            }
            
            // Add preloader event listeners
            function addPreloaderEventListener(id) {
                const element = document.getElementById(id);
                if (element && !element.hasAttribute('data-listener-added')) {
                    element.addEventListener('click', showPreloaderAndRedirect);
                    element.setAttribute('data-listener-added', 'true');
                }
            }
            
            // Attach preloader to all relevant elements
            ['prof', 'form', 'act', 'color', 'sound', 'full', 'chat'].forEach(id => {
                addPreloaderEventListener(id);
            });
            
            // Mark notification as read
            function markAsRead(event, notificationId) {
                fetch(`/notifications/mark-as-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: notificationId }),
                }).then(response => {
                    if (response.ok) {
                        event.target.classList.remove('notification-unread');
                        event.target.classList.add('notification-read');
                        
                        const updatedUnreadCount = document.querySelectorAll('.notification-unread').length;
                        if (updatedUnreadCount === 0) {
                            notificationBadge.style.display = 'none';
                        } else {
                            notificationBadge.innerText = updatedUnreadCount;
                        }
                    }
                }).catch(error => {
                    console.error("Error marking notification as read:", error);
                });
            }
            
            // Highlight active menu item based on current route
            document.addEventListener('DOMContentLoaded', function() {
                const currentPath = window.location.pathname;
                const menuItems = document.querySelectorAll('.menu li a');
                
                menuItems.forEach(item => {
                    if (item.getAttribute('href') === currentPath) {
                        item.classList.add('active');
                    }
                });
            });
        </script>
    </body>
    </html>