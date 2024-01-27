<?php

include_once("setup.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    $sql = "INSERT INTO tasks (title, description, is_completed) VALUES (:title, :description, 0)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: index.php"); // redirect back do index.php 
    } catch (PDOException $e) {
        echo "Error creating task: " . $e->getMessage();
    }
}

?>
