<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoraLoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: white;
        }
        .navbar-nav .nav-item .dropdown-menu {
            background-color: #007bff;
        }
        .navbar-nav .nav-item .dropdown-item {
            color: white;
        }
        .navbar-nav .nav-item .dropdown-item:hover {
            background-color: #0056b3;
        }
        .search-bar { margin-bottom: 30px; }
        .search-input {
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            border: 1px solid #ced4da;
            outline: none;
            background: #ffffff;
            color: #212529;
        }
        .card {
            border: 1px solid #e3e6ea;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            position: relative;
            background: #ffffff;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        .card::before {
            content: '';
            width: 5px;
            height: 100%;
            background-color: #007bff;
            position: absolute;
            left: 0;
            top: 0;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .card-body {
            margin-left: 15px;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
            margin: 0;
        }
        .card-text { font-size: 1rem; margin: 5px 0 0; color: #495057; }

        /* Footer Styles */
        .card-footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
        .footer-text {
            margin: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">MoraLoan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="search-bar">
        <input type="text" id="searchInput" class="search-input" placeholder="Search profiles">
    </div>
    <div class="row" id="profileContainer">
        <?php
        $sql = "SELECT * FROM members";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 profile-card" data-name="' . htmlspecialchars($row['name']) . '" data-card="' . htmlspecialchars($row['card']) . '" data-phone="' . htmlspecialchars($row['phone']) . '">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>';
                echo '<p class="card-text">Loan Amount: Rs. ' . htmlspecialchars($row['loan_amount']) . '</p>';
                echo '</div></div></div>';
            }
        } else {
            echo '<p>No members found.</p>';
        }
        ?>
    </div>
</div>

<div class="card-footer">
    <p class="footer-text">© 2025 MoraLoan. All rights reserved. | Developer: <a href="https://t.me/Drkyph7" target="_blank">DrkCyph7</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            let value = $(this).val().toLowerCase();
            $('.profile-card').filter(function () {
                let name = $(this).data('name').toLowerCase();
                let card = $(this).data('card').toLowerCase();
                let phone = $(this).data('phone').toLowerCase();
                $(this).toggle(name.includes(value) || card.includes(value) || phone.includes(value));
            });
        });
    });
</script>
</body>
</html>