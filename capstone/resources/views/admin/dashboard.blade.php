@extends('layouts.admin-nav') <!-- Adjust to your layout -->

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Admin Dashboard</h1>
    
    <form action="{{ route('admin.dashboard') }}" method="GET" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date', now()->format('Y-m-d')) }}">
            </div>
            <div class="col-auto">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">New Forum Posts</h5>
                    <p class="card-text display-4">{{ $newPostsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">New Users</h5>
                    <p class="card-text display-4">{{ $newUsersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Appointments Made</h5>
                    <p class="card-text display-4">{{ $appointmentsCount }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
