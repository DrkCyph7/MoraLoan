<?php
session_start();
include 'db_connect.php';

// Check if admin is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin_login.php"); // Replace with your actual login page file name
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member - MoraLoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9f9e8;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #28a745;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .navbar-brand:hover {
            color: #d4d4d4;
        }
        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            color: #28a745;
            font-weight: bold;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #28a745;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MoraLoan Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Back to Admin Button -->
                <li class="nav-item">
                    <a class="nav-link text-white" href="admin_dashboard.php">Back to Admin</a>
                </li>
                <!-- Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin Actions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="create_loan.php">Loan</a></li>  <!-- Replace with your actual loan page link -->
                        <li><a class="dropdown-item" href="index.php">Home</a></li>  <!-- Replace with your actual home page link -->
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>  <!-- Replace with your actual logout link -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center form-title">Add New Member</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $conn->real_escape_string(trim($_POST['name']));
            $card = $conn->real_escape_string(trim($_POST['card']));
            $phone = !empty($_POST['phone']) ? $conn->real_escape_string(trim($_POST['phone'])) : NULL;

            $sql = "INSERT INTO members (name, card, phone) VALUES ('$name', '$card', " . ($phone ? "'$phone'" : "NULL") . ")";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success text-center'>$name added to MoraLoan!</div>";
            } else {
                echo "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
            }
        }
        ?>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter member name" required>
            </div>
            <div class="mb-3">
                <label for="card" class="form-label">Card</label>
                <input type="text" class="form-control" id="card" name="card" placeholder="Enter card number" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone (Optional)</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number (optional)">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">Add Member</button>
            </div>
        </form>
    </div>
</div>
<footer>
    &copy; 2025 MoraLoan Admin Panel
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>