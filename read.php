<?php

include ("setup.php");

function getTasks($conn) {
    $tasks = [];
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $row;
        }
    }

    return $tasks;
}

?>
