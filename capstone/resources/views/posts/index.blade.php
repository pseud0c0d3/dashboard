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

    /* Post image container */
    .post-image-container {
        position: relative;
        width: 100%;
        max-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .post-image-container:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .post-image {
        position: relative;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .post-image-container:hover .post-image {
        transform: scale(1.05);
    }

    /* Ensure the image container doesn't overflow */
    .card-body {
        overflow: hidden;
        background-color:rgba(82, 159, 223, 0.57);
    }
    
    @media (max-width: 768px) {
        .post-image {
            max-height: 300px;
        }
    }

    @media (max-width: 576px) {
        .post-image {
            max-height: 250px;
        }
    }

    /* Image Wrapper */
    .post-image-container {
        position: relative;
        width: 100%;
        max-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        overflow: hidden;
    }

    /* The Actual Image */
    .post-image {
        position: relative;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    /* Modal styles */
    .modal-dialog {
        max-width: 90vw;
        max-height: 90vh;
    }

    #modalImage {
        width: auto;
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
    }

    /* Fixed post button */
    #add {
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
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
                    <div class="post-image-container" style="margin-top: -16px;">
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="Post Image"
                             class="post-image"
                             data-bs-toggle="modal"
                             data-bs-target="#imageModal"
                             onclick="viewImage('{{ asset('storage/' . $post->image) }}')">
                    </div>
                    @endif

                    <!-- Comment & Like Actions -->
                    <div class="d-flex align-items-center">
                        <!-- Like Button -->
                        <form action="{{ route('posts.like', $post->id) }}" method="POST" class="d-inline me-3">
                            @csrf
                            <button type="submit" class="btn btn-link text-decoration-none p-0">
                                <i class="bi bi-heart{{ $post->isLikedBy(auth()->user()) ? '-fill text-danger' : '' }}"></i>
                            </button>
                        </form>
                        <!-- Like Count -->
                        <span class="me-3" style="margin-left: -30px; font-size: 1.2rem; font-family: 'Roboto', sans-serif;">{{ $post->likes->count() }}</span>

                        <!-- Chat Button with Comment Count -->
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-link text-decoration-none p-0" style="margin-left: 0px; font-size: 1.2rem; font-family: 'Roboto', sans-serif;">
                            <i class="bi bi-chat"></i>
                            <span class="ms-1">{{ $post->comments->count() }}</span>
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
        <i class="bi bi-plus-lg"></i>
    </div>

    <!-- Image View Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img id="modalImage" src="" class="img-fluid rounded" alt="Post Image">
                </div>
            </div>
        </div>
    </div>

<!-- Compact Landscape Post Modal -->
<div class="modal fade" id="PostModal" tabindex="-1" aria-labelledby="PostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; max-width: 800px;">
            
            <!-- Modal Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%); border-bottom: none; padding: 0.8rem 1rem;">
                <h5 class="modal-title text-white mb-0" style="font-weight: 600; font-family: 'Poppins', sans-serif; font-size: 1.1rem;">
                    <i class="bi bi-pencil-square me-1"></i>Create New Post
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-0">
                    <div class="row g-0 flex-wrap">
                        <!-- Left Side - Form Fields -->
                        <div class="col-12 col-md-7 p-3">
                            <!-- Title Input -->
                            <div class="mb-2">
                                <label for="postTitle" class="form-label mb-1" style="font-weight: 500; color: #495057; font-size: 0.85rem;">POST TITLE</label>
                                <input type="text" 
                                       name="title" 
                                       id="postTitle" 
                                       class="form-control" 
                                       placeholder="Give your post a title..." 
                                       required
                                       style="padding: 0.6rem 0.8rem; border-radius: 6px; border: 1px solid #e0e0e0; font-size: 0.9rem;">
                            </div>
                            
                            <!-- Body Input -->
                            <div class="mb-2">
                                <label for="postBody" class="form-label mb-1" style="font-weight: 500; color: #495057; font-size: 0.85rem;">CONTENT</label>
                                <textarea name="body" 
                                          id="postBody" 
                                          class="form-control" 
                                          rows="6" 
                                          placeholder="Share your thoughts with the community..." 
                                          required
                                          style="padding: 0.6rem 0.8rem; border-radius: 6px; border: 1px solid #e0e0e0; font-size: 0.9rem; resize: none;"></textarea>
                            </div>
                        </div>
                        
                        <!-- Right Side - Image Upload -->
                        <div class="col-12 col-md-5 bg-light p-3 d-flex flex-column" style="border-left: 1px solid #f0f0f0;">
                            <div class="flex-grow-1 d-flex flex-column">
                                <label class="form-label mb-1" style="font-weight: 500; color: #495057; font-size: 0.85rem;">UPLOAD IMAGE (OPTIONAL)</label>

                                <!-- Desktop Upload -->
                                <div class="d-none d-md-flex border-dashed rounded-2 bg-white flex-column align-items-center justify-content-center text-center p-3 flex-grow-1" 
                                     style="border: 2px dashed #d1d5db; cursor: pointer; min-height: 180px; position: relative;"
                                     id="imageUploadArea">
                                    <i class="bi bi-image text-muted mb-1" style="font-size: 1.8rem;"></i>
                                    <div class="text-muted mb-1" style="font-size: 0.75rem;">Drag & drop image here</div>
                                    <div class="text-muted mb-2" style="font-size: 0.7rem;">or click to browse</div>
                                    <button type="button" class="btn btn-sm btn-outline-primary py-1 px-2" id="selectImageBtn">
                                        Select Image
                                    </button>
                                    <input type="file" 
                                           name="image" 
                                           id="postImage" 
                                           class="d-none" 
                                           accept="image/webp, image/png, image/jpg">

                                    <!-- Image Preview -->
                                    <div class="w-100 h-100 d-none position-absolute top-0 start-0 p-2" id="imagePreviewContainer">
                                        <img id="imagePreview" class="w-100 h-100 rounded" style="object-fit: contain;">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-1" id="removeImageBtn"></button>
                                    </div>
                                </div>

                                <!-- Mobile Upload -->
                                <div class="d-flex d-md-none flex-column">
                                    <input type="file" 
                                           name="image" 
                                           id="mobileImageInput" 
                                           accept="image/webp, image/png, image/jpg" 
                                           class="form-control mt-1">
                                    <div class="form-text mt-1 text-center" style="font-size: 0.75rem;">Supported: JPG, PNG, WEBP (Max 5MB)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer" style="border-top: 1px solid #f0f0f0; padding: 0.8rem 1rem;">
                    <button type="button" 
                            class="btn btn-outline-secondary px-3 py-1" 
                            data-bs-dismiss="modal"
                            style="border-radius: 6px; font-weight: 500; font-size: 0.85rem;">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn btn-primary px-3 py-1"
                            style="border-radius: 6px; font-weight: 500; font-size: 0.85rem; background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%); border: none;">
                        <i class="bi bi-send-fill me-1"></i> Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const postImage = document.getElementById('postImage');
        const selectImageBtn = document.getElementById('selectImageBtn');
        const uploadArea = document.getElementById('imageUploadArea');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        const removeImageBtn = document.getElementById('removeImageBtn');

        if (selectImageBtn) {
            selectImageBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                postImage.click();
            });
        }

        if (postImage) {
            postImage.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('d-none');
                        uploadArea.querySelector('i.bi-image').style.display = 'none';
                        uploadArea.querySelector('div.text-muted').style.display = 'none';
                        uploadArea.querySelector('div.text-muted:nth-child(3)').style.display = 'none';
                        selectImageBtn.style.display = 'none';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                postImage.value = '';
                previewContainer.classList.add('d-none');
                uploadArea.querySelector('i.bi-image').style.display = 'block';
                uploadArea.querySelector('div.text-muted').style.display = 'block';
                uploadArea.querySelector('div.text-muted:nth-child(3)').style.display = 'block';
                selectImageBtn.style.display = 'block';
            });
        }

        if (uploadArea) {
            uploadArea.addEventListener('click', function() {
                postImage.click();
            });

            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#3a7bd5';
                uploadArea.style.backgroundColor = 'rgba(58, 123, 213, 0.05)';
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.backgroundColor = '#fff';
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.style.borderColor = '#d1d5db';
                uploadArea.style.backgroundColor = '#fff';

                if (e.dataTransfer.files.length) {
                    postImage.files = e.dataTransfer.files;
                    const event = new Event('change');
                    postImage.dispatchEvent(event);
                }
            });
        }
    });
</script>

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
                submitButton.classList.add("btn-secondary");
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
                        location.reload();
                    });
                });
            });
        });

        document.getElementById('currentDate').textContent = new Date().toLocaleString();

        function viewImage(imageUrl) {
            let modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modalImage.style.maxWidth = "90vw";
            modalImage.style.maxHeight = "90vh";

            let img = new Image();
            img.src = imageUrl;
            img.onload = function () {
                if (img.width < 500) {
                    modalImage.style.width = "60vw";
                } else {
                    modalImage.style.width = "auto";
                }
            };

            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>

@endsection