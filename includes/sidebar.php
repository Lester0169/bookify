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
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-book me-2"></i> My Rental
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
                    <a href="logout.php" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </div>
            </div>
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
                            <div class="profile-picture-container">
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
                            <p><strong>First Name:</strong> <?php echo htmlspecialchars($firstName); ?></p>
                            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($lastName); ?></p>
                            <p><strong>Email Address:</strong> <?php echo htmlspecialchars($emailAddress); ?></p>
                            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($phoneNumber); ?></p>
                            <div class="button-group">
                                <button class="btn btn-secondary mt-3 me-2 edit-btn" id="edit-profile-btn">Edit Profile</button>
                                <button class="btn btn-primary mt-3 verify-btn" id="verify-renter-btn" data-bs-toggle="modal" data-bs-target="#verifyModal">Verify Status</button>
                            </div>
                        </div>

                        <!-- Edit Form -->
                        <div id="edit-form" style="<?php echo $editMode ? '' : 'display: none;'; ?>">
                            <form action="update_profile.php" method="post" enctype="multipart/form-data">
                                <div class="profile-picture-container mb-3">
                                    <div class="outer-box">
                                        <div class="inner-circle">
                                            <?php if ($profileImage !== 'default.png') : ?>
                                                <img id="preview-image" src="uploads/<?php echo htmlspecialchars($profileImage); ?>" alt="Profile Picture Preview" class="profile-picture">
                                            <?php else : ?>
                                                <i class="bi bi-person-circle fs-1 text-secondary"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <input type="file" name="profileImage" class="form-control" onchange="previewImage(event)">
                                </div>
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" name="firstName" class="form-control" value="<?php echo htmlspecialchars($firstName); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" name="lastName" class="form-control" value="<?php echo htmlspecialchars($lastName); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                    <input type="email" name="emailAddress" class="form-control" value="<?php echo htmlspecialchars($emailAddress); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="text" name="phoneNumber" class="form-control" value="<?php echo htmlspecialchars($phoneNumber); ?>" required>
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

    <!-- Verification Modal -->
    <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifyModalLabel">Verification for Becoming a Renter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="verify_renter.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" name="fullName" class="form-control" value="<?php echo htmlspecialchars($firstName . ' ' . $lastName); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="idType" class="form-label">Type of ID</label>
                            <input type="text" name="idType" class="form-control" placeholder="Enter the type of your ID" required>
                        </div>
                        <div class="mb-3">
                            <label for="idProof" class="form-label">Upload Valid ID</label>
                            <input type="file" name="idProof" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="selfieWithId" class="form-label">Selfie with Valid ID</label>
                            <input type="file" name="selfieWithId" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="socialMediaLinks" class="form-label">Social Media Links (FB, TWT, ETC)(Optional)</label>
                            <input type="text" name="socialMediaLinks" class="form-control" placeholder="Enter your social media links">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address (City, Street Number, Street Name)</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="text" name="contactNumber" class="form-control" value="<?php echo htmlspecialchars($phoneNumber); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($emailAddress); ?>" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="termsCheck" required>
                            <label class="form-check-label" for="termsCheck">By proceeding, you acknowledge that you agree to our Terms and Conditions.</label>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (including Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>