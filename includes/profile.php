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
                                    <button type="button" class="btn verify-btn" id="verify-renter-btn-profile" data-bs-toggle="modal" data-bs-target="#verifyModal"><strong>Become a Renter</strong></button>
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
                                    <input type="file" name="profileImage" class="form-control" onchange="previewImage(event)">
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
                                        <input type="email" id="emailAddress" name="emailAddress" class="form-control" value="<?php echo htmlspecialchars($emailAddress); ?>" required >
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