<?php

    include('config.php');

    // Array of user data
    $user = [
            'first_name' => 'raj',
            'last_name' => 'ranjan',
            'email' => 'raj@gmail.com',
            'phone' => '1234567890',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'user_type' => 'admin'
        ];

    
    // Insert user in the database
    try
    {
        $sql = "INSERT INTO users (first_name, last_name, email, phone, password, user_type) VALUES ('".$user['first_name']."','".$user['last_name']."','".$user['email']."','".$user['phone']."','".$user['password']."','".$user['user_type']."')";
        if ($conn->query($sql) === TRUE) {
            echo 'Admin created successfully, redirecting in 2 seconds...';
            header("Refresh: 5; url=../index.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

    $conn->close();

?>