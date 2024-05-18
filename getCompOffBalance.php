<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empEmail = $_GET['empemail'];

$sql = "SELECT co FROM leavebalance WHERE empemail = '$empEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['co'];
} else {
    echo 0;
}

$conn->close();
?>
