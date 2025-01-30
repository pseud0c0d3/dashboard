<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AID OF ANGELS</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/userprofile.css">
    <link rel="stylesheet" href="/css/forum.css">
    <link rel="stylesheet" href="/css/faq.css">
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="/css/calendar.css">
    <link rel="stylesheet" href="/css/adminchat.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


    <!-- Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS and dependencies (including jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<style>
    
/* When the sidebar is toggled */
#navbar.expanded {
    margin-left: 250px; /* Match sidebar expansion */
}

#main-content.expanded {
    margin-left: 250px; /* Match sidebar expansion */
}
/* Mobile responsive styles */
@media (max-width: 768px) {
    .sidebar {
        left: -100%; /* Hide the sidebar initially off-screen */
    }

    .sidebar.open {
        left: 0; /* Show the sidebar when open */
    }

    .main-content {
        margin-left: 0; /* Default margin for mobile */
    }

    .main-content.expanded {
        margin-left: 250px; /* Add space when sidebar is open */
    }
    
}

</style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <!-- Dynamic Title -->
        <a class="navbar-brand">
            @yield('navbar_title') <!-- Default title is PROFILE -->
        </a>

        <!-- In your Blade view (resources/views/layouts/app.blade.php or wherever you want the dropdown) -->

        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Notifications
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @forelse (Auth::user()->notifications as $notification)
                    <a class="dropdown-item" href="{{ route('notifications.read', $notification->id) }}">
                        {{ $notification->message }} - <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </a>
                @empty
                    <a class="dropdown-item" href="#">No new notifications</a>
                @endforelse
            </div>
        </div>
        


            
    <button 
        class="btn btn-light dropdown-toggle d-flex align-items-center" 
        type="button" 
        id="navbarDropdown" 
        data-bs-toggle="dropdown" 
        aria-expanded="false"
    >
        <!-- Profile Picture or Initials -->
        @if(Auth::user()->picture)
            <img 
                src="{{ asset('storage/' . Auth::user()->picture) }}" 
                alt="Profile Picture" 
                class="rounded-circle img-fluid" 
                width="40" 
                height="40" 
                style="object-fit: cover; border: 2px solid #ddd;" 
            >
        @else
            <div 
                class="bg-light rounded-circle d-flex justify-content-center align-items-center shadow-sm" 
                style="width: 40px; height: 40px; border: 2px solid #ff5722;">
                <span class="h6 text-muted m-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
            </div>
        @endif

        <!-- User Name (Hidden on mobile, visible on larger screens) -->
        <span class="ms-2 user-name d-none d-lg-inline">{{ Auth::user()->name }}</span>
    </button>

    <!-- Dropdown Menu (Updated with proper positioning) -->
    <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-sm custom-dropdown" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ route('user.faq') }}">Help</a></li>
        <li><a class="dropdown-item" href="{{ route('user.logout') }}">Log Out</a></li>
        <li><hr class="dropdown-divider"></li>
    </ul>
</div>

    </div>
</nav>

<!-- Toggle Sidebar Button -->
<button class="btn toggle-sidebar-btn d-md-none" onclick="toggleSidebar()">
    ☰
</button>
<div class="container">
        <!-- Sidebar -->
<div class="sidebar" style="background-image: url(/img/bak.jpg); ">
    <img src="/img/logo.png" alt="Angel Logo" class="angel-logo">
    <ul class="menu">
        <li><a href="{{ route('user.profile') }}"><i class="bi bi-person"></i> Profile</a></li>
        <li><a href="{{ route('user.forum') }}"><i class="fas fa-home"></i> Forum</a></li>
        <li>
            <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')">
            <i class="fas fa-tasks"></i> Activities <span class="dropdown-arrow">▼</span>
            </a>
            <ul class="dropdown-list" id="activitiesDropdown" style="background-color: #23486A;">
                <li>
                    <a href="{{ route('workspace.colormatch') }}" onclick="showLoading('workspace.colormatch')">
                        <img src="/img/colorgame.png" alt="Colormatch Icon" class="list-icon"> Colormatch Game
                    </a>
                </li>
                <li>
                    <a href="{{ route('workspace.game') }}" onclick="showLoading('workspace.game')">
                        <img src="/img/sound.png" alt="Sound Game Icon" class="list-icon"> Sound Game
                    </a>
                </li>
            </ul>
        </li>
        <li><a href="{{ route('user.fullcalendar') }}"><i class="fas fa-calendar-alt"></i>FullCalendar</a></li>
        <li><a href="{{ route('user.chats') }}"><i class="bi bi-chat-dots"></i> Chats</a></li>
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
        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            const dropdown = document.getElementById(dropdownId);
            if (dropdown) {
                const isHidden = dropdown.style.display === "none" || !dropdown.style.display;
                dropdown.style.display = isHidden ? "block" : "none";
            }
        }

        // Ensure clicking outside the dropdown closes it
        document.addEventListener('click', () => {
            const dropdowns = document.querySelectorAll('.dropdown-list');
            dropdowns.forEach(dropdown => {
                dropdown.style.display = 'none';
            });
        });

  
      
    // Toggle Sidebar and Navbar
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebar.classList.toggle('open');
    mainContent.classList.toggle('expanded');
    
    
}


    // Ensure clicking outside the dropdown closes it
    document.addEventListener('click', () => {
        const dropdowns = document.querySelectorAll('.dropdown-list');
        dropdowns.forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    });

    // Function to close the sidebar
    function closeSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.remove('open'); // Remove 'open' class to hide sidebar
        const mainContent = document.querySelector('.main-content');
        mainContent.classList.remove('expanded'); // Adjust main content
    }


    </script>
</body>
</html>
