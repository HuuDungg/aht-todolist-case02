<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: /todolist-case02/?act=list-task");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Login page</h1>
    <form action="?act=processing-login" method="POST">
        user name: <input type="text" name="username"> <br>
        password: <input type="password" name="password"> <br>
        <button>Login</button>
        <br>
        register an account <a href="/todolist-case02/?act=register">here</a>
    </form>
</body>

</html>