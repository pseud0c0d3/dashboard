@extends('layouts.admin-nav')
@section('navbar_title', 'MAIN POSTS')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5 pt-5" style="auto; max-height: 100vh;">
    <div class="card" style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;">
    <div class="card-body">
        @auth
        @if(Auth::id() === $post->admin_id)
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

        <!-- Post Title -->
        <h1 style="color: rgb(0, 0, 0); font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.8rem; text-transform: capitalize; margin-bottom: 0.5rem;">
            {{ $post->title }}
        </h1>

        <!-- Posted By -->
        <p style="font-family: 'Roboto', sans-serif; font-size: 0.9rem; color: rgb(102, 102, 102);">
            Posted by: <strong>
                {{ $post->admin->name ?? $post->user->name ?? 'Anonymous' }}
            </strong>
            
        </p>

        <!-- Post Content -->
        <p style="font-family: 'Roboto', sans-serif; font-size: 1rem; line-height: 1.6; color: rgb(34, 34, 34);">
            {{ $post->body }}
        </p>

        <!-- Buttons -->
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
        <h5 style="font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 1.5rem; margin-bottom: 1rem;">Comments:</h5>

        <!-- Display Comments -->
        @if($post->comments->isEmpty())
            <p style="font-family: 'Roboto', sans-serif; font-size: 0.9rem; color: rgb(102, 102, 102);">No comments yet. Be the first to comment!</p>
        @else
        @foreach($post->comments as $comment)
        <div class="card mb-2" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
            <div class="card-body d-flex align-items-center">
                <!-- User Avatar (Optional) -->
                {{-- <img src="{{ $comment->user->picture
                ? asset('storage/' . $comment->user->picture)
                : 'https://ui-avatars.com/api/?name=' . urlencode(substr($comment->user->name, 0, 1)) . '&background=random&color=fff&size=40' }}"
             class="rounded-circle me-3"
             width="40" height="40"
             alt="User"> --}}
                <div>
                    <strong style="font-family: 'Poppins', sans-serif; font-size: 1rem; color: rgb(34, 34, 34);">
                        {{ $comment->admin->name ?? $comment->user->name ?? 'Guest' }}
                    </strong>
                    <p class="mb-0" style="font-family: 'Roboto', sans-serif; font-size: 0.9rem; line-height: 1.4; color: rgb(34, 34, 34);">
                        {{ $comment->content }}
                    </p>
                    <small class="text-muted" style="font-family: 'Roboto', sans-serif; font-size: 0.8rem;">{{ $comment->created_at->diffForHumans() }}</small>
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
            <form action="{{ route('admin.comment', $post->id) }}" method="POST" id="commentForm{{ $post->id }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="commentSubmitBtn{{ $post->id }}">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" aria-labelledby="PostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PostModalLabel">Edit Your Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Title Input -->
                    <input type="text" name="title" class="form-control mb-3" value="{{ old('title', $post->title) }}" placeholder="Give your post a title!" required>

                    <!-- Body Input -->
                    <textarea name="body" class="form-control mb-3" placeholder="What do you want to share today?" rows="4" required>{{ old('body', $post->body) }}</textarea>

                    <!-- Image Input (optional) -->
                    {{-- <input type="file" name="image" class="form-control mb-3" accept="image/webp, image/png, image/jpg"> --}}
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
