<?php
// Start session
session_start();

// Check if user is already logged in and redirect to dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: admin_dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hard-coded credentials
    $username = "iet";
    $password = "1234qwerty";

    // Get input values
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Validate login credentials
    if ($input_username === $username && $input_password === $password) {
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $input_username;

        // Redirect to dashboard
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MoraLoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-card h2 {
            font-size: 1.8rem;
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-control {
            margin-bottom: 20px;
            border-radius: 30px;
            padding: 12px;
        }
        .btn-login {
            background-color: #00a859;
            color: white;
            font-size: 1.1rem;
            border-radius: 30px;
            padding: 12px 25px;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #028c4d;
            transform: translateY(-2px);
        }
        .footer-text {
            font-size: 0.85rem;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }
        .error-message {
            color: red;
            font-size: 1rem;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Login Form -->
<div class="login-card">
    <h2>Admin Login</h2>

    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="admin_login.php" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-login">Login</button>
    </form>

    <p class="footer-text">© 2025 MoraLoan. All rights reserved. | Developer: <a href="https://t.me/Drkyph7" target="_blank">DrkCyph7</a></p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>