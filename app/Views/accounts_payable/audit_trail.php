<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Trail - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .content-card { background: white; border-radius: 10px; padding: 20px; margin-top: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .filter-bar { display: flex; gap: 10px; margin-bottom: 15px; }
        .activity-item { padding: 10px 0; border-bottom: 1px solid #E5E7EB; }
        .activity-item:last-child { border-bottom: none; }
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
            <a href="<?= base_url('accounts-payable/audit-trail') ?>" class="active">Audit Trail</a>
            <hr class="text-light">
            <a href="<?= base_url('auth/profile') ?>">Profile</a>
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
                <h3>Audit Trail</h3>
                <p>Track all payment transactions and system activities.</p>

                <!-- Filter Bar -->
                <div class="filter-bar">
                    <select class="form-select" style="max-width: 250px;">
                        <option value="">-- Filter by Activity --</option>
                        <option>All Activities</option>
                        <option>Payment Processed</option>
                        <option>Vendor Added</option>
                        <option>Invoice Approved</option>
                        <option>User Login</option>
                        <option>Settings Updated</option>
                    </select>
                    <input type="text" class="form-control" placeholder="Search activities..." style="max-width: 250px;">
                </div>

                <!-- Recent Activities -->
                <div class="content-card">
                    <h5>Recent Activities</h5>
                    <?php
                    // Backend integration: Replace static activities with dynamic audit data
                    // Controller should pass $auditActivities array to this view
                    // Example: $auditActivities = $auditModel->getRecentActivities();
                    ?>
                    <div class="activity-item">
                        <strong>Payment Processed</strong> - INV-2025-015 (₱14,500.00)<br>
                        by Warehouse Manager on 2025-08-23 10:30:15 UTC
                    </div>
                    <div class="activity-item">
                        <strong>Vendor Added</strong> - XYZ Materials added by Admin on 2025-08-22 09:12:45 UTC
                    </div>
                    <div class="activity-item">
                        <strong>Invoice Approved</strong> - INV-2025-012 approved by Finance Head on 2025-08-21 11:45:10 UTC
                    </div>
                    <!-- Additional activities will be generated from $auditActivities array -->
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>