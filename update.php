<?php
include 'setup.php';

// Process the form data if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskId']) && isset($_POST['newTitle']) && isset($_POST['newDescription'])) {
    $taskId = $_POST['taskId'];
    $newTitle = $_POST['newTitle'];
    $newDescription = $_POST['newDescription'];

    // Update the task in the database
    $updateQuery = "UPDATE tasks SET title = :newTitle, description = :newDescription WHERE id = :taskId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':newTitle', $newTitle, PDO::PARAM_STR);
    $stmt->bindParam(':newDescription', $newDescription, PDO::PARAM_STR);
    $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect back to index.php after update adn exit the statement 
    header("Location: index.php");
    exit();
}
?>

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
        <h1 class="header"> ToDo-App </h1>
    </header>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['taskId'])) {
            $taskId = $_POST['taskId'];

            // Fetch task data from database based on id
            $selectQuery = "SELECT * FROM tasks WHERE id = :taskId";
            $stmt = $conn->prepare($selectQuery);
            $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
            $stmt->execute();

            $task = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$task) {
                echo "Task not found.";
                header("Location: index.php");
                exit();
            }

            // Showing the form for update function 
            echo "<form action='update.php' method='post' class='update-form'>";
            echo "<input type='hidden' name='taskId' value='{$task['id']}'>";
            echo "<label for='newTitle'>New task title:</label>";
            echo "<input type='text' name='newTitle' value='{$task['title']}' required>";
            echo "<label for='newDescription'>New task description:</label>";
            echo "<textarea name='newDescription' rows='3'>{$task['description']}</textarea>";
            echo "<button type='submit' class='action-button'>Update Task</button>";
            echo "</form>";
        }
        ?>

        <?php
        include 'setup.php';
        include 'read.php';

        // Fetch tasks from the database
        $tasks = getTasks($conn);

        if (count($tasks) > 0) {
            echo "<table>";
            echo "<tr><th>Task id</th><th>Task</th><th>Task description</th><th>Completed</th><th>Action</th></tr>";
            foreach ($tasks as $task) {
                echo "<tr>";
                echo "<td>{$task['id']}</td>";
                echo "<td>{$task['title']}</td>";
                echo "<td>{$task['description']}</td>";
                echo "<td>";
                echo "<form action='mark_complete.php' method='post'>";
                echo "<input type='hidden' name='taskId' value='{$task['id']}'>";
                echo "<input type='checkbox' name='isCompleted' value='1' onchange='this.form.submit()' " . ($task['is_completed'] ? 'checked' : '') . ">";
                echo "</form>";
                echo "</td>";
                echo "<td class='action-buttons-container'>";
                echo "<form action='update.php' method='post'>";
                echo "<input type='hidden' name='taskId' value='{$task['id']}'>";
                echo "<button type='submit' id ='button-update'class='action-button update' name='action' value='update'>Update</button></form>";
                echo "<form action='delete.php' method='post'>";
                echo "<input type='hidden' name='deleteId' value='{$task['id']}'>";
                echo "<button type='submit' class='action-button delete'>Delete</button></form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-tasks'> No task found. Create one! </p>";
        }
        ?>

    </main>

    <footer class="footer">
        <div>
        <h6> Shaker Nasser - Chas Academy 2024 </h6>
        </div>
    </footer>

</body>

</html>