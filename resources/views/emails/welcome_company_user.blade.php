<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            color: #374151;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 32px;
            border: 1px solid #e5e7eb;
        }
        .header {
            text-align: center;
            margin-bottom: 24px;
        }
        .header h1 {
            color: #111827;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }
        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin: 24px 0;
        }
        .button:hover {
            background-color: #4338ca;
        }
        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Welcome, {{ $user->name }}!</h1>
            </div>
            
            <p>We are thrilled to have you on board. Your company account has been created successfully.</p>
            
            <p>You can now access your dashboard to start managing your recruitment process.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('login') }}" class="button">Login to Dashboard</a>
            </div>
            
            <p>If you have any questions, feel free to reply to this email.</p>
            
            <p>Best regards,<br>The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
