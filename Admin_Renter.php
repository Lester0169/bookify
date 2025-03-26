<?php
include('connect.php'); // Include your database connection

// Fetch pending renters from the database
$sql = "SELECT RenterId, UserId, FullName, Country, City, Barangay, StreetAddress, PhoneNumber, EmailAddress, Status, IdType, ValidID, SelfieID, SocialLink FROM renter WHERE Status = 'Pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon Admin Dashboard</title>
    
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
                    <li class="sub-nav-item active">
                        <a href="Admin_Renter.php">Pending Renter</a>
                    </li>
                    <li class="sub-nav-item">
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
            <h2>Manage Pending Renters</h2>
            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="search-input" class="form-control" placeholder="Search by ID, Name, City">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" onclick="searchTable()">Search</button>
                </div>
            </div>
            <!-- Table -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Renter ID</th>
                        <th style="display: none;" class="user-id-column">User ID</th>
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
                <tbody id="renter-table">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr data-renterid='" . $row['RenterId'] . "' data-userid='" . $row['UserId'] . "' data-idtype='" . $row['IdType'] . "' data-validid='" . $row['ValidID'] . "' data-selfieid='" . $row['SelfieID'] . "' data-sociallinks='" . $row['SocialLink'] . "'>";
                            echo "<td>" . $row['RenterId'] . "</td>";
                            echo "<td style='display: none;'>" . $row['UserId'] . "</td>";
                            echo "<td>" . $row['FullName'] . "</td>";
                            echo "<td>" . $row['Country'] . "</td>";
                            echo "<td>" . $row['City'] . "</td>";
                            echo "<td>" . $row['Barangay'] . "</td>";
                            echo "<td>" . $row['StreetAddress'] . "</td>";
                            echo "<td>" . $row['PhoneNumber'] . "</td>";
                            echo "<td>" . $row['EmailAddress'] . "</td>";
                            echo "<td>" . $row['Status'] . "</td>";
                            echo '<td>
                                    <button class="btn btn-success btn-sm" onclick="approveRenter(' . $row['RenterId'] . ', ' . $row['UserId'] . ')">Approve</button>
                                    <button class="btn btn-danger btn-sm" onclick="declineRenter(' . $row['RenterId'] . ', ' . $row['UserId'] . ')">Decline</button>
                                    <button class="btn btn-primary btn-sm" onclick="viewDetails(this)">View</button>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No pending renters found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Verification for Becoming a Renter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>User ID:</strong> <span id="modal-user-id"></span></p>
                    <p><strong>Full Name:</strong> <span id="modal-name"></span></p>
                    <p><strong>Type of ID:</strong> <span id="modal-id-type"></span></p>
                    <p><strong>Uploaded Valid ID:</strong> <span id="modal-valid-id"></span></p>
                    <p><strong>Selfie with Valid ID:</strong> <span id="modal-selfie-id"></span></p>
                    <p><strong>Social Media Links (FB, TWT, ETC) (Optional):</strong> <span id="modal-social-links"></span></p>
                    <p><strong>Country:</strong> <span id="modal-country"></span></p>
                    <p><strong>City or Municipality:</strong> <span id="modal-city"></span></p>
                    <p><strong>Barangay:</strong> <span id="modal-barangay"></span></p>
                    <p><strong>Street Address or Home Address:</strong> <span id="modal-address"></span></p>
                    <p><strong>Contact Number:</strong> <span id="modal-contact"></span></p>
                    <p><strong>Email:</strong> <span id="modal-email"></span></p>

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for Search and View Details Functionality -->
    <script>
    // Function to search through the table
    function searchTable() {
        const input = document.getElementById('search-input').value.toLowerCase();
        const rows = document.querySelectorAll('#renter-table tr');

        rows.forEach(row => {
            const columns = row.querySelectorAll('td');
            let match = false;

            columns.forEach(column => {
                if (column.textContent.toLowerCase().includes(input)) {
                    match = true;
                }
            });

            row.style.display = match ? '' : 'none';
        });
    }

    // Function to view renter details
    function viewDetails(button) {
        const row = button.closest('tr');
        const renterId = row.dataset.renterid;
        document.getElementById('modal-user-id').textContent = renterId;
        document.getElementById('modal-name').textContent = row.cells[2].textContent;
        document.getElementById('modal-id-type').textContent = row.dataset.idtype;
        document.getElementById('modal-valid-id').textContent = row.dataset.validid;
        document.getElementById('modal-selfie-id').textContent = row.dataset.selfieid;
        document.getElementById('modal-social-links').textContent = row.dataset.sociallinks;
        document.getElementById('modal-country').textContent = row.cells[3].textContent;
        document.getElementById('modal-city').textContent = row.cells[4].textContent;
        document.getElementById('modal-barangay').textContent = row.cells[5].textContent;
        document.getElementById('modal-address').textContent = row.cells[6].textContent;
        document.getElementById('modal-contact').textContent = row.cells[7].textContent;
        document.getElementById('modal-email').textContent = row.cells[8].textContent;

        const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
        viewModal.show();
    }

    // Attach event listeners to modal buttons
    document.getElementById('modal-approve-btn').addEventListener('click', function () {
        const renterId = document.getElementById('modal-user-id').textContent;
        const userId = document.querySelector('tr[data-renterid="' + renterId + '"]').dataset.userid;
        if (confirm('Are you sure you want to approve this renter?')) {
            handleAction('approve', renterId, userId);
        }
    });

    document.getElementById('modal-decline-btn').addEventListener('click', function () {
        const renterId = document.getElementById('modal-user-id').textContent;
        const userId = document.querySelector('tr[data-renterid="' + renterId + '"]').dataset.userid;
        if (confirm('Are you sure you want to decline this renter?')) {
            handleAction('decline', renterId, userId);
        }
    });

    // Function to approve a renter from the main table
    function approveRenter(renterId, userId) {
        if (confirm('Are you sure you want to approve this renter?')) {
            handleAction('approve', renterId, userId);
        }
    }

    // Function to decline a renter from the main table
    function declineRenter(renterId, userId) {
        if (confirm('Are you sure you want to decline this renter?')) {
            handleAction('decline', renterId, userId);
        }
    }

    // Function to handle approve/decline actions
    function handleAction(action, renterId, userId) {
        fetch('process_renter.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: action,
                renter_id: renterId,
                user_id: userId,
                admin_notes: document.getElementById('modal-notes').value
            })
        })
        .then(response => response.text())
        .then(result => {
            console.log(result); // This should log 'success' if everything worked
            if (result.trim() === 'success') {
                alert('Renter status updated successfully.');
                location.reload();
            } else {
                alert('Failed to update renter status.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
</body>
</html>
