<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon Admin Manage</title>
    
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
            <li class="nav-item ">
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
        <!-- Add your main content here -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
