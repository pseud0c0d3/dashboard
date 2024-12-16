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
    <link rel="stylesheet" href="/css/postPage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <img src="angel.png" alt="Loading..." id="loadingImage">
    </div>

    <!-- Main content and other structure -->
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="logo.png" alt="Angel Logo" class="angel-logo">
            <div class="profile-section">
                <a href="{{ route('loggedIn.userprofile') }}" class="profile-link" onclick="showLoading('userprofile.html')">
                    <img src="modpic.jpg" alt="Profile" class="profile-pic">
                    <div class="profile-details">
                        <p><strong>Joseph Chan</strong></p>
                        <p>Father</p>
                    </div>
                </a>
            </div>

            <ul class="menu">
                <li><a href="{{ route('loggedIn.user') }}" onclick="showLoading('user.html')"><i class="fas fa-home"></i> Home</a></li>
                <li>
                    <a href="#" onclick="toggleDropdown(event, 'activitiesDropdown')">
                        <i class="fas fa-tasks"></i> Activities <span class="dropdown-arrow">▼</span>
                    </a>
                    <ul class="dropdown" id="activitiesDropdown">
                        <li><a href="#" onclick="showLoading('activity1.html')">Activity 1</a></li>
                        <li><a href="#" onclick="showLoading('activity2.html')">Activity 2</a></li>
                    </ul>
                </li>
                <li><a href="#" onclick="showLoading('sched.html')"><i class="fas fa-calendar-alt"></i> Calendar</a></li>
            </ul>

            <div class="bottom-container">
                <ul class="menu">
                    <li><a href="#" onclick="showLoading('faq.html')"><i class="fas fa-question-circle"></i> Help</a></li>
                    <li><a href="#" onclick="showLoading('logout.html')"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
                </ul>
            </div>
        </div>

        <div class="headers">
            <div class="header">
                <div class="search-container">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="icons">
                    <i class="bi bi-chat-dots chat-icon" onclick="showLoading('chat.html')"></i>
                    <i class="bi bi-calendar-fill calendar-icon" onclick="openCalendar()"></i>
                    <i class="bi bi-bell notification-icon" onclick="openNotifications()"></i>
                    <i class="bi bi-gear settings-icon" onclick="toggleSettingsDropdown()"></i>
                </div>
                <!-- Settings Dropdown -->
                <div class="settings-dropdown" id="settingsDropdown">
                    <a href="#" onclick="changePassword()">Change Password</a>

                </div>
            </div>
            <!-- Notification Dropdown -->
            <div class="notifications-dropdown" id="notificationsDropdown">
                <ul>
                    <li><strong>New Comment:</strong> Someone commented on your post!</li>
                    <li><strong>New Like:</strong> Your post got a new like!</li>
                    <li><strong>Reminder:</strong> You have a meeting tomorrow at 10 AM.</li>
                </ul>
            </div>
            <div class="main-content">
                <div class="posts" id="postsContainer">
                    <div class="post-header">
                        <h2>Post Title</h2>
                        <p class="timestamp">Posted on: 2024-11-11</p>
                    </div>
                    <p class="post-content">This is the main post content.</p>

                    <!-- Main post comment section -->
                    <div class="comment-form">
                        <textarea id="mainPostComment" placeholder="Write your comment on this post..."></textarea>
                        <button onclick="submitMainPostComment()">Post Comment</button>
                    </div>

                    <div class="comments-section">
                        <h3>Comments</h3>
                        <ul id="commentsList">
                            <!-- Example Comment -->
                            <li id="comment-1">
                                <strong>James</strong> <span>2024-11-11</span>
                                <p>This is a comment from a user.</p>

                                <!-- Like button -->
                                <button class="like-btn" onclick="likeComment(1)">
                                    Like (<span id="like-count-1">0</span>)
                                </button>

                                <!-- Button to open reply form -->
                                <button class="reply-btn" onclick="toggleReplyForm(1)">Reply</button>

                                <!-- Reply Form -->
                                <div class="reply-form" id="reply-form-1">
                                    <textarea placeholder="Write your reply..." id="reply-text-1" oninput="checkMention(1)"></textarea>
                                    <button onclick="submitReply(1)">Submit Reply</button>
                                </div>

                                <!-- Replies to this comment -->
                                <ul class="replies-list" id="replies-list-1">
                                    <li>
                                        <strong>Pamela</strong> <span>2024-11-12</span>
                                        <p>This is a reply to the comment.</p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
 <!-- Calendar Modal Structure -->
 <div id="calendarModal" class="calendar-modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="calendar-modal-content bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 p-6">
        <span class="close-calendar cursor-pointer text-gray-500 hover:text-gray-800" onclick="closeCalendar()">&times;</span>
        <h3 class="font-semibold mb-2">Scheduled Events:</h3>
        <ul id="scheduledEventsList" class="list-disc pl-5">
            <li>Meeting with John - Oct 12, 2024</li>
            <li>Doctor's Appointment - Oct 14, 2024</li>
        </ul>
    </div>
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

        function updateProfile() {
            alert("Update profile functionality goes here.");
        }

        function openCalendar() {
            document.getElementById("calendarModal").style.display = "block";
        }
        function closeCalendar() {
            document.getElementById("calendarModal").style.display = "none";
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

        function logout() {
            alert("Log out functionality goes here.");
        }
//<------------------------------------------------------------------------------------------------------------------------->
        // Modal handling for adding new posts
        function openModal() {
            document.getElementById("addNewPost").style.display = "block";
        }

        function closeModal() {
            document.getElementById("addNewPost").style.display = "none";
        }

        // Function to navigate to the post page
        function goToPostPage(postId) {
            window.location.href = `post.html?postId=${postId}`;
        }

        // Show loading overlay for navigation
        function showLoading(url) {
            const loadingOverlay = document.getElementById("loadingOverlay");
            loadingOverlay.style.display = "flex";
            setTimeout(() => {
                window.location.href = url;
            }, 2000);
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
            // Close settings dropdown
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
//<----------------------------------------------------------------------------------------------------------->
// Submit a comment for the main post
function submitMainPostComment() {
    const mainCommentText = document.getElementById("mainPostComment").value;
    if (mainCommentText.trim() !== "") {
        const commentsList = document.getElementById("commentsList");

        // Create a new main post comment element
        const newComment = document.createElement('li');
        newComment.innerHTML = `
            <strong>YourUsername</strong> <span>${new Date().toLocaleDateString()}</span>
            <p>${mainCommentText}</p>
            <button class="reply-btn" onclick="toggleReplyForm(${commentsList.children.length + 1})">Reply</button>
            <div class="reply-form" id="reply-form-${commentsList.children.length + 1}">
                <textarea placeholder="Write your reply..." id="reply-text-${commentsList.children.length + 1}"></textarea>
                <button onclick="submitReply(${commentsList.children.length + 1})">Submit Reply</button>
            </div>
            <ul class="replies-list" id="replies-list-${commentsList.children.length + 1}"></ul>
        `;

        commentsList.appendChild(newComment);
        document.getElementById("mainPostComment").value = '';  // Clear the comment textarea
    } else {
        alert('Please write a comment before submitting.');
    }
}

// Toggle the reply form visibility
function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`reply-form-${commentId}`);
    const repliesList = document.getElementById(`replies-list-${commentId}`);
    replyForm.style.display = (replyForm.style.display === 'none' || !replyForm.style.display) ? 'block' : 'none';
    repliesList.style.display = 'block';  // Show the replies list when replying
}

// Submit a reply to a comment
function submitReply(commentId) {
    const replyText = document.getElementById(`reply-text-${commentId}`).value;
    if (replyText.trim() !== "") {
        const repliesList = document.getElementById(`replies-list-${commentId}`);

        // Create a new reply element
        const newReply = document.createElement('li');
        newReply.innerHTML = `
            <strong>YourUsername</strong> <span>${new Date().toLocaleDateString()}</span>
            <p>${replyText}</p>
        `;

        repliesList.appendChild(newReply);
        document.getElementById(`reply-text-${commentId}`).value = '';  // Clear the reply textarea
        toggleReplyForm(commentId);  // Hide the reply form after submission
    } else {
        alert('Please write something before submitting a reply.');
    }
}

// Function to like a comment
function likeComment(commentId) {
    const likeCountElement = document.getElementById(`like-count-${commentId}`);
    let likeCount = parseInt(likeCountElement.innerText);
    likeCount++;

    // Update the like count in the DOM
    likeCountElement.innerText = likeCount;
}

// Function to submit a comment on the main post
function submitMainPostComment() {
    const commentText = document.getElementById("mainPostComment").value;

    if (commentText) {
        const commentList = document.getElementById("commentsList");

        const newComment = document.createElement("li");
        newComment.id = `comment-${commentList.children.length + 1}`;
        newComment.innerHTML = `
            <strong>NewUser</strong> <span>2024-11-11</span>
            <p>${commentText}</p>

            <!-- Like button -->
            <button class="like-btn" onclick="likeComment(${commentList.children.length + 1})">
                Like (<span id="like-count-${commentList.children.length + 1}">0</span>)
            </button>

            <!-- Button to open reply form -->
            <button class="reply-btn" onclick="toggleReplyForm(${commentList.children.length + 1})">Reply</button>

            <!-- Reply Form -->
            <div class="reply-form" id="reply-form-${commentList.children.length + 1}">
                <textarea placeholder="Write your reply..." id="reply-text-${commentList.children.length + 1}"></textarea>
                <button onclick="submitReply(${commentList.children.length + 1})">Submit Reply</button>
            </div>

            <!-- Replies to this comment -->
            <ul class="replies-list" id="replies-list-${commentList.children.length + 1}">
            </ul>
        `;

        commentList.appendChild(newComment);
        document.getElementById("mainPostComment").value = '';  // Clear comment box
    }
}

</script>
</body></html>
