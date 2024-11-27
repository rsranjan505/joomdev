<div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div id="users" class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Users</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Create Employee</button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>                                    
                                    <th scope="col">First Name</th> 
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('settings/config.php');
                                    $sql = "SELECT * FROM users";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>'.$row['first_name'].'</td>';
                                            echo '<td>'.$row['last_name'].'</td>';
                                            echo '<td>'.$row['email'].'</td>';
                                            echo '<td>'.$row['phone'].'</td>';
                                            echo '<td>'.$row['user_type'].'</td>';
                                            
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No users found.</td></tr>';
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="tasks" style="display: none;" class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Tasks</h5>
                            <a href="settings/export-task.php" class="btn btn-primary" >Export</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>                                    
                                    <th scope="col">Start Time</th> 
                                    <th scope="col">Stop Time</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include('settings/config.php');
                                    $sql = "SELECT * FROM tasks";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>'.$row['start_time'].'</td>';
                                            echo '<td>'.$row['start_time'].'</td>';
                                            echo '<td>'.$row['notes'].'</td>';
                                            echo '<td>'.$row['description'].'</td>';
                                            
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No tasks found.</td></tr>';
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
   
            </div>
        </div>
    </div>


    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createUser" action="" method="post">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" required>
                            <span id="error_first_name" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" required>
                            <span id="error_last_name" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                            <span id="error_email" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                            <span id="error_phone" class="text-danger"></span>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="auto_password" id="auto_password" value="0">
                            <label class="form-check-label" for="auto_password">Auto Generate Password</label>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                           
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select class="form-control" name="user_type" id="user_type">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <p id="message"></p>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
            function changeTable(table) {
                if (table == "users") {
                    document.getElementById("users").style.display = "block";
                    document.getElementById("users").classList.add('active');
                    
                    document.getElementById("tasks").style.display = "none";
                } else if (table == "tasks") {
                    document.getElementById("users").style.display = "none";
                    document.getElementById("tasks").classList.add('active');
                    document.getElementById("tasks").style.display = "block";
                }
            }

    </script>