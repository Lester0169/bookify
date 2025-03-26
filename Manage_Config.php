<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include database configuration
include('config.php');

// Handle approval and disapproval actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    if (isset($_POST['approve'])) {
        $userStatus = 'approved';
        $userType = 'seller';
        $applicationStatus = 'approved';
    } elseif (isset($_POST['disapprove'])) {
        $userStatus = 'disapproved';
        $userType = null; // Keep usertype unchanged on disapproval
        $applicationStatus = 'disapproved';
    }

    if (isset($userStatus) && isset($applicationStatus)) {
        if ($userType) {
            $stmt = $conn->prepare("UPDATE users SET usertype = ? WHERE id = ?");
            $stmt->bind_param("si", $userType, $userId);
            $stmt->execute();
        }

        $stmt = $conn->prepare("UPDATE seller_applications SET status = ? WHERE user_id = ?");
        $stmt->bind_param("si", $applicationStatus, $userId);
        if ($stmt->execute()) {
            $message = "User and application status updated successfully.";
        } else {
            $message = "Error updating application status: " . $stmt->error;
        }
        $stmt->close();
    }
}