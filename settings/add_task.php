<?php
include('config.php');

session_start();

$user_id = $_SESSION['user_id'];

$start_time = $_POST['start_time'];
$stop_time = $_POST['stop_time'];
$notes = $_POST['notes'];
$description = $_POST['description'];
$response_msg = [];

if (empty($start_time)) {
    $response_msg['success'] = false;
    $response_msg['message'] = "Task name is required";
    echo json_encode($response_msg);
    exit;
}
if (empty($description)) {
    $response_msg['success'] = false;
    $response_msg['message'] = "Task description is required";
    echo json_encode($response_msg);
    exit;
}

// Insert task in the database
try {
    $sql = "INSERT INTO tasks (user_id,start_time,stop_time,notes,description) VALUES ('".$user_id."','".$start_time."', '".$stop_time."','".$notes."','".$description."')";
    if ($conn->query($sql) === TRUE) {
        $response_msg['success'] = true;
        $response_msg['message'] = "Task created successfully";

        $last_id = $conn->insert_id;
        $sql = "SELECT * FROM tasks WHERE id = '".$last_id."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $task = $result->fetch_assoc();
            $response_msg['task'] = $task;
        }
    } else {
        $response_msg['success'] = false;
        $response_msg['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }
} catch (Exception $e) {
    $response_msg['success'] = false;
    $response_msg['message'] = 'Caught exception: '.  $e->getMessage();
}

echo json_encode($response_msg);
$conn->close();
?>
