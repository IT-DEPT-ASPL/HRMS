<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empname = $_POST['empname'];
$leavetype = $_POST['leavetype'];
$leavetype2 = isset($_POST['leavetype2']) ? $_POST['leavetype2'] : 0;
$from = (isset($_POST['from']) && !empty($_POST['from'])) ? $_POST['from'] : (isset($_POST['from1']) ? $_POST['from1'] : null);
$to = (isset($_POST['to']) && !empty($_POST['to'])) ? $_POST['to'] : (isset($_POST['to2']) ? $_POST['to2'] : null);
$desg = $_POST['desg'];
$status = $_POST['status'];
$reason = $_POST['reason'];
$empph = $_POST['empph'];
$empemail = $_POST['empemail'];
$status2 = isset($_POST['status2']) ? $_POST['status2'] : 0;

$sql = "INSERT INTO leaves (empname, leavetype,leavetype2, `from`, `to`, desg, status, status2, reason, empph, empemail) 
        VALUES ('$empname', '$leavetype',  '$leavetype2', '$from', '$to', '$desg', '$status', '$status2', '$reason', '$empph', '$empemail')";

if ($conn->query($sql) === TRUE) {
    echo "Done!";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>