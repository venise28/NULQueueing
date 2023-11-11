<?php
include '../database.php';

$selectedMonthStart = $_POST['monthstart'];
$selectedMonthEnd = $_POST['monthend'];
$selectedOffice = $_POST['office'];
$selectedYear = $_POST['year'];

if ($selectedOffice === 'ALL-OFFICES') {
    $query = $conn->query("SELECT IFNULL(COUNT(q2.timestamp), 0) AS customer_week, 
    week.week_name
    FROM (
         SELECT 'WEEK 1' AS week_name
         UNION
         SELECT 'WEEK 2' AS week_name
         UNION
         SELECT 'WEEK 3' AS week_name
         UNION
         SELECT 'WEEK 4' AS week_name
    ) AS week
    LEFT JOIN queue q2 ON
        (DAY(q2.timestamp) BETWEEN 
             CASE week.week_name
                 WHEN 'WEEK 1' THEN 1
                 WHEN 'WEEK 2' THEN 8
                 WHEN 'WEEK 3' THEN 15
                 WHEN 'WEEK 4' THEN 22
             END
         AND
             CASE week.week_name
                 WHEN 'WEEK 1' THEN 7
                 WHEN 'WEEK 2' THEN 14
                 WHEN 'WEEK 3' THEN 21
                 WHEN 'WEEK 4' THEN DAY(LAST_DAY(q2.timestamp))
             END)

         AND MONTH(q2.timestamp) = $selectedMonth
    GROUP BY week.week_name;");
} else {
    $query = $conn->query("SELECT
    SUM(IFNULL(customer_count, 0)) AS total_customers,
    CONCAT(
        DATE_FORMAT(MIN(specific_date), '%M %e, %Y'),
        CASE WHEN MIN(specific_date) <> MAX(specific_date) 
             THEN CONCAT(' to ', DATE_FORMAT(MAX(specific_date), '%M %e, %Y'))
             ELSE ''
        END
    ) AS week_date_range
FROM (
    SELECT
        IFNULL(COUNT(q2.timestamp), 0) AS customer_count,
        DATE(q2.timestamp) AS specific_date
    FROM
        queue q2
    WHERE
        YEAR(q2.timestamp) = $selectedYear
        AND MONTH(q2.timestamp) BETWEEN $selectedMonthStart AND $selectedMonthEnd
        AND q2.office = '$selectedOffice'
    GROUP BY
        specific_date
) AS subquery
GROUP BY
    WEEK(specific_date);
");
}

$customer = [];
$week = [];

foreach ($query as $data) {
    $customer[] = $data['total_customers'];
    $week[] = $data['week_date_range'];
}

// Combine data into a single associative array
$response = [
    'customer' => $customer,
    'week' => $week,
];

// Encode the combined array as JSON
echo json_encode($response);
?>