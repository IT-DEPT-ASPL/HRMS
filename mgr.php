<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empname = mysqli_real_escape_string($conn, $_POST['empname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$desgs = $_POST['desgs']; 
$status = mysqli_real_escape_string($conn, $_POST['status']);

$concatenatedDesgs = implode(', ', $desgs);


$sql = "INSERT INTO manager (empname, email, desg, status) 
        VALUES ('$empname', '$email', '$concatenatedDesgs', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
