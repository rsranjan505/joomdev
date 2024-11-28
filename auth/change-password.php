<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: login-page.php");
        exit;
    }

    include('../settings/config.php');

    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $confirm_password = $_POST['confirm_password'];
        $new_password = $_POST['new_password'];

        if ($new_password != $confirm_password) {
            $_SESSION['error'] = true;
            $_SESSION['message'] = 'Passwords do not match';
            header("Location: ../dashboard.php");
            exit;
        }

        $sql = "SELECT password FROM users WHERE email = '".$_SESSION['email']."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
 
                $sql = "UPDATE users SET password = '".password_hash($new_password, PASSWORD_DEFAULT)."', last_login = '".date('Y-m-d H:i:s')."', last_password_change = '".date('Y-m-d H:i:s')."' WHERE email = '".$_SESSION['email']."'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['last_login'] = date('Y-m-d H:i:s');
                    $_SESSION['last_password_change'] = date('Y-m-d H:i:s');
                    $_SESSION['error'] = false;
                    $_SESSION['message'] = 'Password changed successfully';
                    header("Location: ../dashboard.php");
                    exit;
                } else {
                    $_SESSION['error'] = true;
                    $_SESSION['message'] = 'Error: '. $sql . '<br>' . $conn->error;
                    header("Location: ../dashboard.php");
                    exit;
                }
           
        }
        else {
            $_SESSION['error'] = true;
            $_SESSION['message'] = 'Email is not registered';
            header("Location: ../dashboard.php");
            exit;
        }
    }

    $conn->close();
?>
