<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Credentials - {{env('APP_NAME')}}</title>
</head>

<body>

    <h3>Hello,</h3>
    <p>Your account has been created at Chirrrp. Please use these login details to access your account.</p>
    <p>
        <strong>Login URL:</strong> <a href="{{ $credentials['url']}}">{{$credentials['url']}}</a><br>
        <strong>Email:</strong> {{$credentials['email']}}<br>
        <strong>Password:</strong> {{$credentials['password']}}<br>
    </p><br>
    <h4>Regards,<br>Team Chirrp</h4>
</body>

</html>
