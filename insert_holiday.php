<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the AJAX request
$date = $_POST['date'];
$value = $_POST['value'];

// Convert the date format if needed
$formattedDate = date('Y-m-d', strtotime($date));

// Insert data into the 'Holiday' table
$sql = "INSERT INTO Holiday (date, value) VALUES ('$formattedDate', '$value')";

if ($conn->query($sql) === TRUE) {
    echo $value;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
