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
    <link rel="stylesheet" href="/css/faq.css">
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js   "></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


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
                        <li><a href="{{ route('workspace.colormatch') }}" onclick="showLoading('workspace.colormatch')">Colormatch Game</a></li>
                        <li><a href="{{ route('workspace.game') }}" onclick="showLoading('workspace.game')">Sound Game</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('loggedIn.calendar_user') }}"><i class="fas fa-calendar-alt"></i> Calendar</a></li>
            </ul>

            <div class="bottom-container">
                <ul class="menu">
                    <li><a href="{{ route('loggedIn.faq') }}" onclick="showLoading('faq.html')"><i class="fas fa-question-circle"></i> Help</a></li>
                    <li><a href="{{ route('logout') }}" onclick="showLoading('logout.html')"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                </ul>
            </div>
        </div>

        <div class="headers">
            <div class="header">
                <div class="icons">
                    <a href="{{ route('loggedIn.chat') }}">
                        <i class="bi bi-chat-dots chat-icon"></i>
                    </a>
                    <i class="bi bi-bell notification-icon" onclick="openNotifications()"></i>
                    <i class="bi bi-gear settings-icon" onclick="toggleSettingsDropdown()"></i>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <main class="py-4">
            <div class="main-content">
                @yield('content')


                <!-- Content from the specific page -->



            </div>
        </main>
    </div>
</body>
</html>
