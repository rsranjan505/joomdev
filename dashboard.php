<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: auth/login-page.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" ></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Welcome to <?php echo $_SESSION['first_name']; ?></a>
            <div class="right">
                <ul class="navbar-nav ml-auto">
                   
                    <?php
                        if($_SESSION['user_type'] == 'admin')
                        {
                    ?>
                        <li class="nav-item ml-2">
                            <button class="btn btn-primary" onclick="changeTable('users')">Users</button>
                        </li>
                        <li class="nav-item ml-2">
                            <button class="btn btn-primary" onclick="changeTable('tasks')">Tasks</button>
                        </li>
                    <?php
                        }
                    ?>
                    <li class="nav-item ml-2">
                        <a class="nav-link" href="auth/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php 

        if($_SESSION['user_type'] == 'admin')
        {
            include('pages/admin-page.php');
        }
        else
        {
            if($_SESSION['last_password_change'] == null)
            {
                include('pages/user-change-password.php');

            }else{

                $datetime1 = new DateTime(date('Y-m-d H:i:s'));
                $datetime2 = new DateTime($_SESSION['last_password_change']);
                $interval = $datetime1->diff($datetime2);
                
                if($interval->format('%a') > 30)
                {
                    include('pages/user-change-password.php');
                }

                include('pages/user-page.php');
            }
        }
    ?>


</body>

<script>

    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    $("#auto_password").change(function() {
        if (this.checked) {
            $("#password").val(makeid(8));
        }
        else {
            $("#password").val('');
        }
    });
    
    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    $("#createUser").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "settings/create_employee.php",
            data: formData,
            success: function(response) {
                response = JSON.parse(response);
                
                if (response.success) {
                   $('#message').removeClass('text-danger').addClass('text-success').html('Employee created successfully');
                } else {
                    console.log(response);
                    if(response.type != '' && response.type != undefined) {
                        $('#error_'+response.type).html(response.message);
                    }
                    else {
                        $('#message').removeClass('text-success').addClass('text-danger').html(response.message);
                    }
                    
                }
            }
        });
    });


</script>
</html>
