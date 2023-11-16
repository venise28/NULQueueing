<?php
@include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['office'])) {
    $office = $_POST['office'];

    $officeLimits = [
        'ACCOUNTING' => 3,
        'REGISTRAR' => 3,
        // Add other offices as needed
    ];

    $limit = $officeLimits[$office] ?? 1;

    $officeDataSql = "SELECT * FROM display WHERE officeName = '$office' ORDER BY window, id DESC";
    $officeDataResult = $conn->query($officeDataSql);

    echo '<div class="' . $office . '-queue-container">';
    $queues = [];
    $currentWindows = [];

    if ($officeDataResult->num_rows > 0) {
        while ($officeRow = $officeDataResult->fetch_assoc()) {
            $window = $officeRow["window"];
            $queueNumber = $officeRow["queue_number"];

            // Display only the latest queue for each window
            if (!in_array($window, $currentWindows)) {
                $queues[] = '<div class="' . $office . '-queue queue"><h2 class="queue-text">Window ' . $window . ': ' . $queueNumber . '</h2></div>';
                $currentWindows[] = $window;
            }

            // Break the loop if the desired limit is reached
            if (count($queues) >= $limit) {
                break;
            }
        }

        // Display the reversed queues
        echo implode("", $queues);
    } else {
        // Display an empty queue container if no data is found for the current office
        echo '<div class="' . $office . '-queue queue"><h2 class="queue-text">-</h2></div>';
    }

    echo '</div>'; // Close queue container
} else {
    echo "Invalid request";
}
?>
