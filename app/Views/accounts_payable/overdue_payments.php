<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overdue Payments - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .table-container { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .btn-pay { background-color: #3B82F6; color: white; border: none; }
        .btn-pay:hover { background-color: #2563EB; }
        .btn-contact { background-color: #F59E0B; color: white; border: none; }
        .btn-contact:hover { background-color: #D97706; }
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
            <a href="<?= base_url('accounts-payable/overdue-payments') ?>" class="active">Overdue Payments</a>
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
                <h3>Overdue Payments</h3>
                <p>Manage and prioritize overdue invoices</p>

                <div class="table-container mt-4">
                    <?php
                    // Backend integration: Replace static table with dynamic overdue invoice data
                    // Controller should pass $overdueInvoices array to this view
                    // Example: $overdueInvoices = $invoiceModel->getOverdueInvoices();
                    ?>
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice#</th>
                                <th>Vendor</th>
                                <th>Amount</th>
                                <th>Due Date</th>
                                <th>Days Overdue</th>
                                <th>Priority</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-2024-015</td>
                                <td>ABC Suppliers</td>
                                <td>3,450.00</td>
                                <td>2025-09-05</td>
                                <td>5 days</td>
                                <td><span class="badge bg-danger">High</span></td>
                                <td>
                                    <button class="btn btn-sm btn-pay">Pay Now</button>
                                    <button class="btn btn-sm btn-contact">Contact</button>
                                </td>
                            </tr>
                            <!-- Additional overdue invoices will be generated from $overdueInvoices array -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
