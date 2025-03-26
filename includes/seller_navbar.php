<?php
// No need to call session_start() again if it's already started in another script

$firstName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : '';
$lastName = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : '';
$profileImage = isset($_SESSION['profileImage']) ? $_SESSION['profileImage'] : 'default.png';
?>
 <!-- Header and nav -->
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
                <li><a class="dropdown-item" href="seller_profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="seller_dashboard.php">Dashboard</a></li>
                <li><a class="dropdown-item" href="book_list.php">Book List</a></li>
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
                        <a class="nav-link active" aria-current="page" href="seller_home.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Books
                        </a>
                        <ul class="dropdown-menu">
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
                <p>No new notifications.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>