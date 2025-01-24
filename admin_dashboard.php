<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MoraLoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #00a859;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: bold;
            color: #fff;
        }
        .nav-link {
            color: #fff;
            font-size: 1rem;
        }
        .nav-link:hover {
            color: #d1d1d1;
        }
        .container {
            padding: 30px 0;
            flex: 1;
        }
        h2 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn {
            border-radius: 30px;
            padding: 12px 25px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .btn-success {
            background-color: #00a859;
            color: #fff;
            border: none;
        }
        .btn-success:hover {
            background-color: #028c4d;
            transform: translateY(-2px);
        }
        .btn-success i {
            margin-right: 10px;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            height: 100%;
            max-width: 320px;
            margin: 10px;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #333;
        }
        .card-text {
            font-size: 1rem;
            color: #555;
        }
        .card-footer {
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }
        .footer-text {
            font-size: 0.85rem;
            color: #777;
        }
        .d-flex {
            gap: 15px;
        }
        .card-deck {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MoraLoan Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="super_admin_login.php">Super Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <h2>Welcome to the Admin Dashboard</h2>

    <!-- Dashboard Cards -->
    <div class="card-deck">
        <!-- Create Member Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Create New Member</h5>
                    <p class="card-text">Easily create new members to manage loan records and accounts.</p>
                    <a href="add_members.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Create Member</a>
                </div>
            </div>
        </div>
        
        <!-- Add Loan Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Add New Loan</h5>
                    <p class="card-text">Manage loan records by adding new loan details for members.</p>
                    <a href="create_loan.php" class="btn btn-success"><i class="fas fa-money-bill-wave"></i> Create Loan</a>
                </div>
            </div>
        </div>

        <!-- Super Admin Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Super Admin</h5>
                    <p class="card-text">Access the Super Admin panel for higher-level control.</p>
                    <a href="super_admin_login.php" class="btn btn-success"><i class="fas fa-user-shield"></i> Super Admin</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="card-footer">
    <p class="footer-text">© 2025 MoraLoan. All rights reserved. | Developer: <a href="https://t.me/Drkyph7" target="_blank">DrkCyph7</a></p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>