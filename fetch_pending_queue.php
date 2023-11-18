<?php
@include 'database.php';

// Fetch office names from the 'offices' table
$sql = "SELECT DISTINCT officeName FROM offices";
$result = $conn->query($sql);

// Output pending queue data for each office
while ($row = $result->fetch_assoc()) {
    $officeName = $row["officeName"];

    // Fetch pending queue data for the current office
    // $pendingQueueSql = "SELECT * FROM $officeName ORDER BY id DESC LIMIT 10"; // Adjust the query as needed
    $pendingQueueSql = "SELECT * FROM $officeName ORDER BY timestamp ASC LIMIT 2";
    $pendingQueueResult = $conn->query($pendingQueueSql);

    //echo '<div class="pending-queue queue">';
    
    if ($pendingQueueResult->num_rows > 0) {
        while ($pendingRow = $pendingQueueResult->fetch_assoc()) {
            $queueNumber = $pendingRow["queue_number"];
            echo '<h2>' . $queueNumber . '</h2>';
        }
    } 
    // else {
    //     echo '<h2>No pending queue for ' . $officeName . '</h2>';
    // }

    //echo '</div>';
}

$conn->close();
?>
