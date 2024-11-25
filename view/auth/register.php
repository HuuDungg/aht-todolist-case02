<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Register page</h1>
    <form action="?act=processing-register" method="POST">
        user name: <input type="text" name="username"> <br>
        password: <input type="password" name="password"> <br>
        confirm password: <input type="password" name="confirm_password"> <br>
        <button>register</button>
        <br>
        have an account <a href="/todolist-case02/?act=login">login</a>
    </form>
</body>

</html>