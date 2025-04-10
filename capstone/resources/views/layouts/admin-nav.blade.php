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

    <style>
        :root {
            --celestial-blue: #1976d2;
            --sky-gradient: #64b5f6;
            --halo-glow: #bbdefb;
            --cloud-white: #e3f2fd;
            --sidebar-width: 250px;
            --transition-speed: 0.3s;
            --header-height: 56px;
            --menu-item-height: 44px;
            --logo-size: 70px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Sidebar Styles */
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
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
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
            width: var(--logo-size);
            height: auto;
            display: block;
            margin: 0 auto 15px;
            filter: 
                drop-shadow(0 0 8px rgba(100, 181, 246, 0.7))
                drop-shadow(0 0 15px rgba(187, 222, 251, 0.5));
            animation: gentleFloat 4s infinite ease-in-out;
            position: relative;
            z-index: 1;
        }

        @keyframes gentleFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .menu-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 10px 0;
            position: relative;
            z-index: 1;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .menu li {
            margin: 5px 15px;
        }

        .menu li a {
            color: #0d47a1;
            text-decoration: none;
            padding: 8px 15px;
            display: flex;
            align-items: center;
            border-radius: 6px;
            transition: all var(--transition-speed) ease;
            font-weight: 500;
            font-size: 0.9rem;
            background: rgba(227, 242, 253, 0.9);
            border: 1px solid rgba(100, 181, 246, 0.3);
            height: var(--menu-item-height);
        }

        .menu li a:hover {
            background: white;
            transform: translateX(5px);
            box-shadow: 0 2px 10px rgba(100, 181, 246, 0.3);
        }

        .menu li a i {
            color: var(--celestial-blue);
            margin-right: 15px;
            width: 20px;
            text-align: center;
            transition: all var(--transition-speed) ease;
        }

        .menu li a:hover i {
            transform: scale(1.1);
        }

        .close-sidebar-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1050;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 20px;
            min-height: calc(100vh - var(--header-height));
            transition: all var(--transition-speed) ease;
        }

        /* Toggle Button */
        .toggle-sidebar-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1040;
            background: white;
            color: var(--celestial-blue);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Active Menu Item */
        .menu li a.active {
            background: rgba(255,255,255,0.7);
            font-weight: 600;
            box-shadow: 0 0 10px rgba(100, 181, 246, 0.5);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }

        /* Animation for menu items */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .menu li {
            animation: fadeIn 0.3s ease forwards;
        }

        .menu li:nth-child(1) { animation-delay: 0.1s; }
        .menu li:nth-child(2) { animation-delay: 0.2s; }
        .menu li:nth-child(3) { animation-delay: 0.3s; }
        .menu li:nth-child(4) { animation-delay: 0.4s; }
        .menu li:nth-child(5) { animation-delay: 0.5s; }
        .menu li:nth-child(6) { animation-delay: 0.6s; }
        .menu li:nth-child(7) { animation-delay: 0.7s; }
    </style>
</head>
<body>
    <!-- Include Preloader -->
    @include('components.preloader')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="toggle-sidebar-btn d-md-none" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand">
                @yield('navbar_title')
            </a>
        </div>
    </nav>

    <!-- Non-scrollable Sidebar -->
    <div class="sidebar">
        <div class="cloud cloud-1"></div>
        <div class="cloud cloud-2"></div>
        <div class="cloud cloud-3"></div>
        
        <img src="/img/logo.png" alt="Angel Logo" class="angel-logo">
        <button class="close-sidebar-btn d-md-none" onclick="closeSidebar()">
            <i class="fas fa-times"></i>
        </button>

        <div class="menu-container">
            <ul class="menu">
                <li><a href="{{ route('admin.dashboard') }}" id="report"><i class="fas fa-chart-pie"></i> Report</a></li>
                <li><a href="{{ route('admin.forum') }}" id="forum"><i class="fas fa-comments"></i> Forum</a></li>
                <li><a href="{{ route('admin.fullcalendar') }}" id="full"><i class="fas fa-calendar-alt"></i> Calendar</a></li>
                <li><a href="{{ route('appointments.index') }}" id="appoint"><i class="fas fa-calendar-check"></i> Appointments</a></li>
                <li><a href="{{ route('admin.clients') }}" id="client"><i class="fas fa-users"></i> Clients</a></li>
                <li><a href="{{ route('admin.chats') }}" id="chat"><i class="bi bi-chat-dots"></i> Chats</a></li>
                <li><a href="{{ route('admin.logout') }}" id="logout"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <script>
        // Toggle Sidebar Visibility
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        }

        // Close Sidebar
        function closeSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.remove('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.querySelector('.toggle-sidebar-btn');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                event.target !== toggleBtn && 
                !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('open');
            }
        });

        // Perfectly fit menu items in sidebar
        function fitMenuItems() {
            const sidebar = document.querySelector('.sidebar');
            const menuContainer = document.querySelector('.menu-container');
            const menuItems = document.querySelectorAll('.menu li');
            const headerHeight = document.querySelector('.navbar').offsetHeight;
            const logoHeight = document.querySelector('.angel-logo').offsetHeight;
            const closeBtnHeight = document.querySelector('.close-sidebar-btn').offsetHeight;
            
            // Calculate available height
            const availableHeight = window.innerHeight - logoHeight - closeBtnHeight - 40; // 40px for padding
            
            // Calculate total menu height needed
            const menuHeight = Array.from(menuItems).reduce((total, item) => {
                return total + item.offsetHeight + (parseInt(getComputedStyle(item).marginTop) * 2);
            }, 0);
            
            // If menu is taller than available space, reduce item height
            if (menuHeight > availableHeight) {
                const newItemHeight = Math.floor(availableHeight / menuItems.length) - 10;
                document.documentElement.style.setProperty('--menu-item-height', `${newItemHeight}px`);
            }
            // If there's extra space, adjust spacing
            else {
                const extraSpace = availableHeight - menuHeight;
                const spacePerItem = Math.floor(extraSpace / (menuItems.length * 2));
                menuItems.forEach(item => {
                    item.style.marginTop = `${spacePerItem}px`;
                    item.style.marginBottom = `${spacePerItem}px`;
                });
            }
        }

        // Highlight active menu item
        function setActiveMenuItem() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu li a');
            
            menuItems.forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });
        }

        // Preloader for navigation
        function setupPreloader() {
            const links = ['report', 'forum', 'full', 'appoint', 'client', 'chat', 'logout'];
            
            links.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.addEventListener('click', function(event) {
                        event.preventDefault();
                        document.getElementById('preloader').style.display = 'flex';
                        setTimeout(() => {
                            window.location.href = this.getAttribute('href');
                        }, 500);
                    });
                }
            });
        }

        // Initialize everything when DOM loads
        document.addEventListener('DOMContentLoaded', function() {
            fitMenuItems();
            setActiveMenuItem();
            setupPreloader();
        });

        // Adjust on window resize
        window.addEventListener('resize', fitMenuItems);
    </script>
</body>
</html>