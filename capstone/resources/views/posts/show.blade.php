@extends('layouts.user-nav')

@section('content')
<div class="container" style="margin-top:5%;">
    <div class="card">
        <div class="card-body">
            <h1>{{ $post->title }}</h1>

            <!-- Post Image -->
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-3" alt="{{ $post->title }}">
            @endif

            <!-- Post Content -->
            <p>{{ $post->body }}</p>

            <!-- Like and Back Buttons (Properly arranged) -->
            <div class="d-flex justify-content-between mt-3">

                <!-- Comment Button to trigger Modal -->
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#commentModal{{ $post->id }}">
                    <i class="bi bi-chat-left-text"></i> Comment
                </button>

                <!-- Back Button -->
                <a href="{{ route('posts.index') }}" class="btn btn-secondary ms-auto" style="width:15%;">Back to Posts</a>

            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card mt-4">
        <div class="card-body">
            <h5>Comments:</h5>

            <!-- Display Comments -->
            @if($post->comments->isEmpty())
                <p>No comments yet. Be the first to comment!</p>
            @else
                @foreach($post->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            <strong>
                                {{ $comment->user->name ?? 'Guest' }}
                            </strong>
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Comment Modal -->
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
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Comment</label>
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
