<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

// Include your database connection file
include('connect.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if sellerID is set for sellers
    $sellerID = isset($_SESSION['sellerID']) ? $_SESSION['sellerID'] : null;

    if ($sellerID === null) {
        $_SESSION['message'] = "Error: Seller ID not found. Please log in again as a seller.";
        header("Location: seller_booklist.php");
        exit();
    }

    // Collect data from the form
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
    $rentalLimit = mysqli_real_escape_string($conn, $_POST['rentalLimit']);
    $rentPrice = floatval($_POST['rentPrice']);
    $uploadedBy = mysqli_real_escape_string($conn, $_POST['uploadedBy']);
    
    // Handle file upload for the book picture
    $bookPicture = $_FILES['bookPicture']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($bookPicture);

    // Check if the file is a valid image type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $valid_extensions = array("jpg", "jpeg", "png");

    if (in_array($imageFileType, $valid_extensions)) {
        if (move_uploaded_file($_FILES['bookPicture']['tmp_name'], $target_file)) {
            // Prepare the SQL query
            $sql = "INSERT INTO books (sellerID, title, author, genre, description, aboutAuthor, isbn, bookcondition, damages, quantity, price, rentalLimit, rentPrice, bookPicture, uploadedBy) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Save only the filename in the database, not the full path
                $stmt->bind_param("issssssssiidsss", $sellerID, $title, $author, $genre, $description, $aboutAuthor, $isbn, $bookcondition, $damages, $quantity, $price, $rentalLimit, $rentPrice, $bookPicture, $uploadedBy);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "You've successfully uploaded the book!";
                } else {
                    $_SESSION['message'] = "Error: Could not execute query: $sql. " . mysqli_error($conn);
                }

                $stmt->close();
            } else {
                $_SESSION['message'] = "Error: Could not prepare query: $sql. " . mysqli_error($conn);
            }
        } else {
            $_SESSION['message'] = "Error: There was an error uploading the file.";
        }
    } else {
        $_SESSION['message'] = "Error: Only JPG, JPEG, and PNG files are allowed.";
    }

    mysqli_close($conn);

    // Redirect to the book listing page to show the message
    header("Location: seller_booklist.php");
    exit();
}
?>
