<?php
session_start(); // Start session
include('connect.php'); // Include your database connection script

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars(trim($_POST['firstName']));
    $lastName = htmlspecialchars(trim($_POST['lastName']));
    $emailAddress = htmlspecialchars(trim($_POST['emailAddress']));
    $phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));
    $userId = $_SESSION['userId']; // Assuming userId is stored in session

    // Validate phone number (must be exactly 11 digits)
    if (!preg_match('/^\d{11}$/', $phoneNumber)) {
        $_SESSION['message'] = "Phone number must be exactly 11 digits.";
        header("Location: profile.php");
        exit();
    }

    // Handle profile picture upload
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profileImage']['tmp_name'];
        $fileName = $_FILES['profileImage']['name'];
        $fileSize = $_FILES['profileImage']['size'];
        $fileType = $_FILES['profileImage']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'uploads/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update profile image in database
                $stmt = $conn->prepare("UPDATE users SET profileImage=? WHERE userId=?");
                $stmt->bind_param("si", $fileName, $userId);

                if ($stmt->execute()) {
                    $_SESSION['profileImage'] = $fileName;
                    $_SESSION['message'] = "Profile updated successfully!";
                } else {
                    $_SESSION['message'] = "Error updating profile picture: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['message'] = "There was an error moving the uploaded file.";
            }
        } else {
            $_SESSION['message'] = "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
        }
    }

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE users SET firstName=?, lastName=?, emailAddress=?, phoneNumber=? WHERE userId=?");
    $stmt->bind_param("ssssi", $firstName, $lastName, $emailAddress, $phoneNumber, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        // Update session variables
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['emailAddress'] = $emailAddress;
        $_SESSION['phoneNumber'] = $phoneNumber;

        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to profile page
    header("Location: profile.php");
    exit();
} else {
    // Display invalid form submission method message and redirect to profile page
    $_SESSION['message'] = "Invalid form submission method.";
    header("Location: profile.php");
    exit();
}
?>
