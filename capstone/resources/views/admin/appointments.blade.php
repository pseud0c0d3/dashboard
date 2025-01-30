@extends('layouts.admin-nav')

@section('navbar_title', 'MANAGE APPOINTMENTS') 
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<style>
    .container {
        margin-top: 50px;
        padding: 15px;
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Make it responsive */
        gap: 15px;
        margin-top: -20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
    }

    .card input {
        width: 100%;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .card .form-group {
        margin-bottom: 8px;
    }

    .btn-container {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .pagination {
        margin-top: 20px;
    }

    

    .appointment-number {
        font-weight: bold;
        margin-right: 10px;
        font-size: 16px;
    }

    .appointment-title {
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        flex-grow: 1; /* Ensures title takes remaining space */
    }

    .card-header {
        display: flex;
        align-items: center; /* Aligns number and title vertically */
        justify-content: space-between; /* Ensures space between number and title */
    }

    .details {
        display: none;
        margin-top: 10px;
    }

    .card.show-details .details {
        display: block;
    }

    .card input,
    .card button {
        font-size: 14px;
    }

    /* Adjust for smaller screens */
    @media (max-width: 768px) {
        .card-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- Sorting buttons above the table -->
    <div class="mb-3">
        <a href="{{ route('appointments.index') }}?sort_order=asc" class="btn btn-secondary btn-sm">Sort by Date (Ascending)</a>
        <a href="{{ route('appointments.index') }}?sort_order=desc" class="btn btn-secondary btn-sm">Sort by Date (Descending)</a>
    </div>
     <!-- Display Sorting Title -->
     <div class="mb-3">
        @if(request()->get('sort_order') == 'asc')
            <h5>Sorted by Date (Latest)</h5>
        @elseif(request()->get('sort_order') == 'desc')
            <h5>Sorted by Date (Previous)</h5>
        @else
            <h5>Appointments</h5>
        @endif
    </div>


    <div class="card-container">
        @forelse ($events as $index => $event)
            <div class="card @if($loop->first) latest-appointment @endif" onclick="toggleDetails(this)">
                <!-- Appointment Header with number and title side by side -->
                <div class="card-header">
                    <div class="appointment-number">#{{ $index + 1 }}</div> <!-- Numbering starts from 1 -->
                    <div class="appointment-title">{{ $event->title }}</div>
                </div>

                <div class="details">
                    <form action="{{ route('appointments.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" class="form-control" name="description" value="{{ $event->description }}"/>
                        </div>

                        <div class="form-group">
                            <label for="email">Client</label>
                            <input type="text" id="email" class="form-control" name="email" value="{{ $event->user?->email ?? 'Public Event' }}" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="datetime-local" id="start_time" class="form-control" name="start_time" value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i') }}" required/>
                        </div>

                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="datetime-local" id="end_time" class="form-control" name="end_time" value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i') }}" required/>
                        </div>

                        <div class="btn-container">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <form action="{{ route('appointments.destroy', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="card col-span-2">
                <p class="text-center">No appointments found.</p>
            </div>
        @endforelse
    </div>

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

<script>
    function toggleDetails(card) {
        card.classList.toggle('show-details');
    }
</script>
@endsection
