<?php
include('admin_connect.php'); // Ensure this points to your correct connection file

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST['emailAddress']; // Matches the form input name
    $password = $_POST['adminPassword']; // Matches the form input name

    // Prepare SQL statement to check credentials
    $stmt = $conn->prepare("SELECT Id, emailAddress, adminPassword FROM admins WHERE emailAddress = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email); // Bind the email parameter

        // Execute statement
        $stmt->execute();

        // Bind result variables
        $stmt->bind_result($id, $emailAddress, $stored_password);

        // Check if a result is returned
        if ($stmt->fetch()) {
            // Verify password (direct comparison since it's stored in plaintext)
            if ($password === $stored_password) {
                // Set session variables
                $_SESSION['admin_id'] = $id;
                $_SESSION['emailAddress'] = $emailAddress;

                // Redirect to admin dashboard
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $message = "Invalid password.";
            }
        } else {
            $message = "No user found with that email.";
        }

        // Close statement
        $stmt->close();
    } else {
        $message = "Error preparing SQL statement: " . $conn->error;
    }

    // Close database connection
    $conn->close();
}

// Output JavaScript alert and redirect if there's an error message
if (!empty($message)) {
    echo "<script type='text/javascript'>
            alert('$message');
            window.location.href = 'index.php';
          </script>";
}
?>
