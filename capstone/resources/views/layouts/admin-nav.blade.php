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
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


        <!-- Bootstrap CSS -->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Bootstrap JS and dependencies (including jQuery and Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

</head>
<body>
       <!-- Include Preloader -->
 @include('components.preloader')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <!-- Dynamic Title -->
        <a class="navbar-brand">
            @yield('navbar_title') <!-- Default title is PROFILE -->
        </a>
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
<button class="close-sidebar-btn d-md-none" onclick="closeSidebar()">✖</button> <!-- Close button -->

<ul class="menu">
<li><a href="{{ route('admin.dashboard') }}" id="report"><i class="fas fa-chart-pie"></i> Report</a></li>
<li><a href="{{ route('admin.forum') }}" id="forum"><i class="fas fa-comments"></i> Forum</a></li>
<li><a href="{{ route('admin.fullcalendar') }}" id="full"><i class="fas fa-calendar-alt"></i> FullCalendar</a></li>
<li><a href="{{ route('appointments.index') }}" id="appoint"><i class="fas fa-calendar-check"></i> Appointments</a></li> <!-- Added icon for Appointments -->
<li><a href="{{ route('admin.clients') }}" id="client"><i class="fas fa-users"></i> Clients</a></li> <!-- Added icon for Clients -->
<li><a href="{{ route('admin.chats') }}" id="chat"><i class="bi bi-chat-dots"></i> Chats</a></li>
</ul>

<ul class="menu">
    <li><a href="{{ route('admin.logout') }}"method="GET" ><i class="fas fa-sign-out-alt" ></i> Log Out</a></li>
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
  
      
    // Toggle Sidebar and Navbar
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebar.classList.toggle('open');
    mainContent.classList.toggle('expanded');
    
    
}

    // Function to close the sidebar
    function closeSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.remove('open'); // Remove 'open' class to hide sidebar
        const mainContent = document.querySelector('.main-content');
        mainContent.classList.remove('expanded'); // Adjust main content
    }
// Function to show preloader and then navigate to the href
function showPreloaderAndRedirect(event) {
  event.preventDefault();  // Prevent the default behavior of the link
  
  // Show the preloader
  document.getElementById('preloader').style.display = 'flex';
  
  // Get the href from the clicked link
  const href = event.target.getAttribute('href');
  
  // Redirect after a short delay (1.5 seconds in this case)
  setTimeout(function() {
    window.location.href = href;
  }, 1500);  // Adjust the delay as needed
}

// Attach event listener to the 'Get Started' button
document.getElementById('report').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('form').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('full').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('appoint').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('client').addEventListener('click', showPreloaderAndRedirect);
document.getElementById('chat').addEventListener('click', showPreloaderAndRedirect);


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
