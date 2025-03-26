<?php
include('connect.php'); // Include your database connection

// Fetch pending sellers from the database
$sql = "SELECT SellerId, UserId, FullName, BusinessName, idType, validID, selfieID, socialLink, Country, City, Barangay, StreetAddress, PhoneNumber, EmailAddress, Status FROM seller WHERE Status = 'Pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon Admin Seller</title>
    
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
                    <li class="sub-nav-item active">
                        <a href="Admin_Seller.php">Pending Seller</a>
                    </li>
                    <li class="sub-nav-item">
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
            <h2>Manage Pending Sellers</h2>
            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="search-input" class="form-control" placeholder="Search by Seller ID, Name, City">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" onclick="searchTable()">Search</button>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Seller ID</th>
                        <th>Full Name</th>
                        <th>Country</th>
                        <th>City/Municipality</th>
                        <th>Barangay</th>
                        <th>Street Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr data-sellerid='" . $row['SellerId'] . "' data-userid='" . $row['UserId'] . "' data-businessname='" . $row['BusinessName'] . "' data-idtype='" . $row['idType'] . "' data-validid='" . $row['validID'] . "' data-selfieid='" . $row['selfieID'] . "' data-sociallinks='" . $row['socialLink'] . "'>";
                            echo "<td>" . $row['SellerId'] . "</td>";
                            echo "<td>" . $row['FullName'] . "</td>";
                            echo "<td>" . $row['Country'] . "</td>";
                            echo "<td>" . $row['City'] . "</td>";
                            echo "<td>" . $row['Barangay'] . "</td>";
                            echo "<td>" . $row['StreetAddress'] . "</td>";
                            echo "<td>" . $row['PhoneNumber'] . "</td>";
                            echo "<td>" . $row['EmailAddress'] . "</td>";
                            echo "<td>" . $row['Status'] . "</td>";
                            echo '<td>
                                    <button class="btn btn-success btn-sm" onclick="approveSeller(' . $row['SellerId'] . ', ' . $row['UserId'] . ')">Approve</button>
                                    <button class="btn btn-danger btn-sm" onclick="declineSeller(' . $row['SellerId'] . ', ' . $row['UserId'] . ')">Decline</button>
                                    <button class="btn btn-primary btn-sm" onclick="viewSellerDetails(this)">View</button>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No pending sellers found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- Modal for Viewing Seller Details -->
<div class="modal fade" id="viewSellerModal" tabindex="-1" aria-labelledby="viewSellerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSellerModalLabel">Verification for Becoming a Seller</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>User ID:</strong> <span id="modal-user-id"></span></p>
                <p><strong>Full Name:</strong> <span id="modal-seller-name"></span></p>
                <p><strong>Business Name (if applicable):</strong> <span id="modal-business-name"></span></p>
                <p><strong>Type of ID:</strong> <span id="modal-seller-id-type"></span></p>

                <p><strong>Uploaded Valid ID:</strong> <button type="button" class="btn btn-link" id="viewValidIDBtn">View</button></p>
                <img id="modal-seller-valid-id" class="img-fluid img-thumbnail" style="display:none; max-width: 200px;">

                <p><strong>Selfie with Valid ID:</strong> <button type="button" class="btn btn-link" id="viewSelfieIDBtn">View</button></p>
                <img id="modal-seller-selfie-id" class="img-fluid img-thumbnail" style="display:none; max-width: 200px;">

                <p><strong>Social Media Links (FB, TWT, ETC) (Optional):</strong> <span id="modal-seller-social-links"></span></p>
                <p><strong>Country:</strong> <span id="modal-seller-country"></span></p>
                <p><strong>City or Municipality:</strong> <span id="modal-seller-city"></span></p>
                <p><strong>Barangay:</strong> <span id="modal-seller-barangay"></span></p>
                <p><strong>Street Address or Home Address:</strong> <span id="modal-seller-address"></span></p>
                <p><strong>Contact Number:</strong> <span id="modal-seller-contact"></span></p>
                <p><strong>Email:</strong> <span id="modal-seller-email"></span></p>

                <!-- Note/Comments Section -->
                <div class="mb-3">
                    <label for="modal-notes" class="form-label">Admin Notes/Comments:</label>
                    <textarea class="form-control" id="modal-notes" rows="3"></textarea>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-start">
                <button id="modal-approve-btn" class="btn btn-success btn-sm">Approve</button>
                <button id="modal-decline-btn" class="btn btn-danger btn-sm">Decline</button>
            </div>
        </div>
    </div>
</div>

 <!-- Image Modal for Enlarged View -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">View Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="enlargedImage" class="img-fluid" style="max-width: 100%; max-height: 80vh;" alt="Enlarged Image">
            </div>
        </div>
    </div>
</div>
     <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for Search and View Details Functionality -->
<script>
// Function to search through the table
function searchTable() {
    const input = document.getElementById('search-input').value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}

// Function to view seller details in the modal
function viewSellerDetails(button) {
    const row = button.closest('tr');
    const sellerId = row.cells[0].textContent;
    const userId = row.dataset.userid;

    const modal = document.getElementById('viewSellerModal');
    modal.dataset.sellerId = sellerId;
    modal.dataset.userId = userId;

    document.getElementById('modal-user-id').textContent = sellerId;
    document.getElementById('modal-seller-name').textContent = row.cells[1].textContent;
    document.getElementById('modal-business-name').textContent = row.dataset.businessname;
    document.getElementById('modal-seller-id-type').textContent = row.dataset.idtype;

    const validIdPath = `uploads/${row.dataset.validid}`;
    const selfieIdPath = `uploads/${row.dataset.selfieid}`;

    document.getElementById('modal-seller-valid-id').src = validIdPath;
    document.getElementById('modal-seller-valid-id').style.display = 'none'; // Hide initially

    document.getElementById('modal-seller-selfie-id').src = selfieIdPath;
    document.getElementById('modal-seller-selfie-id').style.display = 'none'; // Hide initially

    document.getElementById('modal-seller-social-links').textContent = row.dataset.sociallinks;
    document.getElementById('modal-seller-country').textContent = row.cells[2].textContent;
    document.getElementById('modal-seller-city').textContent = row.cells[3].textContent;
    document.getElementById('modal-seller-barangay').textContent = row.cells[4].textContent;
    document.getElementById('modal-seller-address').textContent = row.cells[5].textContent;
    document.getElementById('modal-seller-contact').textContent = row.cells[6].textContent;
    document.getElementById('modal-seller-email').textContent = row.cells[7].textContent;

    const viewModal = new bootstrap.Modal(modal);
    viewModal.show();
}

// Attach event listeners for image enlargement once the DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('viewValidIDBtn').addEventListener('click', function () {
        const imgElement = document.getElementById('modal-seller-valid-id');
        imgElement.style.display = 'block';
        document.getElementById('enlargedImage').src = imgElement.src;
        const viewImageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        viewImageModal.show();
    });

    document.getElementById('viewSelfieIDBtn').addEventListener('click', function () {
        const imgElement = document.getElementById('modal-seller-selfie-id');
        imgElement.style.display = 'block';
        document.getElementById('enlargedImage').src = imgElement.src;
        const viewImageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        viewImageModal.show();
    });
});

// Function to handle approve/decline actions
function handleSellerAction(action, sellerId, userId) {
    const adminNotes = document.getElementById('modal-notes').value;

    fetch('process_seller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: action,
            seller_id: sellerId,
            user_id: userId,
            admin_notes: adminNotes
        })
    })
    .then(response => response.text())
    .then(result => {
        if (result.trim() === 'success') {
            alert('Seller status updated successfully.');
            location.reload();
        } else {
            alert('Failed to update seller status.');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to approve a seller from the main table
function approveSeller(sellerId, userId) {
    if (confirm('Are you sure you want to approve this seller?')) {
        handleSellerAction('approve', sellerId, userId);
    }
}

// Function to decline a seller from the main table
function declineSeller(sellerId, userId) {
    if (confirm('Are you sure you want to decline this seller?')) {
        handleSellerAction('decline', sellerId, userId);
    }
}

// Attach event listeners to modal buttons once the DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('modal-approve-btn').addEventListener('click', function () {
        const modal = document.getElementById('viewSellerModal');
        const sellerId = modal.dataset.sellerId;
        const userId = modal.dataset.userId;
        if (confirm('Are you sure you want to approve this seller?')) {
            handleSellerAction('approve', sellerId, userId);
        }
    });

    document.getElementById('modal-decline-btn').addEventListener('click', function () {
        const modal = document.getElementById('viewSellerModal');
        const sellerId = modal.dataset.sellerId;
        const userId = modal.dataset.userId;
        if (confirm('Are you sure you want to decline this seller?')) {
            handleSellerAction('decline', sellerId, userId);
        }
    });
});
</script>

</body>
</html>