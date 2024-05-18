<?php
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

$holidays = array();

$sql = "SELECT * FROM holiday";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $holidays[] = date("Y-m-d", strtotime($row['value']));
    }
}

function generateCalendar($month, $year, $holidays) {
    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    $lastDay = mktime(0, 0, 0, $month + 1, 0, $year);

    echo '<table border="1">';
    echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';

    $currentDay = $firstDay;

    while ($currentDay <= $lastDay) {
        echo '<tr>';

        for ($i = 0; $i < 7; $i++) {
            echo '<td>';
            if (date("n", $currentDay) == $month) {
                $day = date("j", $currentDay);
                echo $day;

                // Check if the current day is a holiday
                $dateString = date("Y-m-d", $currentDay);
                if (in_array($dateString, $holidays, true)) {
                    echo '<br><span style="color:red;">Holiday</span>';
                }
                
            }

            echo '</td>';

            $currentDay = strtotime("+1 day", $currentDay);
        }

        echo '</tr>';
    }

    echo '</table>';
}

// Example: Display calendar for January 2024
$month = 1;
$year = 2024;
generateCalendar($month, $year, $holidays);

// Close the MySQL connection
$conn->close();
?>
