<?php
@include '../database.php';

// Fetch distinct office names from the 'offices' table
$officeSql = "SELECT DISTINCT officeName FROM offices";
$officeResult = $conn->query($officeSql);

$response = [];

if ($officeResult) {
    while ($officeRow = $officeResult->fetch_assoc()) {
        $officeName = $officeRow['officeName'];

        // Use prepared statements for security
        $sql = "SELECT COUNT(*) AS customer_count FROM `queue` WHERE office = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $officeName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $customerCount = $row['customer_count'];

        // Add the office and customer count to the response array
        $response[] = ["office" => $officeName, "customer_count" => $customerCount];
    }
}

// Output the response as JSON
echo json_encode($response);
?>
