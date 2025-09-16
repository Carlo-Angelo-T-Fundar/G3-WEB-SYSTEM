<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Processing - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .dashboard-card { background: white; border-radius: 10px; padding: 20px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .btn-process { background-color: #3B82F6; color: white; border: none; }
        .btn-process:hover { background-color: #2563EB; }
        .btn-reports { background-color: #10B981; color: white; border: none; }
        .btn-reports:hover { background-color: #059669; }
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
            <a href="<?= base_url('accounts-payable/payment-processing') ?>" class="active">Payment Processing</a>
            <a href="<?= base_url('accounts-payable/vendor-management') ?>">Vendor Management</a>
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
                <h3>Payment Processing</h3>
                <p>Process payments for approved invoices</p>

                <?php
                // Backend integration: Replace static cards with dynamic payment data
                // Controller should pass payment statistics to this view
                // Example: $paymentStats = $paymentModel->getPaymentStatistics();
                ?>

                <!-- Cards Section -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h5>6 Ready for Payment</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h5>₱25,000</h5>
                            <p>Total Amount</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h5>3 Scheduled Payments</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dashboard-card">
                            <h5>₱156,653</h5>
                            <p>Month Total Paid</p>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex gap-3">
                    <button class="btn btn-process">Process Batch Payment</button>
                    <button class="btn btn-reports">View Payment Reports</button>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>