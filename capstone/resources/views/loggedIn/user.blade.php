@extends('layouts.master')

@section('content')
<div class="main-content">

    {{-- <a class="navbar-brand" href="{{ route('posts.index') }}">Forum</a> --}}

    <main class="py-4">
        @include('posts.index')
    </main>
</div>

<!-- Modal for Adding Post -->
<div id="addNewPost" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Create Post</h4>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <!-- User Profile Section -->
            <div class="user-profile">
                <img src="profile.jpg" class="profile-pic">
                <div class="user-details">
                    <span class="user-name">Joseph Chan</span>
                </div>
            </div>
            <!-- Post Content Section -->
            <div class="post-content">
                <input type="text" id="postTitle" class="post-title-input" placeholder="Title of your Post" required>
                <textarea id="postContent" class="post-body-input" placeholder="Add more details to your post..." required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="post-button" onclick="addNewPost()">Post</button>
            <button class="cancel-button" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>
<!-- End Modal -->

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

// Modal handling for adding new posts
function openModal() {
    document.getElementById("addNewPost").style.display = "block";
}

function closeModal() {
    document.getElementById("addNewPost").style.display = "none";
}

let postIdCounter = 0;
// Add a new post
function addNewPost() {
    const title = document.getElementById("postTitle").value;
    const content = document.getElementById("postContent").value;
    const timestamp = new Date().toLocaleDateString();

    if (title && content) {
        postIdCounter++;
        const postId = postIdCounter;

        const post = document.createElement("div");
        post.className = "post";
        post.id = `post-${postId}`;
        post.innerHTML = `
        <div class="user-info">
            <div class="user-avatar"></div>
            <div class="user-details">
                <p class="username">exampleUser</p>
                <p class="timestamp">${timestamp}</p>
            </div>
            <div class="ellipsis-container">
                <button class="ellipsis-btn" onclick="toggleMenu(this)">...</button>
                <div class="dropdown-content">
                    <button onclick="reportPost()">Report Post</button>
                </div>
            </div>
        </div>
        <div class="post-title">${title}</div>
        <div class="post-content">${content}</div>
        <div class="post-buttons">
            <button class="action-btn">Like</button>
            <button class="action-btn" onclick="goToPostPage('${postId}')">Comment</button>
            <button class="action-btn" onclick="copyPostLink('${postId}')">Share</button>
        </div>
        `;

        const postsContainer = document.querySelector(".posts");
        postsContainer.appendChild(post);

        document.getElementById("postTitle").value = "";
        document.getElementById("postContent").value = "";

        closeModal();
    } else {
        alert("Please fill in both fields.");
    }
}

// Function to navigate to the post page
function goToPostPage(postId) {
    window.location.href = `postPage.html?postId=${postId}`;
}

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

    // Close notifications dropdown
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
</script>
@endsection
