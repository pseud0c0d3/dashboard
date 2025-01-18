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
        events: '/user/events', // Fetch events visible to the user via AJAX
    });

    calendar.render();
});

</script>

@endsection
