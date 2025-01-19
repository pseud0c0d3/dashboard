@extends('layouts.admin-nav')

@section('content')
<div class="container mt-5">
    <h1>Manage Appointments</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
            @foreach ($events as $event)
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
