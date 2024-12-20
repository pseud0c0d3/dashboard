<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AID OF ANGELS</title>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="sched.css">
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
                <li><a href="{{ route('loggedIn.calendar') }}" onclick="showLoading('loggedIn.calendar')"><i class="fas fa-calendar-alt"></i> Calendar</a></li>            </ul>

            <div class="bottom-container">
                <ul class="menu">
                    <li><a href="{{ route('loggedIn.faq') }}" onclick="showLoading('faq.html')"><i class="fas fa-question-circle"></i> Help</a></li>
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
                    <i class="bi bi-chat-dots chat-icon" onclick="showLoading('{{ route('loggedIn.chat') }}')"></i>
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
                <div class="posts" id="postsContainer"></div>

            </div>

        </div>
<!-- Comment Modal -->
<div id="commentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Comments</h2>
        <div id="commentsList" class="comments-list">
            <!-- Existing comments will be appended here -->
        </div>
        <textarea id="commentTextArea" placeholder="Write your comment here..."></textarea>
        <button onclick="submitComment()">Submit Comment</button>
    </div>
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

        <!-- Calendar Modal Structure -->
        <div id="calendarModal" class="calendar-modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="calendar-modal-content bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 p-6">
                <span class="close-calendar cursor-pointer text-gray-500 hover:text-gray-800" onclick="closeCalendar()">&times;</span>
                <h2 class="text-lg font-bold mb-4">Calendar</h2>
                <div id="calendar" class="mb-4">
                    <p>This is where your calendar will be displayed.</p>
                </div>
                <h3 class="font-semibold mb-2">Scheduled Events:</h3>
                <ul id="scheduledEventsList" class="list-disc pl-5">
                    <li>Meeting with John - Oct 12, 2024</li>
                    <li>Doctor's Appointment - Oct 14, 2024</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="chat-icon" id="chatIcon" onclick="toggleContactList()">💬</div>

    <div id="contactListModal" class="contacts-modal">
        <div class="contacts-header">
            <span>Contacts</span>
        </div>
        <div class="contacts-body">
            <div class="contact" onclick="openChat('Dr. Lebron')">
                <img src="https://via.placeholder.com/40" alt="Profile Picture"> <!-- Placeholder for profile image -->
                <span class="contact-name">Dr. Lebron</span> <!-- Contact name beside profile image -->
            </div>
            <div class="contact" onclick="openChat('Jane Smith')">
                <img src="https://via.placeholder.com/40" alt="Profile Picture"> <!-- Placeholder for profile image -->
                <span class="contact-name">Jane Smith</span> <!-- Contact name beside profile image -->
            </div>
            <div class="contact" onclick="openChat('Alice Johnson')">
                <img src="https://via.placeholder.com/40" alt="Profile Picture"> <!-- Placeholder for profile image -->
                <span class="contact-name">Alice Johnson</span> <!-- Contact name beside profile image -->
            </div>
        </div>
    </div>

    <div id="chatWindow" class="chat-window">
        <div class="chat-header" id="chatHeader">
            <img src="https://via.placeholder.com/40" alt="Profile Picture" id="contactProfile" style="border-radius: 50%; width: 30px; height: 30px; vertical-align: middle; margin-right: 5px;">
            Chat with <span id="contactName"></span>
            <button class="close-chat" onclick="closeChat()">✖</button>
        </div>
        <div class="messages" id="messagesContainer"></div>
        <div class="message-input">
            <input type="text" id="messageInput" placeholder="Type a message..." />
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <script>
        // Assuming you have the post ID and comment data
function createCommentElement(comment, postId) {
    const commentElement = document.createElement('div');
    commentElement.className = 'comment';

    // Create a link that navigates to the post page
    commentElement.innerHTML = `
        <img src="${comment.profilePicture}" alt="${comment.username}'s profile picture" class="profile-picture" />
        <div class="comment-details">
            <strong>${comment.username}</strong>
            <p>
                <a href="post.html?postId=${postId}">${comment.text}</a>
            </p>
        </div>
    `;
    return commentElement;
}

// Load comments from the mock data source (within your modal logic)
function loadComments(postId) {
    const commentsList = document.getElementById('commentsList');
    commentsList.innerHTML = ''; // Clear previous comments

    const comments = commentsData[postId] || [];
    comments.forEach(comment => {
        const commentElement = createCommentElement(comment, postId);
        commentsList.appendChild(commentElement);
    });
}




        function toggleContactList() {
            const modal = document.getElementById("contactListModal");
            modal.style.display = modal.style.display === "block" ? "none" : "block";
        }


        function openChat(contact) {
            const profiles = {
                'Dr. Lebron': 'https://via.placeholder.com/40',
                'Jane Smith': 'https://via.placeholder.com/40',
                'Alice Johnson': 'https://via.placeholder.com/40',
            };

            document.getElementById("contactName").innerText = contact;
            document.getElementById("contactProfile").src = profiles[contact];
            document.getElementById("chatWindow").style.display = "flex";
            document.getElementById("contactListModal").style.display = "none";
            document.getElementById("messagesContainer").innerHTML = '';

            // Hide chat icon
            document.getElementById("chatIcon").style.display = "none";

            localStorage.setItem("chatOpen", "true");
        }


        function closeChat() {
            document.getElementById("chatWindow").style.display = "none";
            document.getElementById("chatIcon").style.display = "flex";


            localStorage.setItem("chatOpen", "false");
        }


        function sendMessage() {
            const messageInput = document.getElementById("messageInput");
            const messageText = messageInput.value.trim();
            if (messageText === '') return;

            const messagesContainer = document.getElementById("messagesContainer");
            const messageElement = document.createElement("div");
            messageElement.className = "message sent";
            messageElement.innerText = messageText;
            messagesContainer.appendChild(messageElement);

            messageInput.value = '';
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }


        function goBackToContacts() {
            document.getElementById("chatWindow").style.display = "none";
            document.getElementById("contactListModal").style.display = "block";
            document.getElementById("chatIcon").style.display = "flex";


            localStorage.setItem("chatOpen", "false");
        }


        document.getElementById("messageInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                sendMessage();
            }
        });

        window.onload = function() {
            const chatOpen = localStorage.getItem("chatOpen");
            if (chatOpen === "true") {
                document.getElementById("chatWindow").style.display = "flex";
                document.getElementById("contactListModal").style.display = "none";
                document.getElementById("chatIcon").style.display = "none";
            } else {
                document.getElementById("chatWindow").style.display = "none";
            }
        };

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


        function openModal() {
            document.getElementById("addNewPost").style.display = "block";
        }

        function closeModal() {
            document.getElementById("addNewPost").style.display = "none";
        }

        function openCalendar() {
            document.getElementById("calendarModal").style.display = "block";
        }

        function closeCalendar() {
            document.getElementById("calendarModal").style.display = "none";
        }

        function toggleDropdown(event, dropdownId) {
            event.stopPropagation();
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }




        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isHidden = sidebar.style.display === 'none' || sidebar.style.display === '';
            sidebar.style.display = isHidden ? 'flex' : 'none';
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
        };

        let postIdCounter = 0; // Counter for generating unique post IDs

function addNewPost() {
    const title = document.getElementById("postTitle").value;
    const content = document.getElementById("postContent").value;
    const timestamp = new Date().toLocaleDateString();

    if (title && content) {
        postIdCounter++; // Increment the counter for each new post
        const postId = postIdCounter; // Unique ID for the post

        const post = document.createElement("div");
        post.className = "post";
        post.id = `post-${postId}`; // Set the ID for the post element
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

        // Clear the input fields
        document.getElementById("postTitle").value = "";
        document.getElementById("postContent").value = "";

        // Close the modal
        closeModal();
    } else {
        alert("Please fill in both fields.");
    }
}

// Function to copy the post link to the clipboard
function copyPostLink(postId) {
    const postLink = `${window.location.origin}/post/${postId}`; // Construct the post link
    navigator.clipboard.writeText(postLink).then(() => {
        alert("Post link copied to clipboard!");
    }).catch(err => {
        console.error("Failed to copy: ", err);
    });
}

// Function to navigate to the post page
function goToPostPage(postId) {
    window.location.href = `post.html?postId=${postId}`;
}


function addComment(commentsContainerId, commentInputId) {
    const commentInput = document.getElementById(commentInputId);
    const commentText = commentInput.value.trim();

    if (commentText === '') return;

    const commentsContainer = document.getElementById(commentsContainerId);
    const commentElement = document.createElement('div');
    commentElement.className = 'comment';
    commentElement.innerText = commentText;

    commentsContainer.appendChild(commentElement);
    commentInput.value = '';
}


function toggleMenu(button) {
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle("show");
}


function reportPost() {
    alert("This post has been reported.");
}

    </script>
</body>
</html>
