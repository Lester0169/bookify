<?php
session_start(); // Start the session
include('connect.php'); // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Assuming you store the user ID in the session after login
$userId = $_SESSION['userId'];

// Query to fetch user details including first name, last name, and profileImage
$sql = "SELECT firstName, lastName, profileImage FROM users WHERE userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Set variables
$firstName = $user['firstName'] ?? 'Seller';
$lastName = $user['lastName'] ?? '';
$profileImage = $user['profileImage'] ?? 'default.png';

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon Seller Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Home.css">
    <!-- Font Awesome for custom icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    
<!-- Header Section -->
<header class="header">
    <div class="logo">
        <img src="images/logo.png" alt="BookWagon Logo">
        <h1>
            <span class="book-color">BOOK</span>
            <span class="wagon-color">WAGON</span>
        </h1>
    </div>
    <div class="search-form">
        <form class="position-relative d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn search-btn" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <div class="user-info d-flex align-items-center">
        <!-- Notification Button -->
        <button type="button" class="btn btn-link position-relative me-3" data-bs-toggle="modal" data-bs-target="#notificationModal">
            <i class="bi bi-bell fs-4"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                0
                <span class="visually-hidden">unread notifications</span>
            </span>
        </button>
        <span><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></span>
        <button class="btn btn-link profile-btn" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if ($profileImage !== 'default.png') : ?>
                <img src="uploads/<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Image" class="profile-icon-small">
            <?php else : ?>
                <i class="bi bi-person-circle fs-3 text-primary"></i>
            <?php endif; ?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="seller_profile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
            <li><a class="dropdown-item" href="booklist.php">Book List</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>

<!-- Navbar Section -->
<nav class="navbar navbar-expand-lg" style="background-color: #faf4e7;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Seller_home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Books
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="rent_book.php">Rent Book</a></li>
                        <li><a class="dropdown-item" href="buy_book.php">Buy Book</a></li>
                    </ul>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Explore
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Genre</a></li>
                        <li><a class="dropdown-item" href="#">Recommendations</a></li>
                        <li><a class="dropdown-item" href="#">E-book</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                </li>
            </ul>
        </div>
    </div>  
</nav>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>No new notifications.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Recommendations Section -->
<?php include('includes/recommendations.php'); ?>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
