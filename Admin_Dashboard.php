<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

include('connect.php'); // Include your database connection

// Fetch the total number of users
$sql_total_users = "SELECT COUNT(*) AS total_users FROM users";
$result_total_users = $conn->query($sql_total_users);
$total_users = $result_total_users->fetch_assoc()['total_users'];

// Fetch the total number of pending users (assuming a statusType of 'Pending')
$sql_pending_users = "SELECT COUNT(*) AS pending_users FROM users WHERE statusType = 'Pending'";
$result_pending_users = $conn->query($sql_pending_users);
$pending_users = $result_pending_users->fetch_assoc()['pending_users'];

// Fetch the total number of approved users
$sql_total_approved_users = "SELECT COUNT(*) AS total_approved_users FROM users WHERE statusType IN ('Renter', 'Seller')";
$result_total_approved_users = $conn->query($sql_total_approved_users);
$total_approved_users = $result_total_approved_users->fetch_assoc()['total_approved_users'];

// Fetch the total number of banned users (assuming a statusType of 'Banned')
$sql_banned_users = "SELECT COUNT(*) AS banned_users FROM users WHERE statusType = 'Banned'";
$result_banned_users = $conn->query($sql_banned_users);
$banned_users = $result_banned_users->fetch_assoc()['banned_users'];

// For simplicity, if you want to display today's approved users,
// you may need to modify your database structure or track approval dates differently.
$today_approved_users = 0; // Set this to 0 or another way to track today's approved users.

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon Admin Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Admin_Dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <a href="">
                <img src="images/logo.png" alt="BookWagon Logo">
                <h1>
                    <span class="book-color">BOOK</span>
                    <span class="wagon-color">WAGON</span>
                </h1>
            </a>
        </div>
        <ul class="nav-list">
            <li class="nav-item active">
                <a href="Admin_Dashboard.php">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#manageUserSubmenu" data-bs-toggle="collapse">
                    <i class="bi bi-person-lines-fill"></i> Manage User <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <!-- Initially hide the submenu by removing the 'show' class -->
                <ul id="manageUserSubmenu" class="collapse sub-nav-list">
                    <li class="sub-nav-item">
                        <a href="Admin_Renter.php">Pending Renter</a>
                    </li>
                    <li class="sub-nav-item">
                        <a href="Admin_Seller.php">Pending Seller</a>
                    </li>
                    <li class="sub-nav-item">
                        <a href="Admin_Approved.php">Approved User</a>
                    </li>
                </ul>
                <li class="nav-item">
            <a href="logout.php">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h2>Total Users</h2>
                        <p class="statistic-value"><?php echo $total_users; ?></p>
                        <p class="statistic-description">Overall registered users</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h2>Pending Users</h2>
                        <p class="statistic-value"><?php echo $pending_users; ?></p>
                        <p class="statistic-description">Awaiting approval</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h2>Today's Approved Users</h2>
                        <p class="statistic-value"><?php echo $today_approved_users; ?></p>
                        <p class="statistic-description">Approved today</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center p-3">
                        <h2>Total Approved Users</h2>
                        <p class="statistic-value"><?php echo $total_approved_users; ?></p>
                        <p class="statistic-description">Total number of approved users</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-center p-3">
                        <h2>Banned Users</h2>
                        <p class="statistic-value"><?php echo $banned_users; ?></p>
                        <p class="statistic-description">Total banned users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
