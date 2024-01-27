<?php
include 'setup.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];
    $isCompleted = isset($_POST['isCompleted']) ? $_POST['isCompleted'] : 0;

    // update is_completed in the database
    $updateQuery = "UPDATE tasks SET is_completed = :isCompleted WHERE id = :taskId";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bindParam(':isCompleted', $isCompleted, PDO::PARAM_INT);
    $stmt->bindParam(':taskId', $taskId, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: index.php");
    exit(); // redirect back to index.php and end the if statement
}

?>
