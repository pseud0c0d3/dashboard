@extends('layouts.admin-nav')

@section('navbar_title', 'CALENDAR')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/nav.css">
<style>

    /* General Calendar Styles */
    #calendar {
        height: 85vh;
        width: 120vh;
        margin-top: 80px;
        color: white;
        padding: 30px;
        background-color:rgb(17, 28, 41);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .fc-header-toolbar {
        background: linear-gradient(to right, #3ABEF9, #009990);
        border-radius: 25px;
        padding: 15px;
        text-align: center;
        color: white;
    }

    .fc-toolbar-title {
        font-size: 1.8rem;
        font-weight: bold;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    .fc-button {
        background-color: #3ABEF9;
        border: none;
        color: white;
        border-radius: 8px;
        font-weight: bold;
        margin: 0 8px;
        transition: all 0.3s ease;
    }

    .fc-button:hover {
        background-color:rgb(15, 204, 191);
        transform: scale(1.1);
    }

    /* Date Cell Styles */
    .fc-daygrid-day {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 0px;
        position: relative;
        transition: all 0.2s ease;
    }

    .fc-daygrid-day:hover {
        background-color: #e0f7fa;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transform: scale(1.02);
    }

    .fc-day-today {
        background-color: #d1f2eb !important;
        border: 2px solid #3ABEF9 !important;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .fc-daygrid-day-number {
        font-size: 1rem;
        font-weight: bold;
        color: #495057;
    }

    /* Event Styles */
    .fc-daygrid-event {
        background: linear-gradient(to right, #009990, #3ABEF9);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 0.85rem;
        padding: 5px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .fc-daygrid-event:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Weekday Header Styles */
    .fc-col-header-cell {
        background: #3ABEF9;
        color: white;
        font-weight: bold;
        text-align: center;
        border-radius: 8px;
        padding: 10px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    /* Tooltip for Events */
    .tooltip {
        position: absolute;
        background: #3ABEF9;
        color: white;
        padding: 10px;
        border-radius: 8px;
        font-size: 0.85rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: none;
    }

    /* Responsive Design for Mobile */
    @media (max-width: 768px) {
        #calendar {
            height: 70vh;
            width: 95%;
            padding: 15px;
            margin: 10px auto;
        }

        .fc-header-toolbar {
            flex-direction: column;
            gap: 10px;
        }

        .fc-toolbar-title {
            font-size: 1.4rem;
        }

        .fc-button {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
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
                    <!-- Form Fields Here -->
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
                    <button type="submit" id="submitEventBtn" class="btn btn-primary">Save Event</button>
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
});

document.getElementById('eventForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Disable the submit button and make it grey
    const submitButton = event.target.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    submitButton.classList.add('btn-secondary'); // Add a grey color class

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
            // Refresh the page to close modal and update events
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error))
    .finally(() => {
        // Enable the submit button and remove grey color after the response is handled
        submitButton.disabled = false;
        submitButton.classList.remove('btn-secondary');
    });
});

document.addEventListener("DOMContentLoaded", function () {
        const isPublicCheckbox = document.getElementById("isPublic");
        const userEmailInput = document.getElementById("userEmail");

        function toggleUserEmail() {
            if (isPublicCheckbox.checked) {
                userEmailInput.disabled = true;
                userEmailInput.value = ""; // Clear the field when disabled
            } else {
                userEmailInput.disabled = false;
            }
        }

        // Run function on page load (if checkbox is pre-checked)
        toggleUserEmail();

        // Listen for checkbox change
        isPublicCheckbox.addEventListener("change", toggleUserEmail);
    });
    
</script>

@endsection
