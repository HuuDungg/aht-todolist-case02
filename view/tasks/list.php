<?php
session_start();
$username = $_SESSION["user"];

if (!isset($username)) {
    header("Location: /todolist-case02/?act=login");
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
    <a href="/todolist-case02/?act=logout">logout</a>
    <h1>Wellcom back <?php echo $username ?> </h1>

    <form action="?act=processing-add" method="POST">
        <h2>Edit Task</h2>

        <label for="title">Task Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Task Content:</label>
        <textarea id="content" name="content" rows="4" required></textarea><br><br>

        <label for="status">Task Status:</label>

        <label for="priority">Priority Level:</label>
        <select id="priority" name="priority" required>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select><br><br>
        <button type="submit">Add Task</button>
    </form>
    <br>
    <form action="?act=search" method="POST">
        keyword: <input type="text" name="keyword">
        <br>
        <button>Search</button>
        <a href="/todolist-case02/?act=list-task">refresh</a>
        <br>
    </form>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>completed</th>
                <th>content</th>
                <th>priority</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($tasks)) {
                foreach ($tasks as $task) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($task['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($task['title']) . "</td>";
                    echo "<td>" ?>
                    <?php
                    if ($task['completed'] == 0) {
                        echo "not complete";
                    } else {
                        echo "complete";
                    }
                    ?>
            <?php "</td>";
                    echo "<td>" . htmlspecialchars($task['content']) . "</td>";
                    echo "<td>" . htmlspecialchars($task['priority']) . "</td>";
                    echo "<td>";
                    echo "<a href='?act=processing-edit&id=" . $task['id'] . "'>Edit</a> | ";
                    echo "<a href='?act=processing-delete&id=" . $task['id'] . "'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No tasks found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>