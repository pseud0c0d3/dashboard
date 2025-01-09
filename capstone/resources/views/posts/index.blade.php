@extends('layouts.master')

@section('content')

<h1 class="title" style="margin-top: 5%; left: 5; right: 5;">Latest Posts</h1>



    <!-- Scrollable container -->
    <div class="scrollable-posts" style="max-height: 100vh; overflow-y: auto; padding-right: 15px;margin-top:5%">
        @foreach($posts as $post)
            <div class="card mb-4 ">
                <div class="card-body">
                    <!-- User Info Section -->
                    <div class="d-flex align-items-center mb-3">
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
                        <p class="mb-2 fw-bold">{{ $post->title }}</p>

                        <p class="mb-3">{{ $post->body }}</p>

                        @if($post->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="img-fluid rounded"
                                    alt="{{ $post->image }}">
                            </div>
                        @endif

                    <!-- Like and Comment Actions -->
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-light">
                            <i class="bi bi-hand-thumbs-up"></i> Like
                        </button>
                        <button class="btn btn-light">
                            <i class="bi bi-chat-left-text"></i> Comment
                        </button>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="btn btn-success position-absolute" 
     style="bottom: 20px; right: 15%; z-index: 10; cursor: pointer;"
     data-bs-toggle="modal" 
     data-bs-target="#PostModal">
    Add a Post
</div>
    <!-- Modal -->
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



@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
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

document.getElementById('currentDate').textContent = new Date().toLocaleString();
</script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
