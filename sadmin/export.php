<?php
include '../database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
$selectedMonthStart = $_POST['monthstart'];
$selectedMonthEnd = $_POST['monthend'];
$selectedYear = $_POST['year'];

// Your SQL query
$sql = "SELECT
COUNT(q2.timestamp) AS customer_count,
DATE_FORMAT(q2.timestamp, '%M %e, %Y') AS specific_date,
q2.office AS specific_office
FROM
queue q2
WHERE
YEAR(q2.timestamp) = 2023
AND MONTH(q2.timestamp) BETWEEN 1 AND 12
GROUP BY
specific_date, specific_office
ORDER BY
specific_date, specific_office;";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Set the headers for CSV file download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="exported_data.csv"');

    // Create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // Write the CSV headers
    fputcsv($output, array('Customer Count', 'Date'));

    // Loop through the result set and write data to the CSV file
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    // Close the file pointer
    fclose($output);

    // Close the database connection
    $conn->close();
    exit;
} else {
    // Handle the case where the query fails
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

?>