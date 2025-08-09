<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Roboto', sans-serif; background: #f5e8c7; color: #264d29; margin: 0; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 20px; border-radius: 10px; }
        .header { background: #f4861f; color: white; text-align: center; padding: 10px; border-radius: 10px 10px 0 0; }
        .footer { text-align: center; font-size: 12px; color: #666; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"><h2>Karibu Jikoni</h2></div>
        <p>Hi {{ $user->name }},</p>
        <p>Use this code to verify your account: <strong>{{ $code }}</strong></p>
        <p>If you didn’t sign up, please ignore this email.</p>
        <div class="footer">&copy; {{ date('Y') }} Karibu Jikoni</div>
    </div>
</body>
</html>