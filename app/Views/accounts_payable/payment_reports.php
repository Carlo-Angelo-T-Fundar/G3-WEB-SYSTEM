<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Reports - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .report-card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 15px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .btn-generate { background-color: #3B82F6; color: white; border: none; }
        .btn-generate:hover { background-color: #2563EB; }
        .btn-export { background-color: #10B981; color: white; border: none; }
        .btn-export:hover { background-color: #059669; }
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
            <a href="<?= base_url('accounts-payable/payment-reports') ?>" class="active">Payment Reports</a>
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
                <h3>Payment Reports</h3>
                <p>Generate and view payment analytics</p>

                <!-- Report Generator -->
                <div class="report-card">
                    <h5>Report Generator</h5>
                    <?php
                    // Backend integration: Form should post to reports controller
                    // Example: form_open(base_url('accounts-payable/generate-report'))
                    ?>
                    <form class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Report Type:</label>
                            <select class="form-select">
                                <option value="">-- Select Report Type --</option>
                                <option>Vendor Payment History</option>
                                <option>Monthly Payment Summary</option>
                                <option>Pending Payments Report</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date Range:</label>
                            <select class="form-select">
                                <option>This Month</option>
                                <option>Last Month</option>
                                <option>Custom</option>
                            </select>
                        </div>
                        <div class="col-12 d-flex gap-2 mt-3">
                            <button type="button" class="btn btn-generate">Generate Report</button>
                            <button type="button" class="btn btn-export">Export to Excel</button>
                        </div>
                    </form>
                </div>

                <!-- Recent Reports -->
                <div class="report-card">
                    <h5>Recent Reports</h5>
                    <?php
                    // Backend integration: Replace static reports with dynamic data
                    // Controller should pass $recentReports array to this view
                    ?>
                    <ul class="list-unstyled mt-2">
                        <li><strong>Monthly Payment Summary</strong> - August 2025<br>
                        Generated on 2025-08-23 10:15 AM</li>
                        <hr>
                        <li><strong>Vendor Payment History:</strong> ABC Suppliers</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
