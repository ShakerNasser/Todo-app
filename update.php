<?php
include 'setup.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Hämta uppgiftsdata från databasen baserat på id
    $selectQuery = "SELECT * FROM tasks WHERE id = :taskId";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $stmt->execute();

    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$task) {
        echo "Task not found.";
        // Du kan också överväga att omdirigera användaren tillbaka till index.php
        // header("Location: index.php");
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Processa formulärdata om det är en POST-förfrågan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newTitle = $_POST['newTitle'];
    $newDescription = $_POST['newDescription'];

    // Uppdatera uppgiften i databasen
    $updateQuery = "UPDATE tasks SET title = :newTitle, description = :newDescription WHERE id = :taskId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':newTitle', $newTitle, PDO::PARAM_STR);
    $stmt->bindParam(':newDescription', $newDescription, PDO::PARAM_STR);
    $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $stmt->execute();

    // Omdirigera tillbaka till index.php efter uppdatering
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <!-- Lägg till länk till din CSS-fil här -->
    <link rel="stylesheet" href="./css/styles.css">
    
</head>
<body>

<h2>Update Task</h2>
<form action="update.php?id=<?= $task['id']; ?>" method="post">
    <label for="newTitle">New Title:</label>
    <input type="text" name="newTitle" value="<?= $task['title']; ?>" required>

    <label for="newDescription">New Description:</label>
    <textarea name="newDescription"><?= $task['description']; ?></textarea>

    <button type="submit">Update Task</button>
</form>

</body>
</html>
