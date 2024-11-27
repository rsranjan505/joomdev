<?php
    session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['email']);
    unset($_SESSION['first_name']);
    unset($_SESSION['user_type']);
    header("Location: login-page.php");
    exit;
