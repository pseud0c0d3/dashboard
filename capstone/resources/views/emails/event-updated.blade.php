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
    <p><strong>Title:</strong> {{ $event->title ?? 'N/A' }}</p>
    <p><strong>Description:</strong> {{ $event->description ?? 'N/A' }}</p>
    <p><strong>Start Time:</strong> {{ $event->start_time ?? 'N/A' }}</p>
    <p><strong>End Time:</strong> {{ $event->end_time ?? 'N/A' }}</p>
    </ul>
    <p>If you have any questions, feel free to contact us.</p>
</body>
</html>
