@extends('layouts.master')

@section('content')
<div class="container"style="margin-top:5%;">
    <div class="card">
        <div class="card-body">
            <h1>{{ $post->title }}</h1>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-3" alt="{{ $post->title }}">
            @endif
            <p>{{ $post->body }}</p>
            
            <div class="d-flex">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary ms-auto" style="width:15%;">Back to Posts</a>
            </div>
        </div>
    </div>
    
</div>
@endsection
