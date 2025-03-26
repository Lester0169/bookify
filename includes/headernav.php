<header class="header">
    <div class="logo">
        <img src="images/logo.png" alt="BookWagon Logo">
        <h1>BOOK WAGON</h1>
    </div>
    <div class="auth-links">
    <a href="#" class="nav-link btn btn-link login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Sign In</a>
        <a href="#" class="nav-link btn btn-link signup-btn" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
    </div>
</header>
<nav class="navbar navbar-expand-lg bg-body-tertiary custom-navbar">
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
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>