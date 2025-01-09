@extends('layouts.master')  

@section('content')
        

                <div class="main-content">

    {{-- <a class="navbar-brand" href="{{ route('posts.index') }}">Forum</a> --}}

                    <main class="py-4">
                          @include('posts.index')
                      </main>
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


    document.getElementById('currentDate').textContent = new Date().toLocaleString();
  </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
            @endsection
