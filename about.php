<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About MoraLoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f4f7f9;
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
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
        .about-header {
            font-size: 3rem;
            font-weight: 700;
            color: #007bff;
            text-align: center;
            margin-top: 50px;
        }
        .about-section {
            background-color: #ffffff;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .section-title {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }
        .about-paragraph {
            font-size: 1.15rem;
            color: #495057;
            margin-bottom: 20px;
            text-align: justify; /* Justify the text */
        }
        .list-item {
            font-size: 1.1rem;
            margin-bottom: 10px;
            padding-left: 1.2em;
        }
        .list-item::before {
            content: '•';
            color: #007bff;
            font-size: 1.5rem;
            padding-right: 10px;
        }
        .contact-info a {
            color: #007bff;
            text-decoration: none;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
        .footer {
            text-align: center;
            padding: 30px;
            background-color: #f1f1f1;
            margin-top: 50px;
            border-radius: 10px;
        }
        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MoraLoan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container">
    <div class="about-header">
        Welcome to MoraLoan!
    </div>

    <div class="about-section">
        <h2 class="section-title">About MoraLoan</h2>
        <p class="about-paragraph">At MoraLoan, we aim to provide accessible, fast, and flexible loan services to all users. Whether you're looking for a personal loan or funding for your business, we are committed to helping you navigate the process smoothly. Our goal is to ensure that loans are simple, transparent, and secure for everyone.</p>
        
        <h3 class="section-title">Developer Information</h3>
        <p class="about-paragraph">MoraLoan was developed by <strong>DrkCyph7</strong>, a web, Android, and iOS app developer with a deep commitment to simplifying financial services. His vision is to create an intuitive platform that makes loans more accessible, ensuring ease of use, security, and reliability for all users.</p>
        
        <h3 class="section-title">Version</h3>
        <p class="about-paragraph">You are currently using version <strong>1.0</strong> of MoraLoan. We are continuously working on enhancing the platform to offer even more features and improvements in future updates.</p>

        <h3 class="section-title">Our Mission</h3>
        <p class="about-paragraph">Our mission at MoraLoan is to offer a seamless connection between borrowers and lenders. We aim to make loan applications straightforward and hassle-free while upholding the highest standards of security and transparency. Our goal is to help individuals and businesses achieve their financial aspirations.</p>

        <h3 class="section-title">Why Choose MoraLoan?</h3>
        <ul>
            <li class="list-item"><strong>Fast Loan Processing:</strong> Apply for loans quickly and receive prompt responses.</li>
            <li class="list-item"><strong>Flexible Loan Terms:</strong> Loan terms designed to fit your specific needs.</li>
            <li class="list-item"><strong>Secure and Transparent:</strong> Advanced security measures ensure your data remains protected.</li>
            <li class="list-item"><strong>Dedicated Customer Support:</strong> Our team is available to assist you at every step.</li>
        </ul>

        <h3 class="section-title">Contact the Developer</h3>
        <p class="about-paragraph">If you have any questions or need assistance, feel free to contact the developer directly via <span class="contact-info"><a href="https://t.me/drkcyph7" target="_blank">Telegram</a></span> for support.</p>
    </div>
</div>

<!-- Footer -->
<div class="footer">
<p class="footer-text">© 2025 MoraLoan. All rights reserved. | Developer: <a href="https://t.me/Drkyph7" target="_blank">DrkCyph7</a></p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>