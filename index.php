<!DOCTYPE html>
<html lang="sv">
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
include 'setup.php'; // Byt ut till ditt filnamn för databasanslutningen

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

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

<main class="main-section"> 
    <form action="create.php" method="post">
        <label for="title">Add task:</label>
        <input type="text" name="title" required>
        <button type="submit">Create task</button>
    </form>
</main>

<Footer class="footer"> <h6> Shaker Nasser - Chas Academy 2024  </h6></Footer>

</body>
</html>
