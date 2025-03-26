<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookWagon Admin Authentication</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/Admin.css">
</head>
<body>
    <!-- Header and nav -->
    <header class="header">
        <div class="logo">
            <a href="home.php">
                <img src="images/logo.png" alt="BookWagon Logo">
                <h1>
                    <span class="book-color">BOOK</span>
                    <span class="wagon-color">WAGON</span>
                </h1>
            </a>
        </div>
    </header>

    <!-- Authentication Form -->
    <div class="auth-container">
        <div class="auth-card">
            <!-- Login Form -->
            <div id="login-section" class="auth-section">
                <h2 class="text-center">Welcome to <strong>BookWagon Admin</strong></h2>
                <form action="admin_login.php" method="POST">
                    <div class="mb-3 text-left">
                        <label for="login-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="login-email" name="emailAddress" placeholder="Enter your email address" required>
                    </div>
                    <div class="mb-3 text-left">
                        <label for="login-password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login-password" name="adminPassword" placeholder="********" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
