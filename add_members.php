<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member - MoraLoan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e9f9e8; }
        .navbar { background-color: #28a745; }
        .navbar-brand { color: white; }
        .form-container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .btn-success { background-color: #28a745; border: none; }
        .btn-success:hover { background-color: #218838; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MoraLoan Admin</a>
    </div>
</nav>
<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center">Add New Member</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $conn->real_escape_string($_POST['name']);
            $card = $conn->real_escape_string($_POST['card']);
            $phone = $conn->real_escape_string($_POST['phone']);

            $sql = "INSERT INTO members (name, card, phone) VALUES ('$name', '$card', '$phone')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success text-center'>Member added successfully!</div>";
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
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">Add Member</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>