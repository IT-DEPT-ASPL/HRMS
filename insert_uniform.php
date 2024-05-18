<?php
// update_employee.php

// Replace these database connection details with your actual credentials
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

$selectedEmployee = $_POST['employee'];
$userId = $_POST['userId'];

// Perform the update query (replace 'your_table' with your actual table name)
$sql = "UPDATE uniform SET trouser = '$trouser' , tshirt = '$tshirt' WHERE empname = '$selectedEmployee'";

if ($conn->query($sql) === TRUE) {
    echo " Done !";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
