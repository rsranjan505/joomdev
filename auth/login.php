<?php
    session_start();

    include('../settings/config.php');

    unset($_SESSION['email_error']);
    unset($_SESSION['password_error']);
    

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (empty($email) || empty($password)) {
            $_SESSION['message'] = 'Email and Password are required.';
            header("Location: login-page.php");
            exit;
        }

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['last_login'] = $user['last_login'];
                header("Location: ../dashboard.php");
                exit;
            }
            else {
                $_SESSION['password_error'] = 'Password is incorrect';
                header("Location: login-page.php");
               
                exit;
            }
        }
        else {
            $_SESSION['email_error'] = 'Email is not registered';
            header("Location: login-page.php");
            exit;
        }


         if (empty($email) || empty($password)) {
            $_SESSION['message'] = 'Email and Password are required.';
            header("Location: login-page.php");
            exit;
        }

        $conn->close();

    }

    if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
        header("Location: ../dashboard.php");
        exit;
    }
?>
