@extends('layouts.admin-nav')

@section('content')

<style>
/* Style the modal and button placement if needed */
.add-event-btn {
    margin-left: 15px;
}
</style>

<div id="calendar"></div>

<!-- Modal for Adding Events -->
<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.events.create') }}" method="POST" id="eventForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="eventTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="eventTitle" name="title" required>
          </div>
          <div class="mb-3">
            <label for="eventDescription" class="form-label">Description</label>
            <textarea class="form-control" id="eventDescription" name="description"></textarea>
          </div>
          <div class="mb-3">
            <label for="startTime" class="form-label">Start Time</label>
            <input type="datetime-local" class="form-control" id="startTime" name="start_time" required>
          </div>
          <div class="mb-3">
            <label for="endTime" class="form-label">End Time</label>
            <input type="datetime-local" class="form-control" id="endTime" name="end_time" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="isPublic" name="is_public">
            <label class="form-check-label" for="isPublic">Make Public</label>
          </div>
          <div class="mb-3" id="exclusiveUserEmailGroup">
            <label for="userEmail" class="form-label">Exclusive User Email</label>
            <input type="email" class="form-control" id="userEmail" name="user_email">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Event</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Event Details Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="eventDetailsModalLabel">Event Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p><strong>Title:</strong> <span id="eventDetailsTitle"></span></p>
              <p><strong>Description:</strong> <span id="eventDetailsDescription"></span></p>
              <p><strong>Start Time:</strong> <span id="eventDetailsStartTime"></span></p>
              <p><strong>End Time:</strong> <span id="eventDetailsEndTime"></span></p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today addEventButton',
            center: 'title',
            right: 'multiMonthYear,dayGridMonth,timeGridWeek,listWeek',
        },
        customButtons: {
            addEventButton: {
                text: 'Add Event',
                click: function() {
                    new bootstrap.Modal(document.getElementById('addEventModal')).show();
                },
            },
        },
        initialView: 'dayGridMonth',
        editable: true,
        selectable: true,
        dayMaxEvents: true,
        events: '/admin/events', // Fetch all events for admins via AJAX
        
        eventClick: function(info) {
    // Safely populate modal fields
    document.getElementById('eventDetailsTitle').textContent = info.event.title || 'No Title Provided';
    document.getElementById('eventDetailsDescription').textContent = info.event.extendedProps.description || 'No Description Provided';
    document.getElementById('eventDetailsStartTime').textContent = info.event.start
        ? info.event.start.toLocaleString()
        : 'No Start Time Provided';
    document.getElementById('eventDetailsEndTime').textContent = info.event.end
        ? info.event.end.toLocaleString()
        : 'No End Time Provided';

    // Show modal
    new bootstrap.Modal(document.getElementById('eventDetailsModal')).show();
},

    });

    calendar.render();
    //submit event form below
});

document.getElementById('eventForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('/admin/events', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errors => {
                if (errors.message) {
                    alert(errors.message); // Display a general error message
                } else {
                    let errorMessages = Object.values(errors.errors || {}).flat().join('\n');
                    alert(errorMessages); // Display validation errors
                }
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.message) {
            alert(data.message);
            calendar.refetchEvents(); // Refresh events on the calendar
            bootstrap.Modal.getInstance(document.getElementById('addEventModal')).hide();
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>

@endsection
