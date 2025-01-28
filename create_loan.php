<?php
// Start session
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin_login.php"); // Replace with your actual login page file name
    exit;
}

// Include database connection
include 'db_connect.php';

// Fetch all members from the database
$members = $conn->query("SELECT id, name FROM members");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loan_value = $_POST['loan_value'];
    $loan_description = $_POST['loan_description'];
    $loan_date = $_POST['loan_date'];  // User-selected loan date
    $selected_members = $_POST['member_ids'];  // Array of selected member IDs

    // Calculate loan per member
    $num_members = count($selected_members);
    $loan_per_member = $loan_value / $num_members;

    // Insert loan details for each selected member
    foreach ($selected_members as $member_id) {
        // Adjusting the current time to GMT +5:30 (server-side date and time)
        $created_at = new DateTime('now', new DateTimeZone('Asia/Colombo'));  // GMT +5:30
        $formatted_created_at = $created_at->format('Y-m-d H:i:s');

        // Insert loan details
        $sql = "INSERT INTO loan (member_id, loan_value, loan_description, loan_date, created_at) 
                VALUES ('$member_id', '$loan_per_member', '$loan_description', '$loan_date', '$formatted_created_at')";

        if (!$conn->query($sql)) {
            echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    }
    echo "<p style='color:green;'>Loan added successfully for " . $num_members . " members!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Loan - MoraLoan</title>
    <!-- Include Bootstrap and Select2 CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        // Initialize Select2 on the member selection dropdown
        $('#members').select2({
            placeholder: "Select Members",
            allowClear: true,
            width: '100%',
            multiple: true
        });
    });
    </script>
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Back to Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarLoanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Create Loan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarLoanDropdown">
                        <li><a class="dropdown-item" href="create_loan.php">Create New Loan</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarHomeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Home
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarHomeDropdown">
                        <li><a class="dropdown-item" href="home.php">Home Page</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center form-title">Create Loan</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="loan_value" class="form-label">Loan Value</label>
                <input type="number" class="form-control" id="loan_value" name="loan_value" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="loan_description" class="form-label">Loan Description</label>
                <textarea class="form-control" id="loan_description" name="loan_description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="loan_date" class="form-label">Loan Date</label>
                <input type="date" class="form-control" id="loan_date" name="loan_date" required>
            </div>
            <div class="mb-3">
                <label for="members" class="form-label">Select Members</label>
                <select id="members" name="member_ids[]" class="form-control" multiple="multiple" required>
                    <?php while ($row = $members->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">Add Loan</button>
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