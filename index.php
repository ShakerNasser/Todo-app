<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> ToDo-Manager </title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<header> 
<h1 class="header"> ToDo-App </h1>
</header>

<?php
// Hämta uppgifter från databasen
// $sql = "SELECT * FROM tasks";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     echo "<ul>";
//     while ($row = $result->fetch_assoc()) {
//         echo "<li>{$row['title']} - {$row['description']} - Completed: {$row['completed']}</li>";
//     }
//     echo "</ul>";
// } else {
//     echo "Inga uppgifter hittades.";
// }
// ?>


<form action="add_task.php" method="post">
    <label for="title">Add task:</label>
    <input type="text" name="title" required>
    <label for="description"> Describe the task:</label>
    <textarea name="description"></textarea>
    <button type="submit">Create task</button>
</form>


<Footer class="footer"> Shaker Nasser - Chas Academy 2024 </Footer>

</body>
</html>
