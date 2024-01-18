<?php
$servername = "db"; //Samma namn som servicen i docker-compose.yml (vissa exempel har "localhost" men då måste man specifiera porten)
$username = "mariadb";
$password = "mariadb";
$dbname = "mariadb";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>