@extends('layouts.admin-nav')

@section('navbar_title', 'CLIENTS') 
@section('content')

<!-- Import Fonts & Custom Styles -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<style>
    /* Custom Styling */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
    }
    
    .card {
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table-responsive {
        max-height: 450px;
        overflow-y: auto;
    }
    .table th {
        position: sticky;
        top: 0;
        background: #343a40 !important;
        color: white !important;
    }
    .pagination .page-link {
        transition: 0.3s ease-in-out;
    }
    .pagination .page-link:hover {
        background-color: #007bff;
        color: white;
    }
    .btn-danger {
        transition: all 0.3s ease-in-out;
    }
    .btn-danger:hover {
        background-color: #dc3545;
        transform: scale(1.05);
    }
    /* Search Bar Animation */
    .search-input:focus {
        box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5);
        transition: 0.3s ease-in-out;
    }
</style>

<!-- Interactive UI Container -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📋 Registered Users</h5>

            <!-- Live Search -->
            <input type="text" id="searchInput" class="form-control w-50 search-input" placeholder="🔍 Search users...">
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Username</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number ?? 'N/A' }}</td>
                                <td>{{ $user->username ?? 'N/A' }}</td>
                                <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑 Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}">&laquo; Prev</a>
                        </li>

                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}">Next &raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Search & Delete Confirmation -->
<script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#userTable tr");

        rows.forEach(row => {
            let name = row.cells[1].textContent.toLowerCase();
            let email = row.cells[2].textContent.toLowerCase();
            let username = row.cells[4].textContent.toLowerCase();

            if (name.includes(filter) || email.includes(filter) || username.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    function confirmDelete() {
        return confirm("⚠️ Are you sure you want to delete this user?");
    }
</script>

@endsection
