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
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js   "></script>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


</head>
<body>
    <div class="container">
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
  <!-- Sidebar -->
<div class="sidebar">
<button class="close-sidebar" onclick="closeSidebar()">×</button>
    <img src="/img/logo.png" alt="Angel Logo" class="angel-logo">
    <!-- Button to open sidebar on mobile -->



    <!-- Profile Section -->
    {{-- <div class="profile-section">
        <a href="{{ route('user.profile') }}" class="profile-link">
            <img src="/img/modpic.jpg" alt="Profile" class="profile-pic">
            <div class="profile-details">
                <p><strong>Joseph Chan</strong></p>
                <p>Father</p>
            </div>
        </a>
    </div> --}}

            <ul class="menu">
                <li><a href="{{ route('user.profile') }}"><i class="bi bi-person"></i> Profile</a></li>
                <li><a href="{{ route('user.forum') }}"><i class="fas fa-home"></i> Forum</a></li>
                <li>
                    <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')">
                    <i class="fas fa-tasks"></i> Activities <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown-list" id="activitiesDropdown">
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

    <!-- Bottom Menu -->
    <div class="bottom-container">
        <ul class="menu">
            <li><a href="{{ route('user.faq') }}"><i class="fas fa-question-circle"></i> Help</a></li>
            <li><a href="{{ route('user.logout') }}"method="GET"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
        </ul>
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


// Function to toggle the sidebar (for mobile mode)
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const toggleButton = document.querySelector('.menu-toggle');
    const closeButton = document.querySelector('.close-sidebar');
    const body = document.body;

    sidebar.classList.toggle('open'); // Toggle 'open' class for showing/hiding sidebar


    // Function to open sidebar
    toggleButton.addEventListener('click', () => {
        sidebar.classList.add('open'); // Open sidebar
        body.classList.add('sidebar-open'); // Add class to shift main content
    });

    // Function to close sidebar
    closeButton.addEventListener('click', () => {
        sidebar.classList.remove('open'); // Close sidebar
        body.classList.remove('sidebar-open'); // Remove class to reset main content
    });
    // Hide or show the toggle button and close button based on sidebar state
    if (sidebar.classList.contains('open')) {
        toggleButton.style.display = 'none'; // Hide menu-toggle when sidebar is open
        closeButton.style.display = 'block'; // Show close button when sidebar is open
    } else {
        toggleButton.style.display = 'block'; // Show menu-toggle when sidebar is closed
        closeButton.style.display = 'none'; // Hide close button when sidebar is closed
    }
}

// Function to close the sidebar
function closeSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const toggleButton = document.querySelector('.menu-toggle');
    const closeButton = document.querySelector('.close-sidebar');

    sidebar.classList.remove('open'); // Remove 'open' class to hide sidebar
    toggleButton.style.display = 'block'; // Show the toggle button again
    closeButton.style.display = 'none'; // Hide the close button when sidebar is closed
}

// Event listener to adjust visibility of buttons when resizing the window
window.addEventListener('resize', function() {
    const sidebar = document.querySelector('.sidebar');
    const toggleButton = document.querySelector('.menu-toggle');
    const closeButton = document.querySelector('.close-sidebar');

    if (window.innerWidth > 768) {
        // On desktop mode, hide both buttons and the sidebar should be visible
        toggleButton.style.display = 'none';
        closeButton.style.display = 'none';
        sidebar.classList.remove('open'); // Make sure the sidebar is hidden
    } else {
        // On mobile mode, show the menu toggle button
        toggleButton.style.display = 'block';
        if (!sidebar.classList.contains('open')) {
            closeButton.style.display = 'none'; // Hide close button if sidebar is not open
        }
    }
});


</script>
</body>
</html>
