@extends('layouts.admin-nav')

@section('content')
<div class="container mt-5">
    <h1>Manage Appointments</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Sorting buttons above the table -->
    <div class="mb-3">
        <a href="{{ route('appointments.index') }}?sort_order=asc" class="btn btn-secondary btn-sm">Sort by Date (Ascending)</a>
        <a href="{{ route('appointments.index') }}?sort_order=desc" class="btn btn-secondary btn-sm">Sort by Date (Descending)</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Client</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
                <tr>
                    <form action="{{ route('appointments.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td>
                            <input type="text" class="form-control" style="width:auto" name="title" value="{{ $event->title }}" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" style="width:auto" name="description" value="{{ $event->description }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" style="width:auto" name="email" value="{{ $event->user?->email ?? 'Public Event' }}" readonly>
                        </td>
                        <td>
                            <input type="datetime-local" class="form-control" name="start_time" value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i') }}" required>
                        </td>
                        <td>
                            <input type="datetime-local" class="form-control" name="end_time" value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i') }}" required>
                        </td>

                        <td>
                            <form action="{{ route('appointments.update', $event->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>

                            <form action="{{ route('appointments.destroy', $event->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                            </form>
                        </td>
                    </form>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No appointments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    <!-- Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm">
            <!-- Previous Button -->
            <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $events->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <!-- Page Numbers -->
            @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $events->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            <!-- Next Button -->
            <li class="page-item {{ $events->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $events->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

</div>
@endsection
