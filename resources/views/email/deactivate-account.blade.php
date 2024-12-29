<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Deactivate - {{env('APP_NAME')}}</title>
</head>

<body>

    <h3>Hi,</h3>
    <p>A user have deactivated his/her account. Here are the details.</p>
    <p>
        <strong>Name:</strong> {{$user['name']}} <br>
        <strong>Email:</strong> {{$user['email']}}<br>
        <strong>Phone:</strong> {{$user['phone']}}<br>
        <strong>User Type:</strong> {{$user['type']}}<br>
        <strong>Feedback Rating:</strong> {{$user['rating']}}<br><br>
        <strong>Feedback:</strong><br>{!! \Illuminate\Support\Str::replace(PHP_EOL, '<br>',$user['feedback'])!!}<br>
    </p>
</body>

</html>
