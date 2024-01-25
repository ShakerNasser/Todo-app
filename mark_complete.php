<?php
include 'setup.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskId']) && isset($_POST['isCompleted'])) {
    $taskId = $_POST['taskId'];
    $isCompleted = $_POST['isCompleted'];

    // Uppdatera is_completed i databasen
    $updateQuery = "UPDATE tasks SET is_completed = :isCompleted WHERE id = :taskId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':isCompleted', $isCompleted, PDO::PARAM_INT);
    $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $stmt->execute();

    // Omdirigera tillbaka till index.php efter uppdatering
    header("Location: index.php");
}
?>
