
<?php
session_start();
include('connect.php');

// Assuming you store the user ID in the session after login
$userId = $_SESSION['userId'];

// Query to fetch user details including first name, last name, statusType, and profileImage
$sql = "SELECT firstName, lastName, statusType, profileImage FROM users WHERE userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$firstName = $user['firstName'] ?? 'Guest';
$lastName = $user['lastName'] ?? '';
$profileImage = $user['profileImage'] ?? 'default.png';
$statusType = $user['statusType'];

// Fetch unread notifications count
$stmt = $conn->prepare("SELECT COUNT(*) AS unreadCount FROM notifications WHERE userId = ? AND isRead = 0");
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($unreadCount);
$stmt->fetch();
$stmt->close();

// Fetch unread notifications
$stmt = $conn->prepare("SELECT message, created_at FROM notifications WHERE userId = ? AND isRead = 0 ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$notifications = $stmt->get_result();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Home.css">
    <!-- Font Awesome for custom icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    
<!-- Nav Bar Section -->

<!-- Header -->
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
    <nav class="navbar navbar-expand-lg" style="background-color: #faf4e7;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="book.php" id="booksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <?php while ($row = $notifications->fetch_assoc()): ?>
                        <li class="list-group-item">
                            <?php echo htmlspecialchars($row['message']); ?>
                            <br><small><?php echo $row['created_at']; ?></small>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <!-- Special Message for Approved Sellers -->
                <?php if ($statusType === 'seller'): ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Your application has been approved! Please log in again to ensure a smooth experience.
                        <form action="index.php" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-primary mt-2">Okay</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



    <!-- Start Selling Modal -->
    <?php include('includes/Selling.php'); ?>
    
    <!-- Recommendations Section -->
    <?php include('includes/recommendations.php'); ?>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    
    function showAddressFields() {
        var country = document.getElementById('country').value;
        var addressFields = document.getElementById('addressFields');
        var city = document.getElementById('city').value;
        var barangayContainer = document.getElementById('barangayContainer');

        if (country === 'Philippines') {
            addressFields.style.display = 'block';

            // Handle city change within the country
            if (city === 'Davao City') {
                barangayContainer.style.display = 'block';
            } else {
                barangayContainer.style.display = 'none';
            }
        } else {
            addressFields.style.display = 'none';
            barangayContainer.style.display = 'none';
            document.getElementById('city').value = ''; // Reset city selection
            document.getElementById('barangay').value = ''; // Reset barangay selection
        }
    }

    function handleCityChange() {
        var city = document.getElementById('city').value;
        var barangayContainer = document.getElementById('barangayContainer');

        if (city === 'Davao City') {
            barangayContainer.style.display = 'block';
        } else {
            barangayContainer.style.display = 'none';
            document.getElementById('barangay').value = ''; // Reset barangay selection
        }
    }

    // Attach event listeners
    document.getElementById('country').addEventListener('change', showAddressFields);
    document.getElementById('city').addEventListener('change', handleCityChange);
    
    document.getElementById('booksDropdown').addEventListener('click', function (event) {
    // Check if the dropdown is being clicked or hovered over
    if (window.innerWidth >= 992 && !event.target.closest('.dropdown-menu')) {
        window.location.href = this.getAttribute('href');
    }
});

</script>
</body>
</html>
