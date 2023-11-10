<?php
@include 'database.php';

// clone data to admission table.
function insertQueueToAdmission($data)
{
    global $conn;
    $studentId = $data['studentId'];
    $program = $data['program'] ?? null;
    $queueNumber = $data['queue_number'];
    $timeStamp = date('Y-m-d H:i:s');
    $transaction = $data['transaction'] ?? null;
    $remarks = $data['remarks'] ?? null;

    $sql = "INSERT INTO admission (queue_number, student_id, timestamp, transaction, remarks, program) VALUES ('$queueNumber', '$studentId', '$timeStamp', '$transaction', '$remarks', '$program')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Handle the request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $office = $_POST["office"];
    $studentId = $_POST["studentId"];
    $program = $_POST["program"];
    $endorsed = "kiosk";


    // Get the next queue number for the selected office
    $queueNumber = getNextQueueNumber($office);

    // Insert the record into the database
    $sql = "INSERT INTO queue (student_id, program, queue_number, office, endorsed) VALUES ('$studentId', '$program', '$queueNumber', '$office', '$endorsed')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "queue_number" => $queueNumber]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error]);
    }

    if ($office === "ADMISSION") {
        $admissionData = [
            "studentId" => $studentId,
            "program" => $program,
            "queue_number" => $queueNumber,
            "transaction" => null,
            "remarks" => null
        ];

        insertQueueToAdmission($admissionData);
    }
} else {
    echo "Invalid request";
}


// Function to get the next queue number for a given office
function getNextQueueNumber($office)
{
    global $conn;

    // Fetch the acronym from the offices table
    $acronymSql = "SELECT acronym FROM offices WHERE officeName = '$office'";
    $acronymResult = $conn->query($acronymSql);

    if ($acronymResult->num_rows > 0) {
        $acronymRow = $acronymResult->fetch_assoc();
        $acronym = $acronymRow['acronym'];
    } else {
        // Default to a generic prefix if no acronym is found
        $acronym = "DEFAULT";
    }

    // Use the fetched or default acronym as the prefix
    $prefix = $acronym;

    $sql = "SELECT MAX(queue_number) as max_queue FROM queue WHERE office = '$office'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $maxQueue = $row['max_queue'];
        // Extract the numeric part of the queue number
        $numericPart = (int) substr($maxQueue, strlen($prefix));
        // Increment the numeric part
        $nextNumericPart = $numericPart + 1;
        // Format the next queue number
        $nextQueue = $prefix . str_pad($nextNumericPart, 3, '0', STR_PAD_LEFT);
        return $nextQueue;
    } else {
        // If no records exist for the office, start from 001
        return $prefix . "001";
    }
}


$conn->close();
