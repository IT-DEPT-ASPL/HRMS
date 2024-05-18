<?php
// insert_data.php

require_once("dbConfig.php"); // Include your database configuration file

// Retrieve data from the AJAX request
$empName = $_POST['emp_name'];
$userId = $_POST['user_id'];
$dateOfAttendance = $_POST['date_of_attendance'];
$attendanceText = $_POST['attendance_text'];

// Split 'CI:CO' into 'CI' and 'CO'
list($checkInText, $checkOutText) = explode(':', $attendanceText);

// Insert data into the database
$insertQuery = "INSERT INTO attendance_data (emp_name, user_id, date, check_in_text, check_out_text, attendance_text)
               VALUES ('$empName', '$userId', '$dateOfAttendance', '$checkInText', '$checkOutText', '$attendanceText')";

mysqli_query($db, $insertQuery) or die(mysqli_error($db));

echo "Data inserted successfully!";
?>
