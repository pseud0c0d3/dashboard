<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AID OF ANGELS</title>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/userprofile.css">
    <link rel="stylesheet" href="/css/forum.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js   "></script>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
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
                <li><a href="{{ route('admin.calendar_admin') }}"><i class="fas fa-calendar-alt"></i> Calendar</a></li>
            </ul>

            <div class="bottom-container">
                <ul class="menu">
                    <li><a href="{{ route('loggedIn.faq') }}" onclick="showLoading('faq.html')"><i class="fas fa-question-circle"></i> Help</a></li>
                    <li><a href="{{ route('logout') }}" onclick="showLoading('logout.html')"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
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
                </div>
            </div>

            <!-- Content from the specific page -->
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
