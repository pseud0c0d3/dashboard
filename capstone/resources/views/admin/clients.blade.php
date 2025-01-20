@extends('layouts.admin-nav')

@section('content')
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
                        {{-- <th>Picture</th> --}}
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
                            {{-- <td>
                                @if($user->picture)
                                    <img src="{{ asset('storage/' . $user->picture) }}" alt="User Picture" width="50">
                                @else
                                    <span>No Picture</span>
                                @endif
                            </td> --}}
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
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
