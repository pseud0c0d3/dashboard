<!DOCTYPE html>
<html>
<head>
    <title>Event Updated</title>
</head>
<body>
    <h1>Hello {{ $event->user->name }},</h1>
    <p>Your event "{{ $event->title }}" has been updated.</p>
    <p>Here are the updated details:</p>
    <ul>
        <li><strong>Title:</strong> {{ $event->title }}</li>
        <li><strong>Description:</strong> {{ $event->description }}</li>
        <li><strong>Start Time:</strong> {{ $event->start_time }}</li>
        <li><strong>End Time:</strong> {{ $event->end_time }}</li>
    </ul>
    <p>If you have any questions, feel free to contact us.</p>
</body>
</html>
