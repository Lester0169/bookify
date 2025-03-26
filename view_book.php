<?php
session_start();
include('connect.php');

// Assuming you store the user ID in the session after login
$userId = $_SESSION['userId'] ?? null;

// Initialize variables
$firstName = 'Guest';
$lastName = '';
$profileImage = 'default.png';
$unreadCount = 0;

if ($userId) {
    // Fetch user details
    $sql = "SELECT firstName, lastName, profileImage FROM users WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $firstName = $user['firstName'] ?? 'Guest';
    $lastName = $user['lastName'] ?? '';
    $profileImage = $user['profileImage'] ?? 'default.png';

    $stmt->close();

    // Fetch unread notifications count
    $stmt = $conn->prepare("SELECT COUNT(*) AS unreadCount FROM notifications WHERE userId = ? AND isRead = 0");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($unreadCount);
    $stmt->fetch();
    $stmt->close();
}

// Get the book ID from the query string
$bookId = $_GET['bookId'] ?? 0;

// Fetch the book details based on the bookId
$sql = "SELECT title, author, price, bookPicture FROM books WHERE bookId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookId);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> - Book Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/view_book.css">
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
        <a href="#" class="btn start-selling-btn" data-bs-toggle="modal" data-bs-target="#startSellingModal">Start Selling</a>
        <!-- Notification Button -->
        <button type="button" class="btn btn-link position-relative me-3" data-bs-toggle="modal" data-bs-target="#notificationModal">
            <i class="bi bi-bell fs-4"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo $unreadCount; ?>
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
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="#">Dashboard</a></li>
            <li><a class="dropdown-item" href="#">My Rental</a></li>
            <li><a class="dropdown-item" href="#">Wishlist</a></li>
            <li><a class="dropdown-item" href="#">History</a></li>
            <li><a class="dropdown-item" href="#">Shipping</a></li>
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
                    <a class="nav-link" href="Home.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="book.php" id="booksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Books
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="booksDropdown">
                        <li><a class="dropdown-item" href="rent_book.php">Rent Book</a></li>
                        <li><a class="dropdown-item" href="buy_book.php">Buy Book</a></li>
                    </ul>
                </li>
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
            </ul>
        </div>
    </div>
</nav>

<!-- Book Details Section -->
<div class="container mt-5">
    <div class="row">
        <!-- Book Image -->
        <div class="col-md-4">
            <img src="uploads/<?php echo htmlspecialchars($book['bookPicture']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" class="img-fluid">
        </div>

        <!-- Book Information -->
        <div class="col-md-8">
            <h2><?php echo htmlspecialchars($book['title']); ?></h2>
            <p class="text-muted">by <?php echo htmlspecialchars($book['author']); ?></p>
            <div class="rating mb-2">
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star text-warning"></i>
                <i class="fas fa-star-half-alt text-warning"></i>
                <span>5.0 (1)</span>
            </div>
            <h4 class="mt-4">Price: $<?php echo number_format($book['price'], 2); ?></h4>
            <div class="mt-4">
                <button class="btn btn-primary">Add to Cart</button>
                <button class="btn btn-outline-secondary">Instant Purchase</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
