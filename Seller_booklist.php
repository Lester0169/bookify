<?php
session_start(); // Start the session

// Check if SellerID is set
if (!isset($_SESSION['sellerID']) || empty($_SESSION['sellerID'])) {
    // If SellerID is not set in session, redirect to login or show an error
    header("Location: login.php?error=Please log in as a seller");
    exit();
}

// Include your database connection file
include('connect.php');

// Check if there's a session message and display it
$session_message = '';
if (isset($_SESSION['message'])) {
    $session_message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Initialize $books as an empty array
$books = [];

// Fetch books uploaded by the current seller
$sellerID = $_SESSION['sellerID'];

$sql = "SELECT * FROM books WHERE sellerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sellerID);
$stmt->execute();
$result = $stmt->get_result();

// Fetch all books into $books array if there are any results
if ($result->num_rows > 0) {
    $books = $result->fetch_all(MYSQLI_ASSOC);
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon - Book Listing</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/seller_profile.css">
</head>

<body>
    <!-- Include your navigation bar -->
    <?php include('includes/seller_navbar.php'); ?>
    
    <div class="container mt-3">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>



    <!-- Main content -->
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="seller_profile.php" class="list-group-item list-group-item-action d-flex align-items-center ">
                        <i class="bi bi-person-circle me-2"></i> My Profile
                    </a>
                    <a href="seller_dashboard.php" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="" class="list-group-item list-group-item-action d-flex align-items-center active">
                        <i class="bi bi-book me-2"></i> Book Listing
                    </a>
                    <a href="logout.php" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Book Listing</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadBookModal">Upload Book</button>
                    </div>
                </div>

                <div class="row">
                    <?php if (count($books) > 0): ?>
                        <?php foreach ($books as $book): ?>
                            <div class="col-md-4">
    <div class="card mb-4 h-100">
        <img src="<?php echo (!empty($book['bookPicture']) && file_exists('uploads/' . $book['bookPicture'])) ? 'uploads/' . htmlspecialchars($book['bookPicture']) : 'path/to/placeholder.jpg'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
            <p class="card-text">₱<?php echo number_format($book['price'], 2); ?></p>
            <p class="card-text">Quantity: <?php echo $book['quantity']; ?></p>
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewBookModal<?php echo $book['bookID']; ?>">View</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editBookModal<?php echo $book['bookID']; ?>">Edit</button>
        </div>
    </div>
</div>

                            <!-- View Book Modal -->
<div class="modal fade" id="viewBookModal<?php echo $book['bookID']; ?>" tabindex="-1" aria-labelledby="viewBookModalLabel<?php echo $book['bookID']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBookModalLabel<?php echo $book['bookID']; ?>"><?php echo htmlspecialchars($book['title']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo (!empty($book['bookPicture']) && file_exists('uploads/' . $book['bookPicture'])) ? 'uploads/' . htmlspecialchars($book['bookPicture']) : 'path/to/placeholder.jpg'; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">
                    </div>
                    <div class="col-md-8">
                        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                        <p><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
                        <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
                        <p><strong>About the Author:</strong> <?php echo htmlspecialchars($book['aboutAuthor']); ?></p>
                        <p><strong>ISBN:</strong> <?php echo htmlspecialchars($book['isbn']); ?></p>
                        <p><strong>Condition:</strong> <?php echo htmlspecialchars($book['bookcondition']); ?></p>
                        <p><strong>Damages:</strong> <?php echo htmlspecialchars($book['damages']); ?></p>
                        <p><strong>Quantity:</strong> <?php echo htmlspecialchars($book['quantity']); ?></p>
                        <p><strong>Price:</strong> ₱<?php echo htmlspecialchars($book['price']); ?></p>
                        <?php if (!empty($book['rentalLimit'])): ?>
                            <p><strong>Rental Limit:</strong> <?php echo htmlspecialchars($book['rentalLimit'] . ' days'); ?></p>
                            <p><strong>Rent Price:</strong> ₱<?php echo htmlspecialchars($book['rentPrice']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Delete Button -->
                <form action="delete_book.php" method="post" onsubmit="return confirm('Are you sure you want to delete this book?');">
                    <input type="hidden" name="bookID" value="<?php echo $book['bookID']; ?>">
                    <button type="submit" class="btn btn-danger">Delete This Book</button>
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal<?php echo $book['bookID']; ?>" tabindex="-1" aria-labelledby="editBookModalLabel<?php echo $book['bookID']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Book: <?php echo htmlspecialchars($book['title']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="book_edit.php" method="post">
                    <input type="hidden" name="bookID" value="<?php echo $book['bookID']; ?>"> 
                    <div class="mb-3">
                        <label for="editBookTitle<?php echo $book['bookID']; ?>" class="form-label">Book Title:</label>
                        <input type="text" class="form-control" id="editBookTitle<?php echo $book['bookID']; ?>" name="bookTitle" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAuthor<?php echo $book['bookID']; ?>" class="form-label">Author(s):</label>
                        <input type="text" class="form-control" id="editAuthor<?php echo $book['bookID']; ?>" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editGenre<?php echo $book['bookID']; ?>" class="form-label">Genre:</label>
                        <select class="form-select" id="editGenre<?php echo $book['bookID']; ?>" name="genre" required>
                            <option value="Fiction" <?php echo $book['genre'] == 'Fiction' ? 'selected' : ''; ?>>Fiction</option>
                            <option value="Romance" <?php echo $book['genre'] == 'Romance' ? 'selected' : ''; ?>>Romance</option>
                            <option value="Science Fiction (Sci-Fi)" <?php echo $book['genre'] == 'Science Fiction (Sci-Fi)' ? 'selected' : ''; ?>>Science Fiction (Sci-Fi)</option>
                            <option value="Fantasy" <?php echo $book['genre'] == 'Fantasy' ? 'selected' : ''; ?>>Fantasy</option>
                            <option value="Mystery" <?php echo $book['genre'] == 'Mystery' ? 'selected' : ''; ?>>Mystery</option>
                            <option value="Thriller" <?php echo $book['genre'] == 'Thriller' ? 'selected' : ''; ?>>Thriller</option>
                            <option value="Horror" <?php echo $book['genre'] == 'Horror' ? 'selected' : ''; ?>>Horror</option>
                            <option value="Historical Fiction" <?php echo $book['genre'] == 'Historical Fiction' ? 'selected' : ''; ?>>Historical Fiction</option>
                            <option value="Literary Fiction" <?php echo $book['genre'] == 'Literary Fiction' ? 'selected' : ''; ?>>Literary Fiction</option>
                            <option value="Action/Adventure" <?php echo $book['genre'] == 'Action/Adventure' ? 'selected' : ''; ?>>Action/Adventure</option>
                            <option value="Young Adult (YA)" <?php echo $book['genre'] == 'Young Adult (YA)' ? 'selected' : ''; ?>>Young Adult (YA)</option>
                            <option value="Non-Fiction" <?php echo $book['genre'] == 'Non-Fiction' ? 'selected' : ''; ?>>Non-Fiction</option>
                            <option value="Biography" <?php echo $book['genre'] == 'Biography' ? 'selected' : ''; ?>>Biography</option>
                            <option value="Memoir" <?php echo $book['genre'] == 'Memoir' ? 'selected' : ''; ?>>Memoir</option>
                            <option value="Autobiography" <?php echo $book['genre'] == 'Autobiography' ? 'selected' : ''; ?>>Autobiography</option>
                            <option value="Essay" <?php echo $book['genre'] == 'Essay' ? 'selected' : ''; ?>>Essay</option>
                            <option value="Self-Help" <?php echo $book['genre'] == 'Self-Help' ? 'selected' : ''; ?>>Self-Help</option>
                            <option value="History" <?php echo $book['genre'] == 'History' ? 'selected' : ''; ?>>History</option>
                            <option value="Travel" <?php echo $book['genre'] == 'Travel' ? 'selected' : ''; ?>>Travel</option>
                            <option value="Food and Drink" <?php echo $book['genre'] == 'Food and Drink' ? 'selected' : ''; ?>>Food and Drink</option>
                            <option value="Science" <?php echo $book['genre'] == 'Science' ? 'selected' : ''; ?>>Science</option>
                            <option value="True Crime" <?php echo $book['genre'] == 'True Crime' ? 'selected' : ''; ?>>True Crime</option>
                            <option value="Graphic Novel" <?php echo $book['genre'] == 'Graphic Novel' ? 'selected' : ''; ?>>Graphic Novel</option>
                            <option value="Poetry" <?php echo $book['genre'] == 'Poetry' ? 'selected' : ''; ?>>Poetry</option>
                            <option value="Drama" <?php echo $book['genre'] == 'Drama' ? 'selected' : ''; ?>>Drama</option>
                            <option value="Short Story" <?php echo $book['genre'] == 'Short Story' ? 'selected' : ''; ?>>Short Story</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription<?php echo $book['bookID']; ?>" class="form-label">Description:</label>
                        <textarea class="form-control" id="editDescription<?php echo $book['bookID']; ?>" name="description" rows="3" required><?php echo htmlspecialchars($book['description']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editAboutAuthor<?php echo $book['bookID']; ?>" class="form-label">About the Author:</label>
                        <textarea class="form-control" id="editAboutAuthor<?php echo $book['bookID']; ?>" name="aboutAuthor" rows="2" required><?php echo htmlspecialchars($book['aboutAuthor']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editIsbn<?php echo $book['bookID']; ?>" class="form-label">ISBN:</label>
                        <input type="text" class="form-control" id="editIsbn<?php echo $book['bookID']; ?>" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCondition<?php echo $book['bookID']; ?>" class="form-label">Condition:</label>
                        <select class="form-select" id="editCondition<?php echo $book['bookID']; ?>" name="condition" required>
                            <option value="Brand New" <?php echo $book['bookcondition'] == 'Brand New' ? 'selected' : ''; ?>>Brand New</option>
                            <option value="Used" <?php echo $book['bookcondition'] == 'Used' ? 'selected' : ''; ?>>Used</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDamages<?php echo $book['bookID']; ?>" class="form-label">Damages:</label>
                        <textarea class="form-control" id="editDamages<?php echo $book['bookID']; ?>" name="damages" rows="2"><?php echo htmlspecialchars($book['damages']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editQuantity<?php echo $book['bookID']; ?>" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="editQuantity<?php echo $book['bookID']; ?>" name="quantity" value="<?php echo htmlspecialchars($book['quantity']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPrice<?php echo $book['bookID']; ?>" class="form-label">Price (₱):</label>
                        <input type="number" class="form-control" id="editPrice<?php echo $book['bookID']; ?>" name="price" value="<?php echo htmlspecialchars($book['price']); ?>" required min="0" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="editRentalLimit<?php echo $book['bookID']; ?>" class="form-label">Rental Limit (if rent):</label>
                        <select class="form-select" id="editRentalLimit<?php echo $book['bookID']; ?>" name="rentalLimit">
                            <option value="" <?php echo empty($book['rentalLimit']) ? 'selected' : ''; ?>>Select duration</option>
                            <option value="7 days" <?php echo $book['rentalLimit'] == '7 days' ? 'selected' : ''; ?>>7 days</option>
                            <option value="14 days" <?php echo $book['rentalLimit'] == '14 days' ? 'selected' : ''; ?>>14 days</option>
                            <option value="30 days" <?php echo $book['rentalLimit'] == '30 days' ? 'selected' : ''; ?>>30 days</option>
                            <option value="3 months" <?php echo $book['rentalLimit'] == '3 months' ? 'selected' : ''; ?>>3 months</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editRentPrice<?php echo $book['bookID']; ?>" class="form-label">Rent Price (₱):</label>
                        <input type="number" class="form-control" id="editRentPrice<?php echo $book['bookID']; ?>" name="rentPrice" value="<?php echo htmlspecialchars($book['rentPrice']); ?>" min="0" step="0.01">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No books found. Please upload some books.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Book Modal -->
    <div class="modal fade" id="uploadBookModal" tabindex="-1" aria-labelledby="uploadBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="uploadBookModalLabel">Upload New Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="Uploadconfig.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="bookTitle" class="form-label">Book Title:</label>
                        <input type="text" class="form-control" id="bookTitle" name="bookTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author(s):</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genre:</label>
                        <select class="form-select" id="genre" name="genre" required>
                        <option value="" selected>Select genre</option>
                                <option value="Fiction">Fiction</option>
                                <option value="Romance">Romance</option>
                                <option value="Science Fiction (Sci-Fi)">Science Fiction (Sci-Fi)</option>
                                <option value="Fantasy">Fantasy</option>
                                <option value="Mystery">Mystery</option>
                                <option value="Thriller">Thriller</option>
                                <option value="Horror">Horror</option>
                                <option value="Historical Fiction">Historical Fiction</option>
                                <option value="Literary Fiction">Literary Fiction</option>
                                <option value="Action/Adventure">Action/Adventure</option>
                                <option value="Young Adult (YA)">Young Adult (YA)</option>
                                <option value="Non-Fiction">Non-Fiction</option>
                                <option value="Biography">Biography</option>
                                <option value="Memoir">Memoir</option>
                                <option value="Autobiography">Autobiography</option>
                                <option value="Essay">Essay</option>
                                <option value="Self-Help">Self-Help</option>
                                <option value="History">History</option>
                                <option value="Travel">Travel</option>
                                <option value="Food and Drink">Food and Drink</option>
                                <option value="Science">Science</option>
                                <option value="True Crime">True Crime</option>
                                <option value="Graphic Novel">Graphic Novel</option>
                                <option value="Poetry">Poetry</option>
                                <option value="Drama">Drama</option>
                                <option value="Short Story">Short Story</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aboutAuthor" class="form-label">About the Author:</label>
                        <textarea class="form-control" id="aboutAuthor" name="aboutAuthor" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN:</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condition:</label>
                        <select class="form-select" id="condition" name="condition" required>
                            <option value="Brand New">Brand New</option>
                            <option value="Used">Used</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="damages" class="form-label">Damages:</label>
                        <textarea class="form-control" id="damages" name="damages" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (₱):</label>
                        <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="rentalLimit" class="form-label">Rental Limit (if rent):</label>
                        <select class="form-select" id="rentalLimit" name="rentalLimit">
                            <option value="" selected>Select duration</option>
                            <option value="7 days">7 days</option>
                            <option value="14 days">14 days</option>
                            <option value="30 days">30 days</option>
                            <option value="3 months">3 months</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rentPrice" class="form-label">Rent Price (₱):</label>
                        <input type="number" class="form-control" id="rentPrice" name="rentPrice" min="0" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="bookPicture" class="form-label">Book Picture:</label>
                        <input type="file" class="form-control" id="bookPicture" name="bookPicture" accept=".jpg, .jpeg, .png" required>
                    </div>
                    <div class="mb-3">
                        <label for="uploadedBy" class="form-label">Uploaded By (seller name):</label>
                        <input type="text" class="form-control" id="uploadedBy" name="uploadedBy" value="<?php echo htmlspecialchars($_SESSION['firstName'] . ' ' . $_SESSION['lastName']); ?>" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload Book</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS (including Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
