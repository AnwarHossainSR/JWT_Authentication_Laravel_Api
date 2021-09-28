<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 style="color: rgba(86, 88, 88, 0.027);">Email Verification Link</h2>
    <h2>Dear <span style="color: rgb(96, 9, 136);">{{ $details['user']->name }}</span> ,</h2>
    <p>We are requesting to verify your account to access further operation, please click bellow link to verify your email</p>
    <h1><a href="http://127.0.0.1:8000/verify/{{$details['token']}}/{{$details['email']}}" style="margin-top: 5px;margin-bottom: 5px;color:brown">Verify</a></h1>
    <p style="color: rgb(9, 7, 37)">Thank You</p>
    <a href="http://127.0.0.1:8000" style="color: blue">Go to website</a>
</body>
</html>
