<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "ems");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// SQL query to fetch the sum of total_hrs and actual_working_hrs for each distinct empname
$sql = "SELECT empname, 
               SUM(SUBSTRING_INDEX(total_hrs, ' ', 1)) + SUM(SUBSTRING_INDEX(SUBSTRING_INDEX(total_hrs, ' ', -2), ' ', 1) / 60) AS total_hours,
               SUM(SUBSTRING_INDEX(actual_working_hrs, ' ', 1)) + SUM(SUBSTRING_INDEX(SUBSTRING_INDEX(actual_working_hrs, ' ', -2), ' ', 1) / 60) AS actual_hours
        FROM ams 
        GROUP BY empname";

$result = mysqli_query($con, $sql);

// Check if the query was successful
if ($result) {
    // Start table
    echo '<table border="1">
            <tr>
                <th>Employee Name</th>
                <th>Total Worked Hours (hours)</th>
                <th>Total Actual Working Hours (hours)</th>
            </tr>';
    
    // Fetch data and display in a table row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row['empname'] . '</td>
                <td>' . $row['total_hours'] . '</td>
                <td>' . $row['actual_hours'] . '</td>
              </tr>';
    }
    
    // End table
    echo '</table>';
} else {
    // Query failed, handle the error
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
