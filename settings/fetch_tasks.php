<?php

include('config.php');

session_start();

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tasks WHERE user_id = '$user_id'";

$result = $conn->query($sql);

$tasks = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}

echo json_encode($tasks);

$conn->close();

?>
