<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$leavetype= $_POST['leavetype'];

$sql = "INSERT INTO leavetype (leavetype) VALUES ('$leavetype')";

if ($conn->query($sql) === TRUE) {
    echo "Done !";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
