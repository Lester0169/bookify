<?php
include('connect.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $renterId = $_POST['renter_id'];
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

    // Prepare and execute the update query for renter table
    $stmt = $conn->prepare("UPDATE renter SET Status = ?, AdminNotes = ? WHERE RenterId = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssi", $status, $adminNotes, $renterId);
    if ($stmt->execute() === false) {
        die("Execute failed: " . htmlspecialchars($stmt->error));
    }
    $stmt->close();

    // If approved, update the statusType in the users table
    if ($action === 'approve') {
        $statusType = 'renter';  // Set the statusType to renter

        $stmt = $conn->prepare("UPDATE users SET statusType = ? WHERE userId = ?");
        if ($stmt === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("si", $statusType, $userId);
        if ($stmt->execute() === false) {
            die("Execute failed: " . htmlspecialchars($stmt->error));
        }
        $stmt->close();
    }

    echo "success";
    $conn->close();
}
?>
