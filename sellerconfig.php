<?php
session_start();
include('connect.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['userId']; // Ensure user ID is captured from session

    // Handle file uploads
    $targetDir = "uploads/";
    $validIDTargetFile = $targetDir . basename($_FILES["idProof"]["name"]);
    $selfieIDTargetFile = $targetDir . basename($_FILES["selfieWithId"]["name"]);

    // Move uploaded files to the target directory
    if (move_uploaded_file($_FILES["idProof"]["tmp_name"], $validIDTargetFile) && 
        move_uploaded_file($_FILES["selfieWithId"]["tmp_name"], $selfieIDTargetFile)) {
        // File upload was successful, now insert the data into the database
        // Store only the file names in the database
        $validID = basename($_FILES["idProof"]["name"]);
        $selfieID = basename($_FILES["selfieWithId"]["name"]);
    } else {
        die("Error uploading files.");
    }

    // Capture form inputs
    $fullName = $_POST['fullName'];
    $businessName = $_POST['businessName'];
    $idType = $_POST['sellerIdType'];
    $socialLinks = $_POST['socialMediaLinks'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $streetAddress = $_POST['streetAddress'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO seller (UserId, FullName, BusinessName, idType, validID, selfieID, socialLink, Country, City, Barangay, StreetAddress, PhoneNumber, EmailAddress, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    // Bind parameters to the query
    $stmt->bind_param("issssssssssss", $userId, $fullName, $businessName, $idType, $validID, $selfieID, $socialLinks, $country, $city, $barangay, $streetAddress, $contactNumber, $email);

    // Execute the query and check for success
    if ($stmt->execute() === false) {
        die("Execute failed: " . htmlspecialchars($stmt->error));
    } else {
        echo "Seller application submitted successfully!";
    }

    $stmt->close();
    $conn->close();
    header('Location: Home.php'); // Redirect back to home page
    exit();
} else {
    echo "Invalid request method.";
}
?>
