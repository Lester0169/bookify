<?php
session_start(); // Start the session
include('connect.php'); // Include your database connection

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailAddress = $_POST['emailAddress'];
    $password = $_POST['password'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT u.*, s.sellerID FROM users u LEFT JOIN seller s ON u.userId = s.userID WHERE u.emailAddress = ? AND u.createPassword = ?");
    $stmt->bind_param("ss", $emailAddress, $password);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['userId'] = $user['userId']; // Make sure 'userId' matches your database field
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName'] = $user['lastName'];
        $_SESSION['emailAddress'] = $user['emailAddress'];
        $_SESSION['phoneNumber'] = $user['phoneNumber'];
        $_SESSION['profileImage'] = $user['profileImage'] ? $user['profileImage'] : 'default.png';
        $_SESSION['statusType'] = $user['statusType']; // Store the user's status type

        // If the user is a seller, store the sellerID in the session
        if ($user['statusType'] === 'seller' && isset($user['sellerID'])) {
            $_SESSION['sellerID'] = $user['sellerID'];
        }

        // Redirect based on statusType
        if ($user['statusType'] === 'seller') {
            header("Location: Seller_home.php"); // Redirect to seller's home page
        } else {
            header("Location: home.php"); // Redirect to regular home page
        }
        exit();
    } else {
        // Invalid login
        echo "<script type='text/javascript'>
                alert('Invalid email or password');
                window.location.href = 'index.php'; 
              </script>";
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect for invalid form submission method
    echo "<script type='text/javascript'>
            alert('Form submission method not valid');
            window.location.href = 'index.php';
          </script>";
}

// Close the connection
$conn->close();
?>
