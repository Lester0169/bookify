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

// Check if the edit button has been clicked
$editMode = isset($_GET['edit']) && $_GET['edit'] === 'true';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon - Seller Profile</title>

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
                    <a href="seller_profile.php" class="list-group-item list-group-item-action d-flex align-items-center active">
                        <i class="bi bi-person-circle me-2"></i> My Profile
                    </a>
                    <a href="seller_dashboard.php" class="list-group-item list-group-item-action d-flex align-items-center">
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
                                </div>
                            </form>
                        </div>

                        <!-- Edit Form -->
                        <div id="edit-form" style="<?php echo $editMode ? '' : 'display: none;'; ?>">
                            <form id="edit-profile-form" action="update_sellerprofile.php" method="post" enctype="multipart/form-data">
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
    </script>

</body>
</html>
