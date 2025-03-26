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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon - Books</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/books.css">
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

<!-- Books Section -->
<section class="books">
    <div class="container mt-5">
        <h2 class="section-title">Books</h2>
        <div class="row">
            <?php
            // Fetch books from the database with uploader's information
            $sql = "SELECT books.bookID, books.title, books.author, books.genre, books.bookPicture, users.firstName AS uploaderFirstName, users.lastName AS uploaderLastName 
                    FROM books 
                    INNER JOIN users ON books.sellerID = users.userId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-3">';
                    echo '    <a href="view_book.php?bookId=' . $row['bookID'] . '" class="text-decoration-none">';
                    echo '        <div class="book-card">';
                    echo '            <img src="uploads/' . htmlspecialchars($row['bookPicture']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '            <div class="card-body">';
                    echo '                <h5 class="book-card-title">' . htmlspecialchars($row['title']) . '</h5>';
                    echo '                <p class="book-card-author">' . htmlspecialchars($row['author']) . '</p>';
                    echo '                <p class="book-card-genre">' . htmlspecialchars($row['genre']) . '</p>';
                    echo '                <div class="rating">';
                    echo '                    <i class="fas fa-star"></i>';
                    echo '                    <i class="fas fa-star"></i>';
                    echo '                    <i class="fas fa-star"></i>';
                    echo '                    <i class="fas fa-star"></i>';
                    echo '                    <i class="fas fa-star-half-alt"></i>';
                    echo '                </div>';
                    echo '            </div>';
                    echo '            <div class="card-footer">';
                    echo '                <small class="text-muted">Uploaded by: ' . htmlspecialchars($row['uploaderFirstName']) . ' ' . htmlspecialchars($row['uploaderLastName']) . '</small>';
                    echo '            </div>';
                    echo '        </div>';
                    echo '    </a>';
                    echo '</div>';
                }
            } else {
                echo '<p>No books available.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>
</section>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
