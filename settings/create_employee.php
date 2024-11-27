<?php

    include('config.php');

    // Array of user data
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $password = $_POST['password'] == '' ? password_hash('123456', PASSWORD_DEFAULT) : password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = 'user';


    $response_msg = [];

    if (empty($first_name)) {
        $response_msg['success'] = false;
        $response_msg['message'] = "first name is required";
        $response_msg['type'] = "first_name";
        echo json_encode($response_msg);
        exit;
    }
    if ( empty($last_name) ) {
        $response_msg['success'] = false;
        $response_msg['message'] = "last name is required";
        $response_msg['type'] = "last_name";
        echo json_encode($response_msg);
        exit;
    }
    if (empty($email)) {
        $response_msg['success'] = false;
        $response_msg['message'] = "email is required";
        $response_msg['type'] = "email";
        echo json_encode($response_msg);
        exit;
    }
    if (empty($phone)) {
        $response_msg['success'] = false;
        $response_msg['message'] = "phone is required";
        $response_msg['type'] = "phone";
        echo json_encode($response_msg);
        exit;
    }
 
    // Insert user in the database
    try
    {
        $sql = "INSERT INTO users (first_name, last_name, email, phone, password, user_type) VALUES ('".$first_name."','".$last_name."','".$email."','".$phone."','".$password."','".$user_type."')";
        if ($conn->query($sql) === TRUE) {
            $response_msg['success'] = true;
            $response_msg['message'] = "Employee created successfully";
        } else {
            $response_msg['success'] = false;
            $response_msg['message'] = "Error: " . $sql . "<br>" . $conn->error;
        }

    }catch (Exception $e) {
        $response_msg['success'] = false;
        $response_msg['message'] = 'Caught exception: '.  $e->getMessage();
    }

    echo json_encode($response_msg);

    $conn->close();

?>