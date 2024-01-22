<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo-Manager</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<header> 
    <h1 class="header">ToDo-App</h1>
</header>

<main class="main-section"> 
    <!-- Form for adding a task -->
    <form action="create.php" method="post" class="form-1">
        <label for="title"> Task title:</label>
        <input type="text" name="title" required>

        <label for="description">Task description:</label>
        <textarea name="description" rows="3"></textarea>

        <button type="submit" class="form-button">Create task</button>
    </form>
</main>

<?php
include 'setup.php';
include 'read.php';

// Fetch tasks from the database
$tasks = getTasks($conn);

if (count($tasks) > 0) {
    echo "<table>";
    echo "<tr><th>Task id</th><th>Title</th><th>Description</th><th>Completed</th><th>Action</th></tr>";
    foreach ($tasks as $task) {
        echo "<tr>";
        echo "<td>{$task['id']}</td>";
        echo "<td>{$task['title']}</td>";
        echo "<td>{$task['description']}</td>";
        echo "<td>{$task['is_completed']}</td>";
        echo "<td>";
        // echo "<form action='update.php' method='post'>";
        // echo "<input type='hidden' name='updateId' value='{$task['id']}'>";
        // echo "<button type='submit' class='action-button update'>Update</button></form>";
        echo "<form action='delete.php' method='post'>";
        echo "<input type='hidden' name='deleteId' value='{$task['id']}'>";
        echo "<a href='update.php?id={$task['id']}'>Update</a>";
        echo "<button type='submit' class='action-button delete'>Delete</button></form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}else {
    echo "<p class='no-tasks'> No task created. Create one! </p>";
}

?>

<footer class="footer"> 
    <h6>Shaker Nasser - Chas Academy 2024</h6>
</footer>

</body>
</html>
