<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Login' ?> - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .left-panel { background-color: #1E3A8A; color: white; display: flex; justify-content: center; align-items: center; flex-direction: column; padding: 40px; }
        .login-form { max-width: 400px; margin: auto; }
        .btn-login { background-color: #3B82F6; color: white; border: none; }
        .btn-login:hover { background-color: #2563EB; color: white; }
        a { color: #3B82F6; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .alert { margin-bottom: 20px; }
        .company-logo { 
            width: 80px; 
            height: 80px; 
            background: rgba(255,255,255,0.1); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin-bottom: 20px;
            font-size: 2rem;
        }
    </style>
</head>
<body>
<div class="container-fluid vh-100">
    <div class="row h-100">
        <div class="col-md-4 left-panel">
            <div class="company-logo">
                🏗️
            </div>
            <h3>WeBuild</h3>
            <p>Construction Company</p>
            <small class="text-light">Accounts Payable System</small>
        </div>
        <div class="col-md-8 d-flex justify-content-center align-items-center">
            <div class="login-form w-100">
                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <?= form_open(base_url('login'), ['class' => 'needs-validation', 'novalidate' => true]) ?>
                    <h4 class="mb-4 text-center">Sign in to your account</h4>
                    
                    <div class="mb-3">
                        <label for="login" class="form-label">Email or Username</label>
                        <input type="text" class="form-control <?= $validation->hasError('login') ? 'is-invalid' : '' ?>" 
                               name="login" id="login" value="<?= old('login') ?>" required 
                               placeholder="Enter your email or username">
                        <?php if ($validation->hasError('login')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('login') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= $validation->hasError('password') ? 'is-invalid' : '' ?>" 
                               name="password" id="password" required 
                               placeholder="Enter your password">
                        <?php if ($validation->hasError('password')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select <?= $validation->hasError('role') ? 'is-invalid' : '' ?>" name="role" id="role" required>
                            <option value="">-- Select Role --</option>
                            <option value="Warehouse Manager" <?= old('role') == 'Warehouse Manager' ? 'selected' : '' ?>>Warehouse Manager</option>
                            <option value="Warehouse Staff" <?= old('role') == 'Warehouse Staff' ? 'selected' : '' ?>>Warehouse Staff</option>
                            <option value="Inventory Auditor" <?= old('role') == 'Inventory Auditor' ? 'selected' : '' ?>>Inventory Auditor</option>
                            <option value="Procurement Officer" <?= old('role') == 'Procurement Officer' ? 'selected' : '' ?>>Procurement Officer</option>
                            <option value="Accounts Payable Clerk" <?= old('role') == 'Accounts Payable Clerk' ? 'selected' : '' ?>>Accounts Payable Clerk</option>
                            <option value="Accounts Receivable Clerk" <?= old('role') == 'Accounts Receivable Clerk' ? 'selected' : '' ?>>Accounts Receivable Clerk</option>
                            <option value="IT Administrator" <?= old('role') == 'IT Administrator' ? 'selected' : '' ?>>IT Administrator</option>
                            <option value="Top Management" <?= old('role') == 'Top Management' ? 'selected' : '' ?>>Top Management</option>
                        </select>
                        <?php if ($validation->hasError('role')): ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('role') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-3 text-end">
                        <a href="<?= base_url('forgot-password') ?>">Forgot Password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-login w-100 py-2">Log in</button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Need access? Contact your system administrator
                        </small>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Bootstrap form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
</body>
</html>