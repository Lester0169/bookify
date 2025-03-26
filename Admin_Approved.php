<?php
include('connect.php'); // Include your database connection

// Fetch approved users from the database
$sql = "SELECT userId, CONCAT(firstName, ' ', lastName) AS FullName, phoneNumber, emailAddress, statusType FROM users WHERE statusType IN ('Renter', 'Seller')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon Admin Approved</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Admin_Manage.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <a href="Admin_Dashboard.php">
                <img src="images/logo.png" alt="BookWagon Logo">
                <h1>
                    <span class="book-color">BOOK</span>
                    <span class="wagon-color">WAGON</span>
                </h1>
            </a>
        </div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="Admin_Dashboard.php">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="#manageUserSubmenu" data-bs-toggle="collapse">
                    <i class="bi bi-person-lines-fill"></i> Manage User <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="manageUserSubmenu" class="collapse show sub-nav-list">
                    <li class="sub-nav-item">
                        <a href="Admin_Renter.php">Pending Renter</a>
                    </li>
                    <li class="sub-nav-item">
                        <a href="Admin_Seller.php">Pending Seller</a>
                    </li>
                    <li class="sub-nav-item active">
                        <a href="Admin_Approved.php">Approved User</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="logout.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <h2>Approved Users</h2>
            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="search-input" class="form-control" placeholder="Search by ID, Name, Phone, Email">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" onclick="searchTable()">Search</button>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Full Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Status Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['userId'] . "</td>";
                            echo "<td>" . $row['FullName'] . "</td>";
                            echo "<td>" . $row['phoneNumber'] . "</td>";
                            echo "<td>" . $row['emailAddress'] . "</td>";
                            echo "<td>" . $row['statusType'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No approved users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Search Functionality -->
    <script>
        function searchTable() {
            const input = document.getElementById('search-input').value.toLowerCase();
            const table = document.querySelector('tbody');
            const rows = table.querySelectorAll('tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? '' : 'none';
            });
        }
    </script>
</body>
</html>
