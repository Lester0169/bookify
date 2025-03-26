<?php
session_start();

// Include your database connection file
include('connect.php');

// Check if the book ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bookID'])) {
    $bookID = intval($_POST['bookID']);

    // First, fetch the book details to get the book picture path
    $sql = "SELECT bookPicture FROM books WHERE bookID = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $bookID);
        $stmt->execute();
        $result = $stmt->get_result();
        $book = $result->fetch_assoc();
        $stmt->close();

        // Now, delete the book record from the database
        $sql = "DELETE FROM books WHERE bookID = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $bookID);

            if ($stmt->execute()) {
                // If the book was deleted, also delete the associated image file
                if (!empty($book['bookPicture']) && file_exists('uploads/' . $book['bookPicture'])) {
                    unlink('uploads/' . $book['bookPicture']);
                }

                $_SESSION['message'] = "Book deleted successfully!";
            } else {
                $_SESSION['message'] = "Error: Could not delete the book.";
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "Error: Could not prepare the delete statement.";
        }
    } else {
        $_SESSION['message'] = "Error: Could not prepare the select statement.";
    }

    $conn->close();

    // Redirect back to the book listing page
    header("Location: Seller_booklist.php");
    exit();
} else {
    $_SESSION['message'] = "Error: Invalid request.";
    header("Location: Seller_booklist.php");
    exit();
}
?>
