@extends('layouts.user-nav')

@section('content')

<div id="calendar">
    
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
          <p><strong>Title:</strong> <span id="eventTitle"></span></p>
          <p><strong>Description:</strong> <span id="eventDescription"></span></p>
          <p><strong>Start Time:</strong> <span id="eventStartTime"></span></p>
          <p><strong>End Time:</strong> <span id="eventEndTime"></span></p>
          <p><strong>Public:</strong> <span id="eventIsPublic"></span></p>
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
            left: 'prev,next today',
            center: 'title',
            right: 'multiMonthYear,dayGridMonth,timeGridWeek',
        },
        initialView: 'dayGridMonth',
        selectable: true,
        events: '/user/events', // Fetch events via AJAX
        eventSourceFailure: function() {
            console.error('Failed to load events. Please check the server response.');
        },
        eventClick: function(info) {
            console.log(info);  // Check the structure of the event object

            // Populate modal fields using extendedProps
            document.getElementById('eventTitle').textContent = info.event.title;
            document.getElementById('eventDescription').textContent = info.event.extendedProps.description || 'N/A';
            document.getElementById('eventStartTime').textContent = info.event.start.toLocaleString();
            document.getElementById('eventEndTime').textContent = info.event.end ? info.event.end.toLocaleString() : 'N/A';
            document.getElementById('eventIsPublic').textContent = info.event.extendedProps.is_public ? 'Yes' : 'No';

            // Show modal
            new bootstrap.Modal(document.getElementById('eventDetailsModal')).show();
        }
    });

    calendar.render();
});


</script>

@endsection
