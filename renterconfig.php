<?php
session_start(); // Start the session
include('connect.php'); // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and assign form data to variables
    $fullName = $conn->real_escape_string($_POST['renterFullName']);
    $idType = $conn->real_escape_string($_POST['renterIdType']);
    $validID = $_FILES['renterIdProof']['name'];
    $selfieID = $_FILES['renterSelfieWithId']['name'];
    $socialLink = $conn->real_escape_string($_POST['renterSocialMediaLinks']);
    $country = $conn->real_escape_string($_POST['renterCountry']);
    $city = $conn->real_escape_string($_POST['renterCity']);
    $barangay = $conn->real_escape_string($_POST['renterBarangay']);
    $streetAddress = $conn->real_escape_string($_POST['renterStreetAddress']);
    $phoneNumber = $conn->real_escape_string($_POST['renterContactNumber']);
    $emailAddress = $conn->real_escape_string($_POST['renterEmail']);
    $adminNotes = $conn->real_escape_string($_POST['adminNotes']); // Add Admin Notes

    // Handle file uploads
    $validIDTarget = "uploads/" . basename($validID);
    $selfieIDTarget = "uploads/" . basename($selfieID);

    if (!move_uploaded_file($_FILES['renterIdProof']['tmp_name'], $validIDTarget)) {
        die('Error moving ID proof file.');
    }

    if (!move_uploaded_file($_FILES['renterSelfieWithId']['tmp_name'], $selfieIDTarget)) {
        die('Error moving selfie with ID file.');
    }

    // Get the userId from the session
    if (!isset($_SESSION['userId'])) {
        die('User ID not found in session.');
    }
    $userId = $_SESSION['userId'];

    // Insert data into the renter table using prepared statements
    $stmt = $conn->prepare("INSERT INTO renter (UserId, FullName, IdType, ValidID, SelfieID, SocialLink, Country, City, Barangay, StreetAddress, PhoneNumber, EmailAddress, AdminNotes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssssss", $userId, $fullName, $idType, $validID, $selfieID, $socialLink, $country, $city, $barangay, $streetAddress, $phoneNumber, $emailAddress, $adminNotes);
    
    if ($stmt->execute()) {
        echo "<script>alert('Renter verification application submitted successfully.'); window.location.href='profile.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
