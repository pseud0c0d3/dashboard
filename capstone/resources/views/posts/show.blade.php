@extends('layouts.user-nav')
@section('navbar_title', 'MAIN POSTS')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<style>
::-webkit-scrollbar {
    display: none;
}
/* Hover effect for the dropdown button */
#navbarDropdown:hover {
    background-color: #f8f9fa; /* Light background on hover */
    border-color: #007bff; /* Border color when hovered */
}

/* Hover effect for dropdown items with scale animation */
.dropdown-item:hover {
    background-color: #007bff; /* Blue background on hover */
    color: #fff; /* White text on hover */
    transform: scale(1.05); /* Slightly increase size */
    transition: transform 0.2s ease-in-out; /* Smooth transition */
}

/* Hover effect for the profile picture button */
.dropdown-toggle:hover img {
    opacity: 0.8; /* Slight opacity change for profile image on hover */
    transform: scale(1.15); /* Slightly increase size */

}
</style>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('posts.index') }}">MAIN POSTS</a>
        <!-- Dropdown Button with Image -->
        <div class="dropdown ms-4">
    <button
        class="btn btn-light dropdown-toggle d-flex align-items-center"
        type="button"
        id="navbarDropdown"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >
        <!-- Profile Picture or Initials -->
        @if(Auth::user()->picture)
            <img
                src="{{ asset('storage/' . Auth::user()->picture) }}"
                alt="Profile Picture"
                class="rounded-circle img-fluid"
                width="40"
                height="40"
                style="object-fit: cover; border: 2px solid #ddd;"
            >
        @else
            <div
                class="bg-light rounded-circle d-flex justify-content-center align-items-center shadow-sm"
                style="width: 40px; height: 40px; border: 2px solid #ff5722;"
            >
                <span class="h6 text-muted m-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>
            </div>
        @endif

        <!-- User Name (Visible except on mobile) -->
        <span class="ms-2 user-name">{{ Auth::user()->name }}</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="{{ route('user.faq') }}">Help</a></li>
        <li><a class="dropdown-item" href="{{ route('user.logout') }}">Log Out</a></li>
        <li><hr class="dropdown-divider"></li>
    </ul>
</div>

    </div>
</nav>


<div class="container mt-5 pt-5" style="auto; max-height: 100vh;">
    <div class="card" style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;">
    <div class="card-body">
        <!-- Post Title -->
        <h1 style="color: rgb(0, 0, 0); font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.8rem; text-transform: capitalize; margin-bottom: 0.5rem;">
            {{ $post->title }}
        </h1>

        <!-- Posted By -->
        <p style="font-family: 'Roboto', sans-serif; font-size: 0.9rem; color: rgb(102, 102, 102);">
            Posted by: <strong>{{ $post->user->name ?? 'Anonymous' }}</strong>
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
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
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
                        <img src="{{ asset('storage/default-profile.jpg') }}" class="rounded-circle me-3" width="40" height="40" alt="User">
                        <div>
                            <strong style="font-family: 'Poppins', sans-serif; font-size: 1rem; color: rgb(34, 34, 34);">
                                {{ $comment->user->name ?? 'Guest' }}
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
            <form action="{{ route('posts.comment', $post->id) }}" method="POST" id="commentForm{{ $post->id }}">
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

@endsection
