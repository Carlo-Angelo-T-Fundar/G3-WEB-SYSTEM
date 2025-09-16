<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .settings-card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 15px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .btn-save { background-color: #3B82F6; color: white; border: none; }
        .btn-save:hover { background-color: #2563EB; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4 class="text-center">WeBuild</h4>
            <a href="<?= base_url('accounts-payable/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('accounts-payable/pending-invoices') ?>">Pending Invoices</a>
            <a href="<?= base_url('accounts-payable/approved-invoices') ?>">Approved Invoices</a>
            <a href="<?= base_url('accounts-payable/payment-processing') ?>">Payment Processing</a>
            <a href="<?= base_url('accounts-payable/vendor-management') ?>">Vendor Management</a>
            <a href="<?= base_url('accounts-payable/payment-reports') ?>">Payment Reports</a>
            <a href="<?= base_url('accounts-payable/overdue-payments') ?>">Overdue Payments</a>
            <a href="<?= base_url('accounts-payable/audit-trail') ?>">Audit Trail</a>
            <hr class="text-light">
            <a href="<?= base_url('auth/profile') ?>" class="active">Profile</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">
            <div class="topbar">
                <div>Date: <?php echo date("F j, Y"); ?> | Time: <?php echo date("h:i A"); ?></div>
                <div>
                    <?= session()->get('role') ?> | <?= session()->get('name') ?> 
                    <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-dark">Logout</a>
                </div>
            </div>
            <div class="p-4">
                <h3>Settings</h3>
                <p>Manage your account preferences and notifications</p>

                <!-- User Profile -->
                <div class="settings-card">
                    <h5>User Profile</h5>
                    <?php
                    // Backend integration: Form should post to profile update controller
                    // Example: form_open(base_url('auth/update-profile'))
                    // Pre-populate fields with current user data from session
                    ?>
                    <form class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Full Name:</label>
                            <input type="text" class="form-control" value="<?= session()->get('name') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role:</label>
                            <input type="text" class="form-control" value="<?= session()->get('role') ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-control" value="<?= session()->get('email') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone:</label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </form>
                </div>

                <!-- Notification Preferences -->
                <div class="settings-card">
                    <h5>Notification Preferences</h5>
                    <?php
                    // Backend integration: Load user notification preferences from database
                    // Controller should pass $notificationPrefs to this view
                    ?>
                    <form class="mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="emailNotif" checked>
                            <label class="form-check-label" for="emailNotif">
                                Email notifications for overdue payments
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="dailySummary">
                            <label class="form-check-label" for="dailySummary">
                                Daily summary reports
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="smsAlerts">
                            <label class="form-check-label" for="smsAlerts">
                                SMS alerts for urgent payments
                            </label>
                        </div>
                        <button type="button" class="btn btn-save mt-3">Save Settings</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>