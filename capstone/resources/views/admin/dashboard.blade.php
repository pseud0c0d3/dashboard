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
    
    
    

    <!-- Registered Users Section -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Registered Users</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if($user->picture)
                                        <img src="{{ asset('storage/' . $user->picture) }}" alt="User Picture" width="50">
                                    @else
                                        <span>No Picture</span>
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number ?? 'N/A' }}</td>
                                <td>{{ $user->username ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
