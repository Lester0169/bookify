<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon</title>
    
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Landing.css">
    
</head>
<body>
    <!-- Header and nav -->
    <header class="header">
    <div class="logo">
    <img src="images/logo.png" alt="BookWagon Logo">
    <h1>
        <span class="book-color">BOOK</span>
        <span class="wagon-color">WAGON</span>
    </h1>
</div>
    <div class="auth-links">
        <a href="#" class="nav-link btn btn-link login-btn" data-bs-toggle="modal" data-bs-target="#loginModal"><strong>Sign In</strong></a>
        <a href="#" class="nav-link btn btn-link signup-btn" data-bs-toggle="modal" data-bs-target="#signupModal"><strong>Sign Up</strong></a>
    </div>
</header>

<nav class="navbar navbar-expand-lg" style="background-color: #faf4e7;"> <!-- Replace '#faf4e7' with your desired color -->
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Books
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Rent Book</a></li>
                        <li><a class="dropdown-item" href="#">Buy Book</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Explore
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Genre</a></li>
                        <li><a class="dropdown-item" href="#">Recommendations</a></li>
                        <li><a class="dropdown-item" href="#">E-book</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Sign Up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="signup-form" class="form" action="register.php" method="POST">
                    <div class="mb-3">
                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="emailAddress" class="form-control" placeholder="Email address" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="phoneNumber" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="createPassword" class="form-control" placeholder="Create Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">I've read and agree with Terms of Service and our Privacy Policy</label>
                    </div>
                    <button type="submit" class="btn btn-primary">SIGN UP</button>
                </form>
                <div class="social-signup mt-3">
                    <p>Or sign up with</p>
                    <div class="social-icons d-flex justify-content-left gap-3">
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="images/fb.png" alt="Facebook" class="icon-size"></a>
                            <p class="ms-2">Facebook</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="#"><img src="images/google.png" alt="Google" class="icon-size"></a>
                            <p class="ms-2">Google</p>
                        </div>
                    </div>
                </div>
                <div class="signin-link mt-3 text-left">
                    <p>Already have an account? <a href="#" id="openSigninModal" data-bs-toggle="modal" data-bs-target="#signinModal" data-bs-dismiss="modal">SIGN IN</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="signin-form" class="form" action="login.php" method="POST">
                    <div class="mb-3">
                        <input type="email" name="emailAddress" class="form-control" placeholder="Email address" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">SIGN IN</button>
                </form>
                <div class="signup-link mt-3 text-left">
                    <p>Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">SIGN UP</a></p>
                </div>
                <div class="text-center mt-3">
                    <a href="Admin_Index.php" class="btn admin-login-btn">Login as ADMIN</a>
                </div>
            </div>
        </div>
    </div>
</div>



            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<main>
    <section class="book-section">
        <div class="book-text">
            <h1>We help people to find books & reading materials with ease</h1>
            <p>Explore our vast collection of books and enjoy a seamless rental experience with BookWagon.</p>
            <div class="search-bar">
                <input type="text" placeholder="Search for books...">
                <button class="btn btn-primary"><strong>Search</strong></button>
            </div>
        </div>
        <div class="book-image">
            <!-- Bootstrap Carousel -->
            <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Images/bg1.png" class="d-block w-100 carousel-image" alt="Book 1">
                    </div>
                    <div class="carousel-item">
                        <img src="Images/bg2.png" class="d-block w-100 carousel-image" alt="Book 2">
                    </div>
                    <div class="carousel-item">
                        <img src="Images/bg3.png" class="d-block w-100 carousel-image" alt="Book 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <button class="btn btn-secondary rent-now-btn" data-bs-toggle="modal" data-bs-target="#signupModal"><strong>Rent Now</strong></button>
        </div>
    </section>
  <!-- Event Section --> 
<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="images/event1.png" alt="First event">
                <div class="carousel-caption d-none d-md-block">
                    <h5>The UST Publishing House presents: SINAG 2024</h5>
                    <p>Join us for a celebration of literature and culture.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/event2.png" alt="Second event">
                <div class="carousel-caption d-none d-md-block">
                    <h5>PRPB Memories: Reading and Onward Journeys with a Book Club</h5>
                    <p>Reflect on past readings and explore new literary adventures.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="images/event3.png" alt="Third event">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A Toast to Books: Industry Reception</h5>
                    <p>Celebrate the publishing industry's achievements and future directions.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon icon-clickable" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon icon-clickable" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


    <section class="info-section">
        <div class="info-container">
            <div class="info-item">
                <img src="Images/money.png" alt="Icon 1" class="info-icon">
                <h2>Budget-friendly access to a wide variety of books</h2>
                <p>BookWagon offers a renting system instead of buying, allowing you to explore new titles without a big upfront cost. This is especially helpful for educational resources or books you're unsure about committing to.</p>
            </div>
            <div class="info-item">
                <img src="Images/Flexible.png" alt="Icon 2" class="info-icon">
                <h2>Flexibility and personalization</h2>
                <p>Unlike traditional libraries with set return dates, BookWagon provides flexible rental options. You can choose a rental duration that fits your reading speed and preferences, whether you're a speed reader or someone who enjoys taking their time.</p>
            </div>
            <div class="info-item">
                <img src="Images/Trust.png" alt="Icon 3" class="info-icon">
                <h2>Building a trustworthy community</h2>
                <p>BookWagon goes beyond just renting books. With a review system for both books and users, you can make informed decisions based on other readers' experiences. This fosters a sense of trust and helps you discover hidden gems or avoid books in bad condition.</p>
            </div>
        </div>
    </section>
</main>

<!-- Custom JS for form submission -->
<script>
  document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    this.submit();
  });

  document.getElementById('signin-form').addEventListener('submit', function(event) {
    event.preventDefault();
    this.submit();
  });

  // Script to handle modal switching
  document.getElementById('openSigninModal').addEventListener('click', function() {
    var signupModal = new bootstrap.Modal(document.getElementById('signupModal'));
    var signinModal = new bootstrap.Modal(document.getElementById('loginModal'));
    signupModal.hide();
    signinModal.show();
  });
</script>
</body>
</html>
