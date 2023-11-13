<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ID = $_POST['ID'];
    $updatedAcronym = $_POST['acronym'];
    $updatedOfficeName = $_POST['OfficeName'];

    // Retrieve the officeName for the given ID
    $getOfficeInfoQuery = "SELECT officeName FROM offices WHERE ID = ?";
    $stmtGetOffice = mysqli_prepare($conn, $getOfficeInfoQuery);
    mysqli_stmt_bind_param($stmtGetOffice, "i", $ID);
    mysqli_stmt_execute($stmtGetOffice);
    $result = mysqli_stmt_get_result($stmtGetOffice);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $officeName = $row['officeName'];

        // Use the officeName to construct the table name
        $tableName = str_replace(' ', '_', $officeName); // Replace spaces with underscores

        // Perform the update
        $updateQuery = "UPDATE $tableName SET acronym = ?, officeName = ? WHERE ID = ?";
        $stmtUpdateTable = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmtUpdateTable, "ssi", $updatedAcronym, $updatedOfficeName, $ID);

        if (mysqli_stmt_execute($stmtUpdateTable)) {
            echo "Office details updated successfully";
        } else {
            echo "Error updating office: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmtUpdateTable);
    } else {
        echo "Error retrieving office information: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmtGetOffice);
}
?>



// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $ID = $_POST['ID'];
//     $updatedAcronym = $_POST['acronym']; // Change this line
//     $updatedOfficeName = $_POST['OfficeName']; // Change this line

//     // Perform the update
//     $updateQuery = "UPDATE offices SET acronym = '$updatedAcronym', officeName = '$updatedOfficeName' WHERE ID = '$ID'";
//     if (mysqli_query($conn, $updateQuery)) {
//         echo "Office details updated successfully";
//     } else {
//         echo "Error updating office: " . mysqli_error($conn);
//     }
// }