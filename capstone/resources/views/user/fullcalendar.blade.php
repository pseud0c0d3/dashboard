@extends('layouts.user-nav')
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

<!-- Event Details Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background: linear-gradient(to right, #3ABEF9, #009990); color: white;">
                <h5 class="modal-title" id="eventDetailsModalLabel" style="font-weight: bold; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);">Event Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 20px; background-color:rgb(255, 255, 255);">
                <div class="mb-3">
                    <p style="font-size: 1.1rem; margin-bottom: 5px;"><strong>Title:</strong></p>
                    <span id="eventTitle" style="font-size: 1.2rem; color: #007bff; font-weight: bold;"></span>
                </div>
                <div class="mb-3">
                    <p style="font-size: 1.1rem; margin-bottom: 5px;"><strong>Description:</strong></p>
                    <span id="eventDescription" style="font-size: 1rem; color: #495057;"></span>
                </div>
                <div class="mb-3">
                    <p style="font-size: 1.1rem; margin-bottom: 5px;"><strong>Start Time:</strong></p>
                    <span id="eventStartTime" style="font-size: 1rem; color: #495057;"></span>
                </div>
                <div class="mb-3">
                    <p style="font-size: 1.1rem; margin-bottom: 5px;"><strong>End Time:</strong></p>
                    <span id="eventEndTime" style="font-size: 1rem; color: #495057;"></span>
                </div>
                <div class="mb-3">
                    <p style="font-size: 1.1rem; margin-bottom: 5px;"><strong>Public:</strong></p>
                    <span id="eventIsPublic" style="font-size: 1rem; color: #495057;"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toggle Sidebar Button -->
<button class="btn toggle-sidebar-btn d-md-none" onclick="toggleSidebar()">
    ☰
</button>


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
        events: '/user/events',
        eventSourceFailure: function() {
            console.error('Failed to load events. Please check the server response.');
        },
        eventClick: function(info) {
            document.getElementById('eventTitle').textContent = info.event.title;
            document.getElementById('eventDescription').textContent = info.event.extendedProps.description || 'N/A';
            document.getElementById('eventStartTime').textContent = info.event.start.toLocaleString();
            document.getElementById('eventEndTime').textContent = info.event.end ? info.event.end.toLocaleString() : 'N/A';
            document.getElementById('eventIsPublic').textContent = info.event.extendedProps.is_public ? 'Yes' : 'No';

            new bootstrap.Modal(document.getElementById('eventDetailsModal')).show();
        },
        eventDidMount: function(info) {
            if (info.event.extendedProps.color) {
                info.el.style.backgroundColor = info.event.extendedProps.color;
                info.el.style.borderColor = info.event.extendedProps.color;
            }

            // Tooltip on hover
            const tooltip = document.createElement('div');
            tooltip.classList.add('tooltip');
            tooltip.innerHTML = `<strong>${info.event.title}</strong><br>${info.event.extendedProps.description || 'No details available'}`;
            document.body.appendChild(tooltip);

            info.el.addEventListener('mouseenter', function() {
                tooltip.style.display = 'block';
                tooltip.style.top = `${info.el.getBoundingClientRect().top + window.scrollY - 40}px`;
                tooltip.style.left = `${info.el.getBoundingClientRect().left}px`;
            });

            info.el.addEventListener('mouseleave', function() {
                tooltip.style.display = 'none';
            });
        }
    });

    calendar.render();
});
</script>

@endsection
