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


    <body>
        <!-- Include Preloader -->
    @include('components.preloader')

    <nav class="navbar navbar-expand-lg navbar-dark  bg-primary">
    <div class="container-fluid">
        <!-- Dynamic Title -->
        <a class="navbar-brand">
            @yield('navbar_title') <!-- Default title is PROFILE -->
        </a>
        

        <div class="d-flex align-items-center">
            <!-- Notifications Dropdown with Badge -->
            <div class="dropdown me-3 position-relative">
    <button class="btn btn-secondary dropdown-toggle position-relative" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: white; color: black;">
        <i class="bi bi-bell-fill"></i>
        <span class="notification-badge" id="notificationBadge" style="display: none;">3</span>
    </button>
    <!-- Apply dropdown-menu-end class for proper alignment -->
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
        <!-- Notifications content -->
        @forelse (Auth::user()->notifications->sortByDesc('created_at') as $notification)
            <a class="dropdown-item" href="{{ route('notifications.showPost', $notification->id) }}">
                {{ $notification->message }} - <small>{{ $notification->created_at->diffForHumans() }}</small>
            </a>
        @empty
            <a class="dropdown-item" href="#">No new notifications</a>
        @endforelse

    </div>
</div>

            <!-- Profile Dropdown -->
<button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <!-- Profile Picture or Initials -->
    @if(Auth::check() && Auth::user()->picture)
        <img src="{{ asset('storage/' . Auth::user()->picture) }}" 
             alt="Profile Picture" 
             class="rounded-circle img-fluid" 
             width="40" height="40" 
             style="object-fit: cover; border: 2px solid #ddd;">
    @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=random&color=fff&size=50" 
             alt="Default Avatar" 
             class="rounded-circle img-fluid" 
             width="40" height="40" 
             style="border: 2px solid#000000;">
    @endif
    <span class="ms-2 user-name d-none d-lg-inline">{{ Auth::user()->name ?? 'Guest' }}</span>
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
    <!-- Sidebar -->
<div class="sidebar" style="background: rgb(249,255,0);
background: linear-gradient(0deg, rgba(249,255,0,0.8939950980392157) 0%, rgba(0,125,255,1) 38%);">
    <img src="/img/logo.png" alt="Angel Logo" class="angel-logo">
    <button class="close-sidebar-btn d-md-none" onclick="closeSidebar()">✖</button> <!-- Close button -->

    <ul class="menu" style="">
        <li><a href="{{ route('user.profile') }}" id="prof"><i class="bi bi-person"></i> Profile</a></li>
        <li><a href="{{ route('user.forum') }}" id="form"><i class="fas fa-home"></i> Forum</a></li>
        <li>
            <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')">
                <i class="fas fa-tasks" id="act"></i> Activities <span class="dropdown-arrow">▼</span>
            </a>
            <ul class="dropdown-list" id="activitiesDropdown" style="background-color:rgb(0, 116, 224);">
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
        <li><a href="{{ route('user.fullcalendar') }}" id="full"><i class="fas fa-calendar-alt"></i>FullCalendar</a></li>
        <li><a href="{{ route('user.chats') }}" id="chat"><i class="bi bi-chat-dots"></i> Chats</a></li>
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

    
        function showPreloaderAndRedirect(event) {
    event.preventDefault();  // Prevent the default behavior of the link

    // Show the preloader and hide the sidebar content
    document.getElementById('preloader').style.display = 'flex';
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'none';  // Hide the sidebar

    // Get the href from the clicked link
    const href = event.target.getAttribute('href');
    
    // Redirect after a short delay (1.5 seconds in this case)
    setTimeout(function() {
        window.location.href = href;
    }, 1000);  // Adjust the delay as needed
}


    // Function to add event listeners only once
    function addPreloaderEventListener(id) {
        const element = document.getElementById(id);
        
        // Check if the event listener is already attached
        if (element && !element.hasAttribute('data-listener-added')) {
            element.addEventListener('click', showPreloaderAndRedirect);
            element.setAttribute('data-listener-added', 'true'); // Mark that listener has been added
        }
    }

    // Attach event listener to the necessary sidebar elements
    addPreloaderEventListener('prof');
    addPreloaderEventListener('form');
    addPreloaderEventListener('act');
    addPreloaderEventListener('color');
    addPreloaderEventListener('sound');
    addPreloaderEventListener('full');
    addPreloaderEventListener('chat');


    // Toggle Notification Badge Visibility Based on Unread Notifications
    const notificationBadge = document.getElementById('notificationBadge');
    const unreadNotifications = document.querySelectorAll('.notification-unread').length;
    
    if (unreadNotifications > 0) {
        notificationBadge.style.display = 'inline-block';
        notificationBadge.innerText = unreadNotifications;
    }

    function markAsRead(event, notificationId) {
    // Mark the notification as read via AJAX or an API request
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

            // Update Badge Count
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

// Function to close the sidebar
function closeSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.remove('open'); // Close the sidebar
    const mainContent = document.querySelector('.main-content');
    mainContent.classList.remove('expanded'); // Adjust main content
}

        </script>
    </body>
    </html>
