<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "queuing_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ID = $_POST['ID'];
$full_name = $_POST['full_name'];
$office = $_POST['office'];
$username = $_POST['username'];
$password = $_POST['password'];

// Check if record exists
$checkSql = "SELECT * FROM user_accounts WHERE ID='$ID'";
$checkResult = $conn->query($checkSql);

if ($checkResult) {
    // update 
    $insertSql = "UPDATE user_accounts 
                  SET full_name = '$full_name',
                      office = '$office',
                      username = '$username',
                      password = '$password'
                  WHERE ID = '$ID'";
                  
    if ($conn->query($insertSql) === TRUE) {
        echo '<script>alert("User details updated successfully!");</script>';
        echo '<script>window.location.href = "users.php";</script>';
        exit();
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
} 

$conn->close();
?>
