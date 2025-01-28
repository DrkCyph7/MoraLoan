<?php
session_start();
if (!isset($_SESSION['super_admin']) || $_SESSION['super_admin'] !== true) {
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
        .card {
            background-color: #0d0d0d;
            border: 1px solid #00ff00;
            border-radius: 8px;
            color: #00ff00;
            margin-bottom: 20px;
        }
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
            max-width: 90%;
            width: 400px;
        }
        .form-control { background-color: #000000; color: #00ff00; border: 1px solid #00ff00; }
        .form-control:focus { border-color: #00ff00; box-shadow: none; }
        .btn { border-radius: 20px; }
        @media (max-width: 576px) {
            .popup { width: 100%; }
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
    <h3 class="mb-4">Members and Loans</h3>
    <div class="row" id="profileContainer">
        <?php
        $sql = "SELECT members.id AS member_id, members.name, members.card, members.phone, 
                       loan.id AS loan_id, loan.loan_value, loan.loan_description, loan.loan_date, loan.payment
                FROM members
                LEFT JOIN loan ON members.id = loan.member_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-6 col-lg-4 mb-3 profile-card" 
                        data-member-id="' . $row['member_id'] . '" 
                        data-name="' . $row['name'] . '" 
                        data-card="' . $row['card'] . '" 
                        data-phone="' . $row['phone'] . '" 
                        data-loan-id="' . $row['loan_id'] . '" 
                        data-loan-value="' . $row['loan_value'] . '" 
                        data-loan-description="' . $row['loan_description'] . '" 
                        data-loan-date="' . $row['loan_date'] . '" 
                        data-payment="' . $row['payment'] . '">
                        <div class="card p-3">
                            <h5>' . htmlspecialchars($row['name']) . '</h5>
                            <p>Card: ' . htmlspecialchars($row['card']) . '</p>
                            <p>Phone: ' . htmlspecialchars($row['phone']) . '</p>
                            <p>Loan Amount: Rs. ' . htmlspecialchars($row['loan_value']) . '</p>
                            <p>Payment: ' . ($row['payment'] ? 'Paid' : 'Pending') . '</p>
                        </div>
                    </div>';
            }
        } else {
            echo '<p>No data found.</p>';
        }
        ?>
    </div>
</div>

<div class="popup" id="editPopup">
    <form id="editForm">
        <h5>Edit Details</h5>
        <input type="hidden" id="editMemberId">
        <input type="hidden" id="editLoanId">
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
            <input type="number" id="editLoanValue" class="form-control">
        </div>
        <div class="mb-3">
            <label>Loan Description:</label>
            <textarea id="editLoanDescription" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Loan Date:</label>
            <input type="date" id="editLoanDate" class="form-control">
        </div>
        <div class="mb-3">
            <label>Payment:</label>
            <select id="editPayment" class="form-control">
                <option value="0">Pending</option>
                <option value="1">Paid</option>
            </select>
        </div>
        <button type="button" class="btn btn-success" id="saveChanges">Save</button>
        <button type="button" class="btn btn-danger" id="closePopup">Cancel</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('.profile-card').click(function () {
            $('#editMemberId').val($(this).data('member-id'));
            $('#editLoanId').val($(this).data('loan-id'));
            $('#editName').val($(this).data('name'));
            $('#editCard').val($(this).data('card'));
            $('#editPhone').val($(this).data('phone'));
            $('#editLoanValue').val($(this).data('loan-value'));
            $('#editLoanDescription').val($(this).data('loan-description'));
            $('#editLoanDate').val($(this).data('loan-date'));
            $('#editPayment').val($(this).data('payment'));
            $('#editPopup').show();
        });

        $('#closePopup').click(function () {
            $('#editPopup').hide();
        });

        $('#saveChanges').click(function () {
            let data = {
                member_id: $('#editMemberId').val(),
                loan_id: $('#editLoanId').val(),
                name: $('#editName').val(),
                card: $('#editCard').val(),
                phone: $('#editPhone').val(),
                loan_value: $('#editLoanValue').val(),
                loan_description: $('#editLoanDescription').val(),
                loan_date: $('#editLoanDate').val(),
                payment: $('#editPayment').val()
            };
            $.post('update_member_loan.php', data, function (response) {
                alert(response);
                location.reload();
            });
        });
    });
</script>
</body>
</html>