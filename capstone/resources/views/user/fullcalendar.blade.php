@extends('layouts.user-nav')

@section('content')

<div id="calendar"></div>

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
            alert('Failed to load events. Please try again later.');
        },
    });

    calendar.render();
});


</script>

@endsection
