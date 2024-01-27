<?php
include 'setup.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];
    $isCompleted = isset($_POST['isCompleted']) ? $_POST['isCompleted'] : 0;

    // Uppdatera is_completed i databasen
    $updateQuery = "UPDATE tasks SET is_completed = :isCompleted WHERE id = :taskId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':isCompleted', $isCompleted, PDO::PARAM_INT);
    $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $stmt->execute();

    // Omdirigera tillbaka till index.php efter uppdatering
    header("Location: index.php");
    exit(); // Lägg till detta för att avsluta scriptet efter omdirigering
}

?>
