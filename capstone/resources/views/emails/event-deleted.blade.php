<!DOCTYPE html>
<html>
<head>
    <title>Upcoming Event Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
        background-color: rgb(0, 134, 255);
        color: #fff;
        text-align: center;
        padding: 20px;
        font-size: 24px; /* Increase the font size */
        font-weight: bold; /* Make the font bold */
        }
        .content {
            padding: 30px;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            color: #000000;
            background-color: #ffbf00;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #e6a700;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <p>Event Canceled</p>
    </div>
    <div class="content">
        <h1>Hello {{ $event->user->name }},</h1>
    <p>Your event "{{ $event->title }}" has been canceled.</p>
    <p>If you need further assistance, please contact us.</p>
    <p>Thank you!</p>
    {{-- <div class="footer">
        <p>If the button above does not work, copy and paste this link into your browser:</p>
        <p>{{ $resetLink }}</p>
    </div> --}}
</div>
</body>
</html>
