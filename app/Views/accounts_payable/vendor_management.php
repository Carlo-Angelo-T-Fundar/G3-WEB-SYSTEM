<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Management - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .vendor-card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 15px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .btn-add { background-color: #3B82F6; color: white; border: none; }
        .btn-add:hover { background-color: #2563EB; }
        .btn-edit { background-color: #F59E0B; color: white; border: none; }
        .btn-edit:hover { background-color: #D97706; }
        .btn-history { background-color: #10B981; color: white; border: none; }
        .btn-history:hover { background-color: #059669; }
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
            <a href="<?= base_url('accounts-payable/vendor-management') ?>" class="active">Vendor Management</a>
            <a href="<?= base_url('accounts-payable/payment-reports') ?>">Payment Reports</a>
            <a href="<?= base_url('accounts-payable/overdue-payments') ?>">Overdue Payments</a>
            <a href="<?= base_url('accounts-payable/audit-trail') ?>">Audit Trail</a>
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
                <h3>Vendor Management</h3>
                <p>Manage vendor information and payment terms</p>

                <!-- Add New Vendor Button -->
                <div class="mb-3">
                    <button class="btn btn-add">+ Add New Vendor</button>
                </div>

                <!-- Dynamic vendor data integration point -->
                <?php
                // Backend integration: Replace static vendor cards with dynamic data from database
                // Controller should pass $vendors array to this view
                // Example: $vendors = $vendorModel->findAll();
                ?>
                
                <!-- Vendor List -->
                <div class="vendor-card">
                    <h5>XYZ Materials</h5>
                    <p><strong>Payment Terms:</strong> Net 30</p>
                    <p><strong>Contact:</strong> Amarah Tador</p>
                    <p><strong>Phone:</strong> 09396987543</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-edit btn-sm">Edit</button>
                        <button class="btn btn-history btn-sm">View History</button>
                    </div>
                </div>

                <!-- Additional vendor cards should be generated from database -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>