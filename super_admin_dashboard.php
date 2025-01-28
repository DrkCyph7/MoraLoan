<?php
session_start();

// Use the old logic for verifying the super admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'super_admin') {
    header('Location: super_admin_login.php');
    exit;
}

include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background-color: #000000; color: #00ff00; font-family: 'Courier New', monospace; }
        .navbar { background-color: #00ff00; color: #000000; }
        .navbar-nav .nav-item .dropdown-menu {
            background-color: #00ff00;
        }
        .navbar-nav .nav-item .dropdown-item {
            color: #000000;
        }
        .navbar-nav .nav-item .dropdown-item:hover {
            background-color: #0056b3;
        }
        .search-bar { margin-bottom: 30px; }
        .search-input {
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            border: 1px solid #00ff00;
            outline: none;
            background: #000000;
            color: #00ff00;
        }
        .card {
            background-color: #0d0d0d;
            border: 1px solid #00ff00;
            border-radius: 8px;
            color: #00ff00;
            margin-bottom: 20px;
        }
        .card:hover { background-color: #111111; }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #000000;
            color: #00ff00;
            padding: 20px;
            border: 2px solid #00ff00;
            border-radius: 10px;
            z-index: 9999;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <span class="navbar-brand">Super Admin Dashboard</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
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
        // Fetch all loan entries from the database
        $sql = "SELECT id, name, card, phone, loan_amount FROM members";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 profile-card" data-id="' . htmlspecialchars($row['id']) . '" data-name="' . htmlspecialchars($row['name']) . '" data-card="' . htmlspecialchars($row['card']) . '" data-phone="' . htmlspecialchars($row['phone']) . '" data-loan="' . htmlspecialchars($row['loan_amount']) . '">';
                echo '<div class="card p-3">';
                echo '<h5>' . htmlspecialchars($row['name']) . '</h5>';
                echo '<p>Loan Amount: Rs. ' . htmlspecialchars($row['loan_amount']) . '</p>';
                echo '</div></div>';
            }
        } else {
            echo '<p>No profiles found.</p>';
        }
        ?>
    </div>
</div>

<div class="popup" id="editPopup">
    <form id="editForm">
        <h5>Edit User Details</h5>
        <input type="hidden" id="editId">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" id="editName" class="form-control">
        </div>
        <div class="mb-3">
            <label>Card:</label>
            <input type="text" id="editCard" class="form-control">
        </div>
        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" id="editPhone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Loan Amount:</label>
            <input type="number" id="editLoan" class="form-control">
        </div>
        <button type="button" class="btn btn-success" id="saveChanges">Save</button>
        <button type="button" class="btn btn-danger" id="closePopup">Cancel</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Search functionality
        $('#searchInput').on('input', function () {
            let value = $(this).val().toLowerCase();
            $('.profile-card').filter(function () {
                let name = $(this).data('name').toLowerCase();
                let card = $(this).data('card').toLowerCase();
                let phone = $(this).data('phone').toLowerCase();
                $(this).toggle(name.includes(value) || card.includes(value) || phone.includes(value));
            });
        });

        // Open popup on click
        $('.profile-card').click(function () {
            $('#editId').val($(this).data('id'));
            $('#editName').val($(this).data('name'));
            $('#editCard').val($(this).data('card'));
            $('#editPhone').val($(this).data('phone'));
            $('#editLoan').val($(this).data('loan'));
            $('#editPopup').show();
        });

        // Close popup
        $('#closePopup').click(function () {
            $('#editPopup').hide();
        });

        // Save changes
        $('#saveChanges').click(function () {
            let id = $('#editId').val();
            let name = $('#editName').val();
            let card = $('#editCard').val();
            let phone = $('#editPhone').val();
            let loan = $('#editLoan').val();

            $.post('update_member.php', { id, name, card, phone, loan }, function (response) {
                alert(response);
                location.reload();
            });
        });
    });
</script>
</body>
</html>
