@extends('layouts.admin-nav')

@section('content')
<div class="container" style="margin-top:5%;">
    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
        <div class="card-body">
            <h1 style="color:rgb(15, 93, 202);">{{ $post->title }}</h1>

            <!-- Display the name of the user who posted -->
            <p>Posted by: {{ $post->user->name ?? 'Anonymous' }}</p>

            <!-- Post Content -->
            <p>{{ $post->body }}</p>

            <!-- Like and Back Buttons -->
            <div class="d-flex justify-content-between mt-3">
                <!-- Comment Button -->
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#commentModal{{ $post->id }}">
                    <i class="bi bi-chat-left-text"></i> Comment
                </button>


                <!-- Back Button -->
                <a href="{{ route('posts.admin') }}" class="btn btn-primary">Back to Posts</a>

            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="card mt-4" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
        <div class="card-body">
            <h5>Comments:</h5>

            <!-- Display Comments -->
            @if($post->comments->isEmpty())
                <p>No comments yet. Be the first to comment!</p>
            @else
                @foreach($post->comments as $comment)
                    <div class="card mb-2" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                        <div class="card-body d-flex align-items-center">
                            <!-- User Avatar (Optional) -->
                            <img src="{{ asset('storage/default-profile.jpg') }}" class="rounded-circle me-3" width="40" height="40" alt="User">
                            <div>
                                <strong>{{ $comment->user->name ?? 'Guest' }}</strong>
                                <p class="mb-0">{{ $comment->content }}</p>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
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

<!-- External Resources -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
