<?php
include('connect.php');

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set parameters from POST data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAddress = $_POST['emailAddress'];
    $phoneNumber = $_POST['phoneNumber'];
    $createPassword = $_POST['createPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Set the default status to 'NewCustomer'
    $statusType = 'NewCustomer';

    // Validate if passwords match
    if ($createPassword !== $confirmPassword) {
        $message = "Passwords do not match.";
    } elseif (!preg_match('/^[0-9]{11}$/', $phoneNumber)) {
        // Validate phone number (must be exactly 11 digits)
        $message = "Phone number must be exactly 11 digits.";
    } else {
        // Set profile image to NULL since no file is uploaded during registration
        $profileImage = NULL;

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (lastName, firstName, emailAddress, phoneNumber, createPassword, confirmPassword, statusType, profileImage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $lastName, $firstName, $emailAddress, $phoneNumber, $createPassword, $confirmPassword, $statusType, $profileImage);

        // Execute the statement
        if ($stmt->execute()) {
            $message = "Registered Successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
} else {
    $message = "Form submission method not valid.";
}

// Close connection
$conn->close();

// Output JavaScript for alert and redirection
echo "<script type='text/javascript'>
        alert('$message');
        window.location.href = 'index.php';
      </script>";
?>
