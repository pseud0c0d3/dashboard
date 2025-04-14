@extends('layouts.admin-nav')
@section('navbar_title', 'MAIN POSTS')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Bootstrap JS (v5) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<style>
    /* Reply Button Styling */
.reply-button {
    padding: 5px 15px;
    font-size: 0.9rem;
    border-radius: 20px;
    text-align: center;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
    background-color: transparent;
    color: #007bff;
    border: 1px solid #007bff;
}

.reply-button:hover {
    background-color: #007bff;
    color: white;
    border-color: #0056b3;
}

/* Reply Button Icon */
.reply-button i {
    font-size: 1rem;
}

    /* Styling for the reply form and reply list */
.reply-form-container {
    margin-top: 15px;
    background-color: #f7f7f7;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.reply-input-group {
    display: flex;
    align-items: center;
    width: 100%;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 5px 10px;
}

.reply-input-area {
    flex: 1;
    border: none;
    background-color: transparent;
    padding: 8px;
    font-size: 1rem;
    resize: none;
    outline: none;
    font-family: 'Roboto', sans-serif;
}

.reply-submit-btn {
    font-size: 1.5rem;
    color: #007bff;
    cursor: pointer;
    background: none;
    border: none;
    transition: color 0.3s ease;
}

.reply-submit-btn:hover {
    color: #0056b3;
}

.replies-list .reply-card {
    margin-top: 10px;
    background-color: #f1f1f1;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    margin-left: 30px;
}

.replies-list .reply-card .user-avatar {
    width: 40px;
    height: 40px;
}

.replies-list .reply-card .comment-header {
    font-weight: bold;
}

.replies-list .reply-card .comment-content {
    margin-top: 10px;
    font-size: 1rem;
    color: #555;
}

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

    .comment-card {
        margin-bottom: 20px; /* Adjust this value as needed */
    }

    /* Fix image size for comments */
    .comment-card img.img-fluid {
        max-width: 100%;
        max-height: 200px; /* Adjust max height as needed */
        object-fit: cover; /* Ensures the image covers the container without stretching */
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

    .reply-card {
        border-left: 2px solid #ddd;
        padding-left: 10px;
        margin-left: 20px;
    }
</style>

<div class="container mt-5 pt-5">
    <div class="card shadow-lg position-relative">
        <div class="card-body">
            @auth
            @if(Auth::id() === $post->admin_id)
            <div class="dropdown-container">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPostModal{{ $post->id }}">
                                Edit
                            </button>
                        </li>
                        <li>
                            <form action="{{ route('admin.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </li>
                        
                    </ul>
                </div>
            </div>
            @endif
            @endauth
            <h1 style="font-family: 'Poppins', sans-serif; font-weight: 600;">{{ $post->title }}</h1>
            

            <p style="font-family: 'Roboto', sans-serif; font-size: 0.9rem;">
                Posted by: <strong>{{ $post->admin->name ?? $post->user->name ?? 'Anonymous' }}</strong>
            </p>
            @if($post->archived)
                <span class="badge bg-warning text-dark">Archived</span>
            @endif
            
            <p style="font-family: 'Roboto', sans-serif; font-size: 1rem;">{{ $post->body }}</p>
            @if ($post->image)
            <div class="text-center mt-3">
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded shadow-sm" alt="Post Image" style="max-width: 100%; max-height: 400px;">
            </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="{{ route('posts.admin') }}" class="btn btn-primary">Back to Posts</a>
            
                <form action="{{ route('posts.toggleArchive', $post->id) }}" method="POST" class="d-inline mb-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning btn-sm d-flex"
                        onclick="return confirm('Are you sure you want to {{ $post->archived ? 'unarchive' : 'archive' }} this post?')">
                        {{ $post->archived ? 'Unarchive' : 'Archive' }}
                    </button>
                </form>
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
                    <form action="{{ route('admin.update', $post->id) }}" method="POST">
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
            <form action="{{ route('admin.comment', $post->id) }}" method="POST" class="comment-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="comment-input-group">
                    <textarea id="commentInput" name="content" class="comment-input-area" placeholder="Write your comment..." required rows="1"></textarea>

                    <div class="comment-icons">
                        <label for="imageUpload" class="comment-image-upload-btn">
                            <i class="bi bi-image"></i>
                        </label>
                        <input type="file" id="imageUpload" name="image" accept="image/*">
                        
                        <button type="submit" class="comment-submit-icon">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>

                <div class="image-preview-container" id="imagePreviewContainer">
                    <img id="imagePreview" class="image-preview" src="" alt="Image Preview">
                    <button type="button" class="remove-image-btn" onclick="removeImage()">×</button>
                </div>
            </form>
            @endif

            <div class="comments-list mt-4">
                @if($post->comments->isEmpty())
                    @if($post->admin_id === 1)
                        <p class="text-muted">Comments are disabled for administrator posts.</p>
                    @else
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                    @endif
                @else
                    @foreach($post->comments as $comment)
                    <div class="comment-card">
                        <div class="d-flex align-items-start" style="position: relative;">
                        <img src="{{ $comment->admin 
    ? ($comment->admin->picture 
        ? asset('storage/' . $comment->admin->picture) 
        : 'https://ui-avatars.com/api/?name=' . urlencode($comment->admin->name) . '&background=random&color=fff&size=50'
    ) 
    : ($comment->user 
        ? ($comment->user->picture 
            ? asset('storage/' . $comment->user->picture) 
            : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) . '&background=random&color=fff&size=50'
        ) 
        : 'https://ui-avatars.com/api/?name=Unknown&background=random&color=fff&size=50'
    ) 
}}"
class="user-avatar"
alt="User Profile"
width="50" height="50">

                            <div class="ms-3 w-100">
                                <div class="comment-header">
                                    <strong class="comment-author">{{ $comment->admin->name ?? $comment->user->name ?? 'Guest' }}</strong>
                                    <small class="text-muted comment-time">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="comment-content mb-1">{{ $comment->content }}</p>

                                @if($comment->image)
                                <img src="{{ Storage::url($comment->image) }}" alt="Comment Image" class="img-fluid comment-img-preview" 
                                    data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-img="{{ Storage::url($comment->image) }}">
                                @endif

                                @auth
                                @if(Auth::id() === $comment->admin_id)
                                    <div class="dropdown-container position-absolute" style="top: 5px; right: 10px;">
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCommentModal{{ $comment->id }}">Edit</button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline">
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
                            </div>
                        </div>
                    </div>

                    <!-- Edit Comment Modal -->
                    <div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" aria-labelledby="editCommentLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editCommentLabel">Edit Comment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
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
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Image preview modal handler
document.addEventListener('DOMContentLoaded', function() {
    // Handle image preview modal
    const imagePreviewModal = document.getElementById('imagePreviewModal');
    if (imagePreviewModal) {
        imagePreviewModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const imageUrl = button.getAttribute('data-img');
            const modalImage = document.getElementById('modalPreviewImage');
            modalImage.src = imageUrl;
        });
    }

    // The following functions are kept in case they're needed for other elements
    // but the comment input and image upload functionality is disabled in admin
    
    // Auto-expanding textarea (if used elsewhere)
    const textareas = document.querySelectorAll('textarea.auto-expand');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Image preview functionality (if used elsewhere)
    const imageUploads = document.querySelectorAll('input[type="file"].image-upload');
    imageUploads.forEach(upload => {
        upload.addEventListener('change', function(event) {
            if (event.target.files.length > 0) {
                const file = event.target.files[0];
                const reader = new FileReader();
                const previewId = this.dataset.previewTarget;
                const previewContainer = document.getElementById(previewId);

                if (previewContainer) {
                    const previewImage = previewContainer.querySelector('img');
                    const removeBtn = previewContainer.querySelector('.remove-image-btn');
                    
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.style.display = 'block';
                        
                        if (removeBtn) {
                            removeBtn.onclick = function() {
                                event.target.value = "";
                                previewContainer.style.display = 'none';
                            };
                        }
                    };

                    reader.readAsDataURL(file);
                }
            }
        });
    });
});

// Generic remove image function
function removeImage(previewContainerId) {
    const container = document.getElementById(previewContainerId);
    if (container) {
        const fileInput = container.previousElementSibling.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.value = "";
        }
        container.style.display = 'none';
    }
}
</script>
@endsection