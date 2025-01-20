<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>
</head>
<body>
    <p><strong>Title:</strong> {{ $event->title ?? 'N/A' }}</p>
    <p><strong>Description:</strong> {{ $event->description ?? 'N/A' }}</p>
    <p><strong>Start Time:</strong> {{ $event->start_time ?? 'N/A' }}</p>
    <p><strong>End Time:</strong> {{ $event->end_time ?? 'N/A' }}</p>
    <p>Thank you for using our service!</p>
</body>
</html>
