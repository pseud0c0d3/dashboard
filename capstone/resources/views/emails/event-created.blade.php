<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>
</head>
<body>
    <h1>{{ $event->title }}</h1>
    <p>{{ $event->description }}</p>
    <p><strong>Start Time:</strong> {{ $event->start_time }}</p>
    <p><strong>End Time:</strong> {{ $event->end_time }}</p>
    <p>Thank you for using our service!</p>
</body>
</html>
