<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                    <form action="auth/change-password.php" method="post">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" required>
                            
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                           
                        </div>
                        <p class="<?php echo isset($_SESSION['error']) && !$_SESSION['error'] ? 'text-success' : 'text-danger'; ?>"><?php echo isset($_SESSION['error']) && $_SESSION['error'] ? $_SESSION['message'] : ''; ?></p>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
