@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-3" alt="{{ $post->title }}">
    @endif
    <p>{{ $post->body }}</p>
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
</div>
@endsection
