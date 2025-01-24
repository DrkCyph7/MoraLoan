<?php
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $card = $_POST['card'];
    $phone = $_POST['phone'];
    $loan = $_POST['loan'];

    $sql = "UPDATE members SET name='$name', card='$card', phone='$phone', loan_amount='$loan' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>