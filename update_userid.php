<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the AJAX request
$selectedEmployee = $_POST['employee'];
$userId = $_POST['userId'];

// Perform the update query (replace 'your_table' with your actual table name)
$sql = "UPDATE emp SET UserId = '$userId' WHERE empname = '$selectedEmployee'";

if ($conn->query($sql) === TRUE) {
    echo "Mapping UserID with Employee Done !";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
