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
                                    <img src="<?php echo htmlspecialchars($book['bookPicture']); ?>" alt="Book Image" class="img-fluid border rounded">
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of View Book Modal -->

            <!-- Edit Book Modal -->
            <div class="modal fade" id="editBookModal<?php echo $book['bookID']; ?>" tabindex="-1" aria-labelledby="editBookModalLabel<?php echo $book['bookID']; ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBookModalLabel<?php echo $book['bookID']; ?>">Edit Book: <?php echo htmlspecialchars($book['title']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="book_edit.php" method="post" enctype="multipart/form-data">
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
                                <div class="mb-3">
                                    <label for="editBookPicture<?php echo $book['bookID']; ?>" class="form-label">Book Picture:</label>
                                    <input type="file" class="form-control" id="editBookPicture<?php echo $book['bookID']; ?>" name="bookPicture" accept=".jpg, .jpeg, .png">
                                    <img src="<?php echo htmlspecialchars($book['bookPicture']); ?>" alt="Current Book Image" class="img-fluid mt-2">
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
            <!-- End of Edit Book Modal -->

        <?php endforeach; ?>
    <?php else: ?>
        <p>No books found. Please upload some books.</p>
    <?php endif; ?>
</div>
</div>
</div>