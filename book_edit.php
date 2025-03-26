<?php
session_start(); // Start the session

// Include your database connection file
include('connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $bookID = intval($_POST['bookID']);
    $title = mysqli_real_escape_string($conn, $_POST['bookTitle']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $aboutAuthor = mysqli_real_escape_string($conn, $_POST['aboutAuthor']);
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
    $bookcondition = mysqli_real_escape_string($conn, $_POST['condition']);
    $damages = mysqli_real_escape_string($conn, $_POST['damages']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $rentalLimit = !empty($_POST['rentalLimit']) ? mysqli_real_escape_string($conn, $_POST['rentalLimit']) : null;
    $rentPrice = !empty($_POST['rentPrice']) ? floatval($_POST['rentPrice']) : null;

    // Update book in the database without handling book picture
    $sql = "UPDATE books SET title=?, author=?, genre=?, description=?, aboutAuthor=?, isbn=?, bookcondition=?, damages=?, quantity=?, price=?, rentalLimit=?, rentPrice=? WHERE bookID=?";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param(
        "ssssssssiidsi", 
        $title, $author, $genre, $description, 
        $aboutAuthor, $isbn, $bookcondition, $damages, 
        $quantity, $price, $rentalLimit, 
        $rentPrice, $bookID
    );

    // Execute the statement and handle errors
    if ($stmt->execute()) {
        $_SESSION['message'] = "Book details updated successfully!";
    } else {
        $_SESSION['message'] = "Error: Could not update book details.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    header("Location: seller_booklist.php");
    exit();
}
?>
