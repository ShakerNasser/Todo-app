<?php
include 'setup.php';

// Processa formulärdata om det är en POST-förfrågan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskId']) && isset($_POST['newTitle']) && isset($_POST['newDescription'])) {
    $taskId = $_POST['taskId'];
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
