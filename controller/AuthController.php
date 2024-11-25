<?php
class AuthController
{
    private $conn;
    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $port = 3306;
        $dbname = "todo";
        $this->conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    }

    public function login()
    {
        require("./view/auth/login.php");
    }

    public function processingLogin()
    {
        try {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($password === $user['password']) {
                    session_start();
                    $_SESSION['user'] = $user['id'];
                    header("Location: /todolist-case02/?act=list-task");
                } else {
                    echo "Incorrect password.";
                }
            } else {
                echo "User not found.";
            }
        } catch (PDOException $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function register()
    {
        require("./view/auth/register.php");
    }

    public function processingRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                echo "pasword not match, try again";
                return;
            }

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            if ($stmt->rowCount() > 0) {
                echo "username already exist";
                return;
            }

            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $password]);

            echo "register successfuly";
            echo "<a href='/todolist-case02/?act=list-task'>go to login page</a>";
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /todolist-case02/?act=login");
    }
}
