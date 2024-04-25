
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Mail</title>
</head>
<body>
    <h1>Welcome</h1>
    <p>You are account created sucessfully</p>
    <p>Name: {{$emailData['first_name']}}</p>
    <p>Email:{{$emailData['email']}}</p>
    <p>Password:{{$emailData['password']}}</p>
</body>
</html>