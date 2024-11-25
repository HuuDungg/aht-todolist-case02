<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>

<body>
    <form action="?act=save-task" method="POST">
        <h2>Edit Task</h2>

        <label for="title">id:</label>
        <input readonly type="text" id="id" name="id" value="<?php echo htmlspecialchars($task['id']); ?>" required><br><br>

        <label for="title">Task Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required><br><br>

        <label for="content">Task Content:</label>
        <textarea id="content" name="content" rows="4" required><?php echo htmlspecialchars($task['content']); ?></textarea><br><br>

        <label for="priority">Priority Level:</label>
        <select id="priority" name="priority" required>
            <option value="low" <?php if ($task['priority'] == 'low') echo 'selected'; ?>>Low</option>
            <option value="medium" <?php if ($task['priority'] == 'medium') echo 'selected'; ?>>Medium</option>
            <option value="high" <?php if ($task['priority'] == 'high') echo 'selected'; ?>>High</option>
        </select><br><br>

        <label for="completed">Completed:</label>
        <input type="checkbox" id="completed" name="completed" <?php if ($task['completed'] > 0) echo 'checked'; ?>><br>

        <button type="submit">Save Task</button>
    </form>
</body>

</html>