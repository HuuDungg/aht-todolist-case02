<?php
class TaskController
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
    public function display()
    {
        $stmt = $this->conn->prepare("SELECT * FROM tasks");
        $stmt->execute();

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require("./view/tasks/list.php");
    }
    public function create()
    {
        session_start();
        $title = $_POST["title"];
        $content = $_POST["content"];
        $priority = $_POST["priority"];
        $user_id = $_SESSION["user"];

        $completed = 0;

        $stmt = $this->conn->prepare(
            "INSERT INTO `tasks` (`title`, `content`, `user_id`, `priority`, `completed`) 
        VALUES (:title, :content,  :user_id, :priority, :completed)"
        );

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':completed', $completed);

        $stmt->execute();

        header("Location: /todolist-case02/?act=list-task");
        exit();
    }


    public function delete()
    {
        $id = $_GET["id"];
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: /todolist-case02/?act=list-task");
    }

    public function edit()
    {
        $id = $_GET["id"];

        $stmt = $this->conn->prepare("SELECT * FROM `tasks` WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($task) {
            require("./view/tasks/edit.php");
        } else {
            echo "No task found with ID $id";
        }
    }

    public function save()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $title = $_POST["title"];
            $content = $_POST["content"];
            $user_id = $_SESSION["user"];
            $priority = $_POST["priority"];

            $completed = isset($_POST["completed"]) ? 1 : 0;

            $stmt = $this->conn->prepare("UPDATE `tasks` SET `title` = :title, `content` = :content, `user_id` = :user_id, `priority` = :priority, `completed` = :completed WHERE `id` = :id");


            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':priority', $priority);
            $stmt->bindParam(':completed', $completed);


            if ($stmt->execute()) {
                header("Location: /todolist-case02/?act=list-task");
                exit;
            } else {
                echo "Error: Could not update task.";
            }
        }
    }

    public function search()
    {

        $search_term = '%' . $_POST['keyword'] . '%';

        $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE title LIKE :search_term OR content LIKE :search_term ORDER BY id ASC");
        $stmt->bindParam(':search_term', $search_term);
        $stmt->execute();

        $tasks = $stmt->fetchAll();

        require("./view/tasks/list.php");
    }
}
