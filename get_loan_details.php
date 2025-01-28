<?php
include 'db_connect.php';

// Get the member ID from the request
$member_id = $_GET['member_id'];

// Query to get loan details for the specific member
$sql = "SELECT * FROM loan WHERE member_id = $member_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th>Description</th><th>Date</th><th>Amount</th></tr></thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['loan_description']) . '</td>';
        echo '<td>' . htmlspecialchars($row['loan_date']) . '</td>';
        echo '<td>Rs. ' . number_format($row['loan_value'], 2) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No loan details found for this member.</p>';
}
?>