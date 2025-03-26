<?php
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon - Seller Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/seller_profile.css">
</head>

<body>
    <!-- Header and nav -->
    <?php include('includes/seller_navbar.php'); ?>

    <!-- Main content -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="seller_profile.php" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-person-circle me-2"></i> My Profile
                    </a>
                    <a href="seller_dashboard.php" class="list-group-item list-group-item-action d-flex align-items-center active">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="seller_booklist.php" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-book me-2"></i> Book Listing
                    </a>
                    <a href="logout.php" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Dashboard content -->
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Overview</h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3>15</h3>
                                <p>Total Books Listed</p>
                            </div>
                            <div>
                                <h3>P200.00</h3>
                                <p>Total Sales</p>
                            </div>
                            <div>
                                <h3>1</h3>
                                <p>Books Rented</p>
                            </div>
                            <div>
                                <h3>5</h3>
                                <p>Total Renters</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Activity</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Book</th>
                                    <th>Units Sold</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Book Title 1</td>
                                    <td>15</td>
                                    <td>Sold</td>
                                </tr>
                                <tr>
                                    <td>Book Title 2</td>
                                    <td>22</td>
                                    <td>Rented</td>
                                </tr>
                                <tr>
                                    <td>Book Title 3</td>
                                    <td>10</td>
                                    <td>Sold</td>
                                </tr>
                                <tr>
                                    <td>Book Title 4</td>
                                    <td>17</td>
                                    <td>Rented</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
