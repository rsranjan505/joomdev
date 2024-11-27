<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joom Dev</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
    include('settings/config.php');

    $admin_users_found = false;

    $sql = "SELECT * FROM users WHERE user_type = 'admin'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $admin_users_found = true;
    } 
    
?>
<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">JoomDev</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="right">

                <ul class="navbar-nav ml-auto">
                    <?php
                        if (!$admin_users_found) {
                            echo '<li class="nav-item">
                                <a class="nav-link" href="settings/createAdmin.php">Create Admin</a>
                            </li>';
                        }
                        else
                        {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="auth/login-page.php">Login</a>
                        </li>
                    <?php

                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
