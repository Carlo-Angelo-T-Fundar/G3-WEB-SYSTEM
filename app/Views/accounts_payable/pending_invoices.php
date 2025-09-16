<?php
// pending_invoices.php
// (Optional: Start session if login is required)
// session_start();
// $username = $_SESSION['username'] ?? 'Aslanie';
// $role = $_SESSION['role'] ?? 'Accounts Payable Clerk';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Invoices - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .table-container { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
        .btn-approve { background-color: #10B981; color: white; border: none; }
        .btn-approve:hover { background-color: #059669; }
        .btn-reject { background-color: #EF4444; color: white; border: none; }
        .btn-reject:hover { background-color: #DC2626; }
        .btn-new { background-color: #3B82F6; color: white; border: none; }
        .btn-new:hover { background-color: #2563EB; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4 class="text-center">WeBuild</h4>
            <a href="<?= base_url('accounts-payable/dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('accounts-payable/pending-invoices') ?>" class="active">Pending Invoices</a>
            <a href="<?= base_url('accounts-payable/approved-invoices') ?>">Approved Invoices</a>
            <a href="<?= base_url('accounts-payable/payment-processing') ?>">Payment Processing</a>
            <a href="<?= base_url('accounts-payable/vendor-management') ?>">Vendor Management</a>
            <a href="<?= base_url('accounts-payable/payment-reports') ?>">Payment Reports</a>
            <a href="<?= base_url('accounts-payable/overdue-payments') ?>">Overdue Payments</a>
            <a href="<?= base_url('accounts-payable/audit-trail') ?>">Audit Trail</a>
            <hr class="text-light">
            <a href="<?= base_url('auth/profile') ?>">Profile</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-0">

            <!-- Top Bar -->
            <div class="topbar">
                <div>
                    Date: <?php echo date("F j, Y"); ?> |
                    Time: <?php echo date("h:i A"); ?>
                </div>
                <div>
                    <?= session()->get('role') ?> | <?= session()->get('name') ?> 
                    <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-dark">Logout</a>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-4">
                <h3>Pending Invoices</h3>
                <p>Review and process vendor invoices awaiting approval</p>

                <!-- Search & Actions -->
                <div class="d-flex justify-content-between mb-3">
                    <input type="text" class="form-control w-25" placeholder="Search invoice...">
                    <button class="btn btn-new">+ New Invoice</button>
                </div>

                <?php
                // Backend integration: Replace static invoice table with dynamic data
                // Controller should pass $pendingInvoices array to this view
                // Example: $pendingInvoices = $invoiceModel->getPendingInvoices();
                ?>

                <!-- Invoices Table -->
                <div class="table-container">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice #</th>
                                <th>Vendor</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>INV-2024-001</td>
                                <td>ABC Construction Supplies</td>
                                <td>$4,500.00</td>
                                <td>Pending</td>
                                <td>September 3, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-approve">Approve</button>
                                    <button class="btn btn-sm btn-reject">Reject</button>
                                </td>
                            </tr>
                            <tr>
                                <td>INV-2024-002</td>
                                <td>XYZ Tools & Equip</td>
                                <td>$2,300.00</td>
                                <td>Pending</td>
                                <td>September 2, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-approve">Approve</button>
                                    <button class="btn btn-sm btn-reject">Reject</button>
                                </td>
                            </tr>
                            <!-- Additional invoices will be generated from $pendingInvoices array -->
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