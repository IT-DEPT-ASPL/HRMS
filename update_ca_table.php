<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empEmail = $_POST['empEmail'];
    $empName = $_POST['empName'];
    $submissionTime = $_POST['submissionTime'];
    $confirm = $_POST['confirm'];

    $insertQuery = "INSERT INTO CA (empemail, empname, status, submissionTime, confirmed) VALUES ('$empEmail', '$empName', 1, '$submissionTime','$confirm')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
    
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
