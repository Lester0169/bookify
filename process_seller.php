<?php
session_start(); // Start the session
include('connect.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $sellerId = $_POST['seller_id'];
    $userId = $_POST['user_id'];  // Capture user ID
    $adminNotes = isset($_POST['admin_notes']) ? $_POST['admin_notes'] : '';

    // Determine the status based on the action
    if ($action === 'approve') {
        $status = 'Approved';
    } elseif ($action === 'decline') {
        $status = 'Rejected';
    } else {
        echo 'Invalid action.';
        exit();
    }

    // Prepare and execute the update query for the seller table
    $stmt = $conn->prepare("UPDATE seller SET Status = ?, AdminNotes = ? WHERE SellerId = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssi", $status, $adminNotes, $sellerId);
    if ($stmt->execute() === false) {
        die("Execute failed: " . htmlspecialchars($stmt->error));
    }
    $stmt->close();

    // If approved, update the statusType in the users table and send notification
    if ($status === 'Approved') {
        $statusType = 'seller';  // Set the statusType to seller
    
        // Update the users table to reflect the seller status
        $stmt = $conn->prepare("UPDATE users SET statusType = ? WHERE userId = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
    
        $stmt->bind_param("si", $statusType, $userId);
        if ($stmt->execute() === false) {
            die("Execute failed: " . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    
        // Add a simple notification in the database for tracking purposes
        $notificationMessage = "The application is approved.";
        $stmtNotif = $conn->prepare("INSERT INTO notifications (userId, type, message, isRead, created_at) VALUES (?, 'seller_approval', ?, 0, NOW())");
        if ($stmtNotif === false) {
            die("Notification Prepare failed: " . htmlspecialchars($conn->error));
        }
    
        $stmtNotif->bind_param("is", $userId, $notificationMessage);
        if ($stmtNotif->execute() === false) {
            die("Notification Insert failed: " . htmlspecialchars($stmtNotif->error));
        }
    
        $stmtNotif->close();
    
        // Set SellerID in the session
        $_SESSION['sellerID'] = $sellerId;
    }

    echo "success";
    $conn->close();
}
?>
