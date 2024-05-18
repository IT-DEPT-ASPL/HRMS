<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedEmployees = $_POST['selectedEmployees'];
    $submissionTime = $_POST['submissionTime'];
    $confirm = $_POST['confirm'];
    foreach ($selectedEmployees as $employeeName) {
        // Fetch current leave balance for the employee
        $selectSql = "SELECT sl, cl, isl, icl  FROM leavebalance WHERE empname = '$employeeName'";
        $result = $conn->query($selectSql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Increment the existing values
            $slValue = $row['sl'] + 1;
            $clValue = $row['cl'] + 1;
            $islValue = $row['isl'] + 1;
            $iclValue = $row['icl'] + 1;
            $lastupdate = date('Y-m-d H:i:s');

            // Update the leave balance
            $updateSql = "UPDATE leavebalance SET sl = $slValue, cl = $clValue, isl = $islValue, icl = $iclValue , lastupdate = '$lastupdate' WHERE empname = '$employeeName'";

            if ($conn->query($updateSql) === TRUE) {
                // Insert confirmation record into CA table
                $insertSql = "INSERT INTO CA (empname, status, submissionTime, confirmed) VALUES ('$employeeName', 1, '$submissionTime', '$confirm')";
                $conn->query($insertSql);
            } else {
                $response = array('status' => 'error', 'message' => 'Error updating leave balance: ' . $conn->error);
                echo json_encode($response);
                exit();
            }
        } else {
            $response = array('status' => 'error', 'message' => 'No leave balance found for the specified employee: ' . $employeeName);
            echo json_encode($response);
            exit();
        }
    }

    // All operations succeeded
    $response = array('status' => 'success', 'message' => 'Leave balances and attendance confirmed successfully!');
    echo json_encode($response);
} else {
    echo "Invalid request";
}

$conn->close();
