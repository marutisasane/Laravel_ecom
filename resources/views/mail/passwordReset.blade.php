<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password reset Link</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background-color: #2563eb;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 25px;
            line-height: 1.6;
        }

        .content h2 {
            color: #2563eb;
        }

        .btn {
            display: inline-block;
            background-color: #2563eb;
            color: #fff !important;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 15px;
        }

        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Welcome to {{ config('app.name') }}</h1>
        </div>

        <div class="content">
            <h2>Hello, {{ $user->name }} 👋</h2>

            <p>Thank you for registering with <strong>{{ config('app.name') }}</strong>.

            To reset your password, please click the button below:</p>

            <p style="text-align:center;">
                <a href="{{ $token }}" class="btn">Click to Reset Password</a>
            </p>

            <p>If you didn’t create this account, you can safely ignore this email.</p>

            <p>Thanks,<br>
            <strong>{{ config('app.name') }} Team</strong></p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
