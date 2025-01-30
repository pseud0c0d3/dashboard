@extends('layouts.admin-nav')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Make sure you include Bootstrap's JavaScript for the dropdown functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="/css/nav.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('posts.index') }}">LATEST POSTS</a>
        <form action="{{ route('posts.index') }}" method="GET" class="d-flex ms-auto" style="max-width: 500px;">
    @csrf
    <div class="input-group w-100">
        <!-- Input field always visible -->
        <input
            type="text"
            name="search"
            placeholder="Search by title..."
            class="form-control rounded-pill"
            value="{{ request('search') }}"
            style="display: block;" >
        <!-- Hide button on mobile -->
        <button
            type="submit"
            class="btn btn-light rounded-pill ms-2 d-none d-sm-block">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>

    </div>
</nav>

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
        @if($posts->isEmpty())
            <div class="alert alert-warning text-center">
                No posts found. Please try a different search term.
            </div>
        @else
            @foreach($posts as $post)
            <div class="card mb-4" style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset; font-family: 'Inter', sans-serif;">
                    <div class="card-body" style="background-color: #ffffff;">
                        <!-- User Info Section -->
                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ $post->user ? ($post->user->picture 
                            ? asset('storage/' . $post->user->picture) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode(substr($post->user->name, 0, 1)) . '&background=random&color=fff&size=50') 
                            : 'https://ui-avatars.com/api/?name=Unknown&background=random&color=fff&size=50' }}"
                            class="rounded-circle"
                            alt="User Profile"
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
                        <h5 class="fw-bold text-dark mb-3" style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.8rem; text-transform: capitalize; letter-spacing: 0.5px;">
                            {!! isset($search) ? str_ireplace($search, "<mark>{$search}</mark>", $post->title) : $post->title !!}
                        </h5>

                        <p class="mb-3" style="font-size: 1rem; line-height: 1.6; color: #555; font-family: 'Roboto', sans-serif;">
                            {{ Str::limit($post->body, 150) }}
                        </p>

                        <!-- Post Image (if any) -->
                        @if($post->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $post->image) }}"
                                     class="img-fluid rounded-3"
                                     alt="{{ $post->image }}">
                            </div>
                        @endif

                        <!-- Comment Actions -->
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <div>
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#commentModal{{ $post->id }}" style="font-size: 0.9rem; font-family: 'Roboto', sans-serif;">
                                    <i class="bi bi-chat-left-text"></i> Comment
                                </button>
                            </div> --}}
                            <div>
                                <a href="{{ route('posts.showadmin', $post->id) }}" class="btn btn-primary" style="font-size: 0.9rem; font-family: 'Roboto', sans-serif;">Read More</a>
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
   <div class="btn btn-success position-fixed" id="add"
         data-bs-toggle="modal"
         data-bs-target="#PostModal">
        <i class="bi bi-plus-lg"></i> <!-- Icon for adding a post -->
    </div>

<!-- Post Modal -->
<div class="modal fade" id="PostModal" tabindex="-1" aria-labelledby="PostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PostModalLabel">Create a Post!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
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
{{-- @foreach($posts as $post)
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


@endsection
