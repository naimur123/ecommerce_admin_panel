<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>
<body>
    @if (!empty($user->email_verified_at))
    <p>Congrats Youre Loggedin</p>
    @else
     <p>Youre email is not verified</p>
    @endif
    
</body>
</html>