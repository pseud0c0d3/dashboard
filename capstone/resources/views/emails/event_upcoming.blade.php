<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Event Reminder</title>
</head>
<body>
    <h1>Hi {{ $event->user->name }},</h1>
    {{-- <p>This is a reminder that your event "{{ $event->title }}" is scheduled for {{ $event->start_date->format('F j, Y, g:i A') }}.</p> --}}
    <p>This is a reminder that your event "<?php echo e($event->title); ?>" is scheduled for <?php echo e(\Carbon\Carbon::parse($event->start_time)->format('F j, Y, g:i A')); ?>.</p>

    <p>Please let us know if you need further assistance.</p>
    <p>Best regards,</p>
    <p>The Team</p>
</body>
</html>
