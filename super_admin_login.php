<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    if ($password === 'RexZeal') {
        $_SESSION['super_admin'] = true;
        header('Location: super_admin_dashboard.php');
        exit;
    } else {
        $error = "Invalid password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #000000; color: #00ff00; font-family: 'Courier New', monospace; }
        .container { margin-top: 100px; text-align: center; }
        .btn { background-color: #00ff00; color: #000000; border: none; }
        .btn:hover { background-color: #00cc00; }
    </style>
</head>
<body>
<div class="container">
    <h1>Super Admin Login</h1>
    <form method="POST">
        <input type="password" name="password" placeholder="Enter Super Admin Password" class="form-control mb-3" required>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <button type="submit" class="btn btn-lg">Login</button>
    </form>
</div>
</body>
</html>