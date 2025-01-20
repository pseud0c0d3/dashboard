@extends('layouts.admin-nav')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.dashboard.pdf') }}" class="btn btn-primary position-fixed" style="top: 20px; right: 20px;">Download as PDF</a>
    </div>
    

    <!-- Date Range Filter -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="row mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Filter Reports from:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">to:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Reports Section -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Posts in Forum</h5>
                    <p class="card-text">{{ $newPostsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Users Registered</h5>
                    <p class="card-text">{{ $newUsersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Upcoming Events and Appointments</h6>
                    <p class="card-text">{{ $upcomingEventsCount }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Posts</h5>
                    <p class="card-text">{{ $totalPostsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Registered Users</h5>
                    <p class="card-text">{{ $totalUsersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Events and Appointments Made</h6>
                    <p class="card-text">{{ $appointmentsCount }}</p>
                </div>
            </div>
        </div>
        
    </div>
    
    
    

    
</div>
@endsection
