    @extends('layouts.master')

@section('content')
<div class="container">
    <!-- Scrollable container -->
    <div class="scrollable-posts" style="max-height: 70vh; overflow-y: auto; padding-right: 15px;">
        @foreach($posts as $post)
            <div class="card mb-4">
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
                        <p class="mb-3">{{ $post->body }}</p>

                        @if($post->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="img-fluid rounded"
                                    alt="{{ $post->title }}">
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

</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection
