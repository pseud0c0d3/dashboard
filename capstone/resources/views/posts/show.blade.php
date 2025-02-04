@extends('layouts.user-nav')
@section('navbar_title', 'MAIN POSTS')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        display: none;
    }

    /* User Avatar Styling */
    .user-avatar {
        width: 50px; /* Adjust size as needed */
        height: 50px;
        border-radius: 50%; /* Makes the image round */
        object-fit: cover; /* Ensures the image covers the area without stretching */
        border: 2px solid #ddd; /* Optional, adds a border around the avatar */
        margin-right: 10px; /* Adjust the margin as needed */
    }

    /* Comment Form Layout */
    .comment-form {
        display: flex;
        flex-direction: column;
        border-top: 1px solid #ddd;
        padding-top: 20px;
        margin-top: 20px;
    }

    .comment-card{
        margin-bottom: 20px; /* Adjust this value as needed */
    }

    /* Fix image size for comments */
    .comment-card img.img-fluid {
        max-width: 100%;
        max-height: 200px;  /* Adjust max height as needed */
        object-fit: cover;  /* Ensures the image covers the container without stretching */
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Optional, adds some styling */
    }

    /* Input and Icons in one line */
    .comment-input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f4f7f8;
        width: 100%;
        padding: 5px 10px;
    }

    /* Text Input */
    .comment-input-area {
        flex: 1;
        border: none;
        font-family: 'Roboto', sans-serif;
        font-size: 1rem;
        background-color: transparent;
        resize: none;
        padding: 8px;
        outline: none;
    }

    /* Icons Side by Side */
    .comment-icons {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    /* Icon Styling */
    .comment-submit-icon, .comment-image-upload-btn {
        font-size: 1.5rem;
        color: #007bff;
        cursor: pointer;
        background: none;
        border: none;
        transition: color 0.3s ease;
    }

    .comment-submit-icon:hover, .comment-image-upload-btn:hover {
        color: #0056b3;
    }

    /* Hide File Input */
    #imageUpload {
        display: none;
    }

    /* Image Preview */
    .image-preview-container {
        margin-top: 10px;
        display: none;
        position: relative;
        max-width: 200px;
    }

    .image-preview {
        width: 100%;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .remove-image-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        cursor: pointer;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .comment-input-area {
            font-size: 0.9rem;
        }
    }

    /* Move dropdown to top-right corner */
    .dropdown-container {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

<div class="container mt-5 pt-5">
    <div class="card shadow-lg position-relative">
        <div class="card-body">
            @auth
            @if(Auth::id() === $post->user_id)
            <div class="dropdown-container">
                <div class="dropdown">
                    <!-- Ellipsis Button -->
                    <button class="btn btn-outline-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i> <!-- FontAwesome or Bootstrap Icons for ellipsis -->
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPostModal{{ $post->id }}">
                                Edit
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endif
            <div>
                <div>
                @foreach($post->comments as $comment)
    <!-- Edit Comment Modal -->
    <div class="modal fade"  id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentLabel">Edit Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <textarea name="comment" class="form-control" rows="3" required>{{ $comment->content }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


            @endauth
            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 600;">{{ $post->title }}</h1>
            <p style="font-family: 'Roboto', sans-serif; font-size: 0.9rem;">
                Posted by: <strong>{{ $post->admin->name ?? $post->user->name ?? 'Anonymous' }}</strong>
            </p>
            <p style="font-family: 'Roboto', sans-serif; font-size: 1rem;">{{ $post->body }}</p>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control" id="body" name="body" rows="3" required>{{ $post->body }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Comment Section -->
    <div class="card mt-4 shadow-lg">
        <div class="card-body">
            <h5 class="font-weight-bold mb-4" style="font-family: 'Poppins', sans-serif;">Comments:</h5>

            @if($post->admin_id !== 1)
            <form action="{{ route('comments.store') }}" method="POST" class="comment-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <!-- Input + Icons in One Line -->
                <div class="comment-input-group">
                    <textarea id="commentInput" name="content" class="comment-input-area" placeholder="Write your comment..." required rows="1"></textarea>

                    <!-- Icons Side by Side -->
                    <div class="comment-icons">
                        <!-- Image Upload Button -->
                        <label for="imageUpload" class="comment-image-upload-btn">
                            <i class="bi bi-image"></i>
                        </label>
                        <input type="file" id="imageUpload" name="image" accept="image/*">
                        
                        <!-- Submit Button -->
                        <button type="submit" class="comment-submit-icon">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>

                <!-- Image Preview -->
                <div class="image-preview-container" id="imagePreviewContainer">
                    <img id="imagePreview" class="image-preview" src="" alt="Image Preview">
                    <button type="button" class="remove-image-btn" onclick="removeImage()">×</button>
                </div>

            </form>
            @endif

            <div class="comments-list mt-4">
                @if($post->comments->isEmpty())
                    <p class="text-muted">No comments yet. Be the first to comment!</p>
                @else
                    @foreach($post->comments as $comment)
                    <div class="comment-card">
    <div class="d-flex align-items-start" style="position: relative;">
        <img src="{{ $comment->user ? ($comment->user->picture 
            ? asset('storage/' . $comment->user->picture) 
            : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&background=random&color=fff&size=50') 
            : 'https://ui-avatars.com/api/?name=Unknown&background=random&color=fff&size=50' }}"
            class="user-avatar"
            alt="User Profile"
            width="50" height="50">
        <div class="ms-3 w-100">
            <div class="comment-header">
                <strong class="comment-author">{{ $comment->user->name ?? 'Guest' }}</strong>
                <small class="text-muted comment-time">{{ $comment->created_at->diffForHumans() }}</small>
            </div>
            <p class="comment-content mb-1">{{ $comment->content }}</p>
    
                                @if($comment->image)
                                <img src="{{ Storage::url($comment->image) }}" alt="Comment Image" class="img-fluid comment-img-preview" 
                                    data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-img="{{ Storage::url($comment->image) }}">
                                @endif

                                <!-- Dropdown for Edit and Delete -->
                                @auth
                                    @if(Auth::id() === $comment->user_id)
                                    <div class="dropdown-container" style="position: absolute; top: 5px; right: 10px;">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}">Edit</button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                @endauth
                      <!-- Full-Size Image View Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Centers the image -->
        <div class="modal-content bg-dark border-0"> <!-- Dark background, no border -->
            <div class="modal-body p-0 d-flex justify-content-center align-items-center">
                <img id="modalImagePreview" class="img-fluid" alt="Preview Image" 
                     style="max-width: 100vw; max-height: 100vh; width: auto; height: auto; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commentInput = document.getElementById('commentInput');
        const imageUpload = document.getElementById('imageUpload');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');

        // Expand textarea dynamically
        commentInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        // Show image preview
        imageUpload.addEventListener('change', function(event) {
            if (event.target.files.length > 0) {
                const file = event.target.files[0];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.style.display = 'block';
                };
                
                reader.readAsDataURL(file);
            }
        });
    });

    // Remove image preview
    function removeImage() {
        document.getElementById('imageUpload').value = "";
        document.getElementById('imagePreviewContainer').style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function() {
        const imagePreviewModal = document.getElementById("imagePreviewModal");
        const modalImagePreview = document.getElementById("modalImagePreview");

        document.querySelectorAll(".comment-card img, .post-image").forEach(img => {
            img.addEventListener("click", function() {
                modalImagePreview.src = this.src; // Set the clicked image as preview
                const modal = new bootstrap.Modal(imagePreviewModal);
                modal.show();
            });
        });
    });
</script>

@endsection
