<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .left-panel { background-color: #1E3A8A; color: white; display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 40px; }
        .login-form { max-width: 400px; margin: auto; }
        .btn-login { background-color: #3B82F6; color: white; border: none; }
        .btn-login:hover { background-color: #2563EB; }
        a { color: #3B82F6; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-md-4 left-panel">
            <h3>WeBuild</h3>
            <p>Construction Company</p>
        </div>
        <div class="col-md-8 d-flex justify-content-center align-items-center">
            <form class="login-form w-100" action="process_login.php" method="POST">
                <h4 class="mb-4 text-center">Sign in to your account</h4>
                <div class="mb-3">
                    <label for="username" class="form-label">Email or Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" name="role" required>
                        <option value="">-- Select Role --</option>
                        <option>Warehouse Manager</option>
                        <option>Warehouse Staff</option>
                        <option>Inventory Auditor</option>
                        <option>Procurement Officer</option>
                        <option>Accounts Payable Clerk</option>
                        <option>Accounts Receivable Clerk</option>
                        <option>IT Administrator</option>
                        <option>Top Management</option>
                    </select>
                </div>
                <div class="mb-3 text-end">
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-login w-100">Log in</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
