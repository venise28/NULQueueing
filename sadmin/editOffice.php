<?php
include '../database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ID = $_POST['ID'];
    $updatedAcronym = strtoupper($_POST['acronym']);
    $updatedOfficeName = strtoupper($_POST['OfficeName']);

    // Get the current officeName from the database
    $getCurrentOfficeNameQuery = "SELECT officeName FROM offices WHERE ID = ?";
    
    $stmtCurrentOfficeName = mysqli_prepare($conn, $getCurrentOfficeNameQuery);
    mysqli_stmt_bind_param($stmtCurrentOfficeName, 'i', $ID);
    mysqli_stmt_execute($stmtCurrentOfficeName);
    mysqli_stmt_bind_result($stmtCurrentOfficeName, $currentOfficeName);
    mysqli_stmt_fetch($stmtCurrentOfficeName);
    mysqli_stmt_close($stmtCurrentOfficeName);

    // Perform the update for officeName in offices table using prepared statements
    $updateOfficeQuery = "UPDATE offices SET acronym = ?, officeName = ? WHERE ID = ?";
    
    $stmtOffice = mysqli_prepare($conn, $updateOfficeQuery);
    mysqli_stmt_bind_param($stmtOffice, 'ssi', $updatedAcronym, $updatedOfficeName, $ID);

    if (mysqli_stmt_execute($stmtOffice)) {
        // If officeName in offices table is updated successfully, update the corresponding table name
        $renameTableQuery = "RENAME TABLE $currentOfficeName TO {$updatedOfficeName}";

        // Check if the table exists before attempting to rename it
        $checkTableQuery = "SHOW TABLES LIKE '$currentOfficeName'";
        $result = mysqli_query($conn, $checkTableQuery);

        if (mysqli_num_rows($result) > 0) {
            // Table exists, proceed with the rename
            if (mysqli_query($conn, $renameTableQuery)) {
                echo "Office details and table name updated successfully";
            } else {
                echo "Error updating table name: " . mysqli_error($conn);
            }
        } else {
            // Table doesn't exist, handle accordingly (e.g., display a message)
            echo "Error: The table '$currentOfficeName' does not exist.";
        }
    } else {
        echo "Error updating office: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmtOffice);
}

mysqli_close($conn);
?>