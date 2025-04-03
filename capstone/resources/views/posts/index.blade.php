@extends('layouts.user-nav')
@section('navbar_title', 'LATEST POSTS')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Make sure you include Bootstrap's JavaScript for the dropdown functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

 <link rel="stylesheet" href="/css/nav.css">

<style>
    /* Updated Filter Buttons */
    .filter-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .filter-buttons .btn {
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .filter-buttons .btn-outline-primary {
        border-color: #0d6efd;
        color: #0d6efd;
    }

    .filter-buttons .btn-outline-primary:hover,
    .filter-buttons .btn-outline-primary.active {
        background-color: #0d6efd;
        color: white;
    }

    /* Mobile Friendly */
    @media (max-width: 576px) {
        .filter-buttons {
            flex-direction: column;
            align-items: center;
        }

        .filter-buttons .btn {
            width: 100%;
            text-align: center;
        }

        .search-bar {
            max-width: 100%;
        }
    }
    /* Custom styles for mobile responsiveness */
@media (max-width: 576px) {
    .filter-buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .filter-buttons .btn {
        width: 100%; /* Make buttons full width on mobile */
        margin-bottom: 10px; /* Add spacing between buttons */
    }
}

@media (min-width: 577px) {
    .filter-buttons {
        display: flex;
        justify-content: space-between; /* Keep buttons aligned in a row on larger screens */
    }

    .filter-buttons .btn {
        width: auto; /* Default width for larger screens */
    }
}

    /* Add this CSS for the hover effect */
    .post-image-container {
        position: relative;
        width: 100%;
        max-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    }

    .post-image-container:hover {
        transform: scale(1.02); /* Slightly scale up on hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
    }

    .post-image-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: inherit;
        background-size: cover;
        background-position: center;
        filter: blur(15px) brightness(0.7);
        transform: scaleX(1.5);
        z-index: 1;
    }

    .post-image {
        position: relative;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
        z-index: 2;
        transition: transform 0.3s ease; /* Smooth transition for the image */
    }

    .post-image-container:hover .post-image {
        transform: scale(1.05); /* Slightly zoom in the image on hover */
    }

/* Ensure the image container doesn't overflow */
.card-body {
    overflow: hidden; /* Prevent content from overflowing */
    background-color:rgba(82, 159, 223, 0.57);
}
@media (max-width: 768px) {
    .post-image {
        max-height: 300px; /* Smaller max-height for mobile devices */
    }
}

@media (max-width: 576px) {
    .post-image {
        max-height: 250px; /* Even smaller max-height for very small devices */
    }
}

/* Image Wrapper: Keeps Original Aspect Ratio, Side Blur */
.post-image-container {
    position: relative;
    width: 100%;
    max-height: 400px; /* Prevents overly large images */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    overflow: hidden;
}

/* Blurred Background - Only on Left & Right */
.post-image-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: inherit;
    background-size: cover;
    background-position: center;
    filter: blur(15px) brightness(0.7); /* Blur effect */
    transform: scaleX(1.5); /* Stretches blur only on left & right */
    z-index: 1;
}

/* The Actual Image (Centered, Original Aspect Ratio) */
.post-image {
    position: relative;
    max-width: 100%; /* Adjust to fit container */
    max-height: 100%;
    object-fit: contain; /* Keeps original aspect ratio */
    border-radius: 8px;
    z-index: 2;
}

/* Blurred Modal Background */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.2) !important; /* Light overlay */
    backdrop-filter: blur(10px); /* Apply blur effect */
}

/* Ensure modal-content has no background */
.modal-content {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}
/* Ensure the modal dialog is larger */
.modal-dialog {
    max-width: 90vw; /* Make modal take 90% of the viewport width */
    max-height: 90vh; /* Make modal take 90% of the viewport height */
}

/* Make the image scale up while keeping it responsive */
#modalImage {
    width: auto; /* Keep original width */
    max-width: 90vw; /* Scale image to fit within viewport width */
    max-height: 90vh; /* Scale image to fit within viewport height */
    object-fit: contain; /* Ensure image keeps aspect ratio */
}



</style>
<div class="container mt-5 pt-5" style="auto; max-height: 100vh;">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="scrollable-posts" style="max-height: 100vh; padding-right: 15px;">
    <form action="{{ route('posts.index') }}" method="GET" class="w-100">
        @csrf
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                class="form-control rounded-start-pill border-0 shadow-sm px-4" 
                placeholder="Search by title..."
                value="{{ request('search') }}"
                style="height: 45px; font-weight: bold;">

            <button 
                type="submit" 
                class="btn btn-primary rounded-end-pill shadow-sm px-4">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
        <div class="filter-buttons d-flex justify-content-between mb-3">
            <div>
                <a href="{{ route('posts.index', ['filter' => 'all']) }}" class="btn btn-outline-primary {{ request('filter', 'all') === 'all' ? 'active' : '' }}">
                    All Posts
                </a>
                <a href="{{ route('posts.index', ['filter' => 'mine']) }}" class="btn btn-outline-primary {{ request('filter') === 'mine' ? 'active' : '' }}">
                    My Posts
                </a>
                <a href="{{ route('posts.index', ['filter' => 'admin']) }}" class="btn btn-outline-primary {{ request('filter') === 'admin' ? 'active' : '' }}">
                    Admin Posts
                </a>
            </div>
        </div>
        


        @if($posts->isEmpty())
            <div class="alert alert-warning text-center">
                No posts found. Please try a different search term.
            </div>
        @else
            @foreach($posts as $post)
            <div class="card mb-4" style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset; font-family: 'Inter', sans-serif;">
    <div class="card-body">
        <!-- User Info Section -->
        <div class="d-flex align-items-center mb-4">
        <img src="{{ $post->user && $post->user->picture 
    ? asset('storage/' . $post->user->picture) 
    : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name ?? 'User') . '&background=random&color=fff&size=50' }}"
    class="rounded-circle"
    alt="{{ $post->user->name ?? 'User' }} Profile"
    width="50" height="50">


            <div class="ms-3">
                <h6 class="mb-0" style="font-size: 1rem; font-weight: 600; color: #333; font-family: 'Poppins', sans-serif;">
                    @if ($post->admin)
                        Admin: {{ $post->admin->name }}
                    @elseif ($post->user)
                        {{ $post->user->name }}
                    @else
                        Anonymous
                    @endif
                </h6>
                
                <small class="text-muted" style="font-size: 0.85rem; font-family: 'Poppins', sans-serif;">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>

        <!-- Post Content Section -->
        <h5 class="fw-bold text-dark mb-3" style="margin-top: -18px; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.8rem; text-transform: capitalize; letter-spacing: 0.5px;">
            {!! isset($search) ? str_ireplace($search, "<mark>{$search}</mark>", $post->title) : $post->title !!}
        </h5>

        <p class="mb-3" style="margin-top: -10px; font-size: 1rem; line-height: 1.6; color: #555; font-family: 'Roboto', sans-serif;">
            {{ Str::limit($post->body, 150) }}
        </p>

        <!-- Display the image if it exists -->
        @if ($post->image)
    <div class="post-image-container" style="margin-top: -16px;background-image: url('{{ asset('storage/' . $post->image) }}');">
        <img src="{{ asset('storage/' . $post->image) }}" 
             alt="Post Image" 
             class="post-image" 
             data-bs-toggle="modal" 
             data-bs-target="#imageModal" 
             onclick="viewImage('{{ asset('storage/' . $post->image) }}')">
    </div>
@endif



      <!-- Comment & Like Actions (Updated) -->
<div class="d-flex align-items-center">
    <!-- Like Button -->
    <form action="{{ route('posts.like', $post->id) }}" method="POST" class="d-inline me-3">
        @csrf
        <button type="submit" class="btn btn-link text-decoration-none p-0">
            <!-- Heart icon: red if liked, default if not -->
            <i class="bi bi-heart{{ $post->isLikedBy(auth()->user()) ? '-fill text-danger' : '' }}"></i>
        </button>
    </form>
    <!-- Like Count -->
    <span class="me-3" style="margin-left: -30px; font-size: 1.2rem; font-family: 'Roboto', sans-serif;">{{ $post->likes->count() }}</span>

    <!-- Chat Button with Comment Count -->
    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-link text-decoration-none p-0" style="margin-left: 0px; font-size: 1.2rem; font-family: 'Roboto', sans-serif;">
        <i class="bi bi-chat"></i> <!-- Chat icon from Bootstrap Icons -->
        <span class="ms-1">{{ $post->comments->count() }}</span> <!-- Display Comment Count -->
    </a>
</div>

    </div>
</div>
            @endforeach
        @endif

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm">
                    <!-- Previous Button -->
                    <li class="page-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Page Numbers -->
                    @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $posts->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <!-- Next Button -->
                    <li class="page-item {{ $posts->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $posts->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>



    <!-- Add a Post Button -->
    <div class="btn btn-success position-fixed" id="add"
         data-bs-toggle="modal"
         data-bs-target="#PostModal">
        <i class="bi bi-plus-lg"></i> <!-- Icon for adding a post -->
    </div>
    
<!-- Image View Modal (Blurred Background) -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body d-flex justify-content-center align-items-center p-0">
                <img id="modalImage" src="" class="img-fluid rounded" 
                     alt="Post Image" style="max-width: 90vw; max-height: 90vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>




    <!-- Post Modal -->
    <div class="modal fade" id="PostModal" tabindex="-1" aria-labelledby="PostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PostModalLabel">Create a Post!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <!-- Title Input -->
        <input type="text" name="title" class="form-control mb-3" placeholder="Give your post a title!" required>

        <!-- Body Input -->
        <textarea name="body" class="form-control mb-3" placeholder="What do you want to share today?" rows="4" required></textarea>

        <!-- Image Input (optional) -->
        <input type="file" name="image" class="form-control mb-3" accept="image/webp, image/png, image/jpg">
    </div>
    <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Post</button>
    </div>
</form>
            </div>
        </div>
    </div>

    {{-- <!-- Comment Modal -->
    @foreach($posts as $post)
        <div class="modal fade" id="commentModal{{ $post->id }}" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="commentModalLabel">Add a Comment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach --}}
    <!-- Toggle Sidebar Button (visible in mobile mode) -->
<!-- Toggle Sidebar Button -->
<button class="btn toggle-sidebar-btn d-md-none" onclick="toggleSidebar()">
    ☰
</button>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
        document.querySelector("#PostModal form").addEventListener("submit", function() {
            var submitButton = this.querySelector("button[type='submit']");
            submitButton.disabled = true;
            submitButton.innerText = "Post";
            submitButton.classList.remove("btn-primary");
            submitButton.classList.add("btn-secondary"); // Change to grey
        });
    });
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.like-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const postId = this.dataset.postId;

                    fetch(`/posts/${postId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'liked') {
                            alert('Post liked!');
                        } else {
                            alert('Post unliked!');
                        }
                        location.reload(); // Reload to update the like count
                    });
                });
            });
        });

        document.getElementById('currentDate').textContent = new Date().toLocaleString();


        function viewImage(imageUrl) {
        let modalImage = document.getElementById('modalImage');
        modalImage.src = imageUrl;
        modalImage.style.maxWidth = "90vw"; // Prevent overflow
        modalImage.style.maxHeight = "90vh"; // Ensure proper scaling

        // Adjust width dynamically based on the image size
        let img = new Image();
        img.src = imageUrl;
        img.onload = function () {
            if (img.width < 500) {
                modalImage.style.width = "60vw"; // Scale up small images
            } else {
                modalImage.style.width = "auto"; // Default size for larger images
            }
        };

        // Show modal
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    
    }
    </script>

@endsection
