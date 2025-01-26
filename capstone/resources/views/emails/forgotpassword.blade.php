<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
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
            <h1>Password Reset Request</h1>
        </div>
        <div class="content">
            <p>Hi,</p>
            <p>You requested a password reset. Please click the button below to reset your password:</p>
            <div class="btn-container">
                <a href="{{ $resetLink }}" class="btn">Reset Password</a>
            </div>
            <p>If you did not request this, you can safely ignore this email.</p>
        </div>
        {{-- <div class="footer">
            <p>If the button above does not work, copy and paste this link into your browser:</p>
            <p>{{ $resetLink }}</p>
        </div> --}}
    </div>
</body>
</html>

{{-- <!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>Click the link below to reset your password:</p>
    <a href="{{ $resetLink }}">{{ $resetLink }}</a>
    <p>If you did not request a password reset, please ignore this email.</p>
</body>
</html> --}}
