<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - WeBuild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #F3F4F6; color: #1F2937; }
        .sidebar { background-color: #1E3A8A; height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: #D1D5DB; text-decoration: none; display: block; padding: 12px 20px; }
        .sidebar a:hover, .sidebar a.active { background-color: #3B82F6; color: white; }
        .topbar { background-color: #E5E7EB; padding: 10px 20px; display: flex; justify-content: space-between; }
        .dashboard-card { background: white; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h4 class="text-center">WeBuild</h4>
            <a href="#" class="active">Dashboard</a>
            <a href="pending_invoices.php">Pending Invoices</a>
            <a href="#">Approved Invoices</a>
            <a href="#">Payment Processing</a>
            <a href="#">Vendor Management</a>
            <a href="#">Payment Reports</a>
            <a href="#">Overdue Payments</a>
            <a href="#">Audit Trail</a>
            <a href="#">Settings</a>
        </div>
        <div class="col-md-10 p-0">
            <div class="topbar">
                <div>Date: <?php echo date("F j, Y"); ?> | Time: <?php echo date("h:i A"); ?></div>
                <div>Accounts Payable Clerk | Aslanie <a href="logout.php" class="btn btn-sm btn-outline-dark">Logout</a></div>
            </div>
            <div class="p-4">
                <h3>Accounts Payable Dashboard</h3>
                <div class="row mt-4">
                    <div class="col-md-3"><div class="dashboard-card"><h5>Pending Invoices</h5><p>24</p></div></div>
                    <div class="col-md-3"><div class="dashboard-card"><h5>Pending Payments</h5><p>45,230</p></div></div>
                    <div class="col-md-3"><div class="dashboard-card"><h5>Overdue Items</h5><p>8</p></div></div>
                    <div class="col-md-3"><div class="dashboard-card"><h5>This Month Processed</h5><p>12,450</p></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>