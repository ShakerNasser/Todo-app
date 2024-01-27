<?php

include_once("setup.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteId = $_POST['deleteId'];

    $sql = "DELETE FROM tasks WHERE id = $deleteId";

    try {
        $conn->exec($sql);
        header("Location: index.php"); // redirect back to the index.php 
    } catch (PDOException $e) {
        echo "Error deleting task: " . $e->getMessage();
    }
}


?> 