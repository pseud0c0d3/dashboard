@extends('layouts.user-nav')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

<div class="container mt-5">
    <!-- Title and Search Bar -->
    <div class="mb-5">
    <h1 class="display-4 text-dark font-weight-bold mb-1" style="font-family: 'Roboto', sans-serif;">Latest Posts</h1>
        <div class="search-container mt-6" style="max-width: 600px; margin: 0 auto;">
            <form action="{{ route('posts.index') }}" method="GET" class="d-flex w-200">
                @csrf
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search by title..."
                        class="form-control rounded-pill"
                        value="{{ request('search') }}"
                        style="padding-left: 15px; font-size: 1rem; border: 1px solid #ced4da; box-shadow: none;"
                    >
                    <button type="submit" class="btn btn-primary rounded-pill ms-2">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

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
        @if($posts->isEmpty())
            <div class="alert alert-warning text-center">
                No posts found. Please try a different search term.
            </div>
        @else
            @foreach($posts as $post)
<div class="card mb-4 box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; rounded-lg border-0" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
    <div class="card-body">
        <!-- User Info Section -->
        <div class="d-flex align-items-center mb-4">
            <img src="{{ asset('storage/default-profile.jpg') }}"
                 class="rounded-circle"
                 alt="User Profile"
                 width="50" height="50">
            <div class="ms-3">
                <h6 class="mb-0">{{ $post->user->name ?? 'Anonymous' }}</h6>
                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>

        <!-- Post Content Section -->
        <h5 class="fw-bold text-primary mb-3">
            {!! isset($search) ? str_ireplace($search, "<mark>{$search}</mark>", $post->title) : $post->title !!}
        </h5>
        <p class="mb-3 text-muted">{{ Str::limit($post->body, 150) }}</p>

        <!-- Post Image (if any) -->
        @if($post->image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $post->image) }}"
                     class="img-fluid rounded-3"
                     alt="{{ $post->image }}">
            </div>
        @endif

        <!-- Like and Comment Actions -->
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#commentModal{{ $post->id }}">
                    <i class="bi bi-chat-left-text"></i> Comment
                </button>
            </div>
            <div>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
            </div>
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
    <div class="btn btn-success position-fixed"
         style="bottom: 20px; right: 15%; z-index: 10; cursor: pointer;"
         data-bs-toggle="modal"
         data-bs-target="#PostModal">
        Add a Post
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
                    {{-- <input type="file" name="image" class="form-control mb-3" accept="image/webp, image/png, image/jpg"> --}}
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Comment Modal -->
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
@endforeach

<script>
// Modal handling for adding new posts
let postIdCounter = 0;

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
</script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
