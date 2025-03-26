<?php
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Initialize variables from session
$firstName = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : '';
$lastName = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : '';
$emailAddress = isset($_SESSION['emailAddress']) ? $_SESSION['emailAddress'] : '';
$phoneNumber = isset($_SESSION['phoneNumber']) ? $_SESSION['phoneNumber'] : '';
$profileImage = isset($_SESSION['profileImage']) ? $_SESSION['profileImage'] : 'default.png';
$statusType = isset($_SESSION['statusType']) ? $_SESSION['statusType'] : 'NewCustomer';

// Check if the edit button has been clicked
$editMode = isset($_GET['edit']) && $_GET['edit'] === 'true';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon - Profile</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <!-- Header and nav -->
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
                    <li class="list-group-item">Notification 1</li>
                    <li class="list-group-item">Notification 2</li>
                    <li class="list-group-item">Notification 3</li>
                    <li class="list-group-item">Notification 4</li>
                    <li class="list-group-item">Notification 5</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


    <!-- Main content -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center active">
                        <i class="bi bi-person-circle me-2"></i> My Profile
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    
                    <?php if ($statusType === 'seller'): ?>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-book me-2"></i> Book Listing
                        </a>
                    <?php else: ?>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-book me-2"></i> My Rentals
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-heart me-2"></i> Wishlist
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-clock-history me-2"></i> History
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-truck me-2"></i> Shipping
                        </a>
                    <?php endif; ?>
                    
                    <a href="logout.php" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </div>
            </div>
            
            <!-- Profile Card -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">My Profile</h3>
                        <!-- Display message if exists -->
                        <?php if (isset($_SESSION['message'])): ?>
                            <script>
                                alert('<?php echo $_SESSION['message']; ?>');
                            </script>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                        <!-- Profile Information -->
                        <div id="profile-view" style="<?php echo $editMode ? 'display: none;' : ''; ?>">
                            <form>
                                <div class="profile-picture-container mb-3">
                                    <div class="outer-box">
                                        <div class="inner-circle">
                                            <?php if ($profileImage !== 'default.png') : ?>
                                                <img id="current-image" src="uploads/<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture" class="profile-picture">
                                            <?php else : ?>
                                                <i class="bi bi-person-circle fs-1 text-secondary"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName">First Name:</label>
                                        <p><?php echo htmlspecialchars($firstName); ?></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="lastName">Last Name:</label>
                                        <p><?php echo htmlspecialchars($lastName); ?></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="emailAddress">Email Address:</label>
                                        <p><?php echo htmlspecialchars($emailAddress); ?></p>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="phoneNumber">Phone Number:</label>
                                        <p><?php echo htmlspecialchars($phoneNumber); ?></p>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <button type="button" class="btn btn-secondary" id="edit-profile-btn">Edit Profile</button>
                                    <?php if ($statusType !== 'seller'): ?>
                                        <button type="button" class="btn verify-btn" id="verify-renter-btn-profile" data-bs-toggle="modal" data-bs-target="#startRentingModal"><strong>Become a Renter</strong></button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>

                        <!-- Edit Form -->
                        <div id="edit-form" style="<?php echo $editMode ? '' : 'display: none;'; ?>">
                            <form id="edit-profile-form" action="update_profile.php" method="post" enctype="multipart/form-data">
                                <div class="profile-picture-container mb-3">
                                    <div class="outer-box">
                                        <div class="inner-circle">
                                            <img id="preview-image" src="uploads/<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture Preview" class="profile-picture">
                                        </div>
                                    </div>
                                    <input type="file" name="profileImage" class="form-control" onchange="previewImage(event, 'preview-image')">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName">First Name:</label>
                                        <input type="text" id="firstName" name="firstName" class="form-control" value="<?php echo htmlspecialchars($firstName); ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="lastName">Last Name:</label>
                                        <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo htmlspecialchars($lastName); ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="emailAddress">Email Address:</label>
                                        <input type="email" id="emailAddress" name="emailAddress" class="form-control" value="<?php echo htmlspecialchars($emailAddress); ?>" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="phoneNumber">Phone Number:</label>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" 
                                               value="<?php echo htmlspecialchars($phoneNumber); ?>" 
                                               pattern="\d{11}" 
                                               title="Phone number must be exactly 11 digits" 
                                               required>
                                    </div>
                                </div>
                                <div class="button-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <button type="button" class="btn btn-secondary" id="cancel-edit-btn">Cancel</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


   <!-- Verification Modal for Becoming a Renter -->
   <?php include('includes/Renting.php'); ?>

    <!-- Bootstrap JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Function to preview image when selected
    function previewImage(event, previewElementId) {
        var reader = new FileReader(); // FileReader object to read file

        reader.onload = function () {
            var output = document.getElementById(previewElementId);
            output.src = reader.result; // Set image source to read result
        };

        // Make sure to check if files are present before reading
        if (event.target.files.length > 0) {
            reader.readAsDataURL(event.target.files[0]); // Read the file as Data URL
        }
    }

    // Event listener for Edit Profile button
    document.getElementById('edit-profile-btn')?.addEventListener('click', function () {
        document.getElementById('profile-view').style.display = 'none'; // Hide profile view
        document.getElementById('edit-form').style.display = 'block'; // Show edit form
    });

    // Event listener for Cancel button in Edit mode
    document.getElementById('cancel-edit-btn')?.addEventListener('click', function () {
        document.getElementById('profile-view').style.display = 'block'; // Show profile view
        document.getElementById('edit-form').style.display = 'none'; // Hide edit form
    });
    function showAddressFieldsRenter() {
        var country = document.getElementById('renterCountry').value;
        var addressFields = document.getElementById('renterAddressFields');
        var city = document.getElementById('renterCity').value;
        var barangayContainer = document.getElementById('renterBarangayContainer');

        if (country === 'Philippines') {
            addressFields.style.display = 'block';

            if (city === 'Davao City') {
                barangayContainer.style.display = 'block';
            } else {
                barangayContainer.style.display = 'none';
            }
        } else {
            addressFields.style.display = 'none';
            barangayContainer.style.display = 'none';
            document.getElementById('renterCity').value = ''; // Reset city selection
            document.getElementById('renterBarangay').value = ''; // Reset barangay selection
        }
    }

    function handleCityChangeRenter() {
        var city = document.getElementById('renterCity').value;
        var barangayContainer = document.getElementById('renterBarangayContainer');

        if (city === 'Davao City') {
            barangayContainer.style.display = 'block';
        } else {
            barangayContainer.style.display = 'none';
            document.getElementById('renterBarangay').value = ''; // Reset barangay selection
        }
    }

    // Attach event listeners
    document.getElementById('renterCountry').addEventListener('change', showAddressFieldsRenter);
    document.getElementById('renterCity').addEventListener('change', handleCityChangeRenter);
    document.getElementById('booksDropdown').addEventListener('click', function (event) {
    // Check if the dropdown is being clicked or hovered over
    if (window.innerWidth >= 992 && !event.target.closest('.dropdown-menu')) {
        window.location.href = this.getAttribute('href');
    }
});
</script>

</body>
</html>
