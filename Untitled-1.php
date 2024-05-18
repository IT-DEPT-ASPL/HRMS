<?php
require_once("dbConfig.php");

$firstDayOfMonth = date("1-m-Y");
$totalDaysInMonth = date("t", strtotime($firstDayOfMonth));

// Fetching Employees 
$fetchingEmployees = mysqli_query($db, "SELECT * FROM emp") or die(mysqli_error($db));
$totalNumberOfEmployees = mysqli_num_rows($fetchingEmployees);

$EmployeesNamesArray = array();
$EmployeesIDsArray = array();
$counter = 0;
while ($Employees = mysqli_fetch_assoc($fetchingEmployees)) {
    $EmployeesNamesArray[] = $Employees['empname'];
    $EmployeesIDsArray[] = $Employees['UserID'];
}

?>

<table border="1" cellspacing="0">
    <?php
    $lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth));
    // Calculate the number of Sundays in the current month
    $sundaysCount = 0;
    for ($j = 1; $j <= $totalDaysInMonth; $j++) {
        $dateOfAttendance = date("Y-m-$j");
        $dayOfWeek = date('N', strtotime($dateOfAttendance));
        if ($dayOfWeek == 7) {
            $sundaysCount++;
        }
    }
    for ($i = 1; $i <= $totalNumberOfEmployees + 2; $i++) {
        if ($i == 1) {
            echo "<tr>";
            echo "<td rowspan='2'>Names</td>";
            for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                echo "<td>$j</td>";
            }
            echo "<td colspan='3'>Total</td>";
            echo "</tr>";
        } else if ($i == 2) {
            echo "<tr>";
            for ($j = 0; $j < $totalDaysInMonth; $j++) {
                echo "<td>" . date("D", strtotime("+$j days", strtotime($firstDayOfMonth))) . "</td>";
            }
            echo "<td>Present</td>";
            echo "<td>Absent</td>";
            echo "<td>Leaves</td>";
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td>" . $EmployeesNamesArray[$counter] . " (UserID: " . $EmployeesIDsArray[$counter] . ")</td>";

            $color = "";
            for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                $dateOfAttendance = date("Y-m-$j");

                // Always show 'Sun' for Sundays
                $dayOfWeek = date('N', strtotime($dateOfAttendance));
                $attendanceText = ($dayOfWeek == 7) ? 'Sun' : '';
                if ($dayOfWeek != 7) {
                    // Check for leaves entries
                    $fetchingLeaves = mysqli_query($db, "
                        SELECT empname
                        FROM leaves
                        WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                        AND DATE(`from`) <= '$dateOfAttendance'
                        AND DATE(`to`) >= '$dateOfAttendance'
                        AND status = 1
                        AND status1 = 1
                    ") or die(mysqli_error($db));

                    $isLeavesAdded = mysqli_num_rows($fetchingLeaves);

                    if ($isLeavesAdded > 0) {
                        $attendanceText = '<span style="background-color:silver;color:black;">L</span>';
                    } else {
                        // Fetch attendance data for weekdays (excluding Sundays)
                        $fetchingEmployeesAttendance = mysqli_query($db, "
                            SELECT CBA.AttendanceType, E.empname
                            FROM camsbiometricattendance AS CBA
                            INNER JOIN emp AS E ON CBA.UserID = E.UserID
                            WHERE CBA.UserID = '" . $EmployeesIDsArray[$counter] . "'
                            AND DATE(CBA.AttendanceTime) = '$dateOfAttendance'
                        ") or die(mysqli_error($db));

                        $isAttendanceAdded = mysqli_num_rows($fetchingEmployeesAttendance);

                        // Store the fetched rows in an array
                        $EmployeeAttendanceArray = array();
                        while ($row = mysqli_fetch_assoc($fetchingEmployeesAttendance)) {
                            $EmployeeAttendanceArray[] = $row;
                        }

                        $absentText = '';

                        // Check for absent entries
                        $fetchingAbsent = mysqli_query($db, "
                            SELECT empname
                            FROM absent
                            WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                            AND DATE(AttendanceTime) = '$dateOfAttendance'
                        ") or die(mysqli_error($db));

                        $isAbsentAdded = mysqli_num_rows($fetchingAbsent);

                        if ($isAbsentAdded > 0) {
                            $absentText = '<span style="background-color:darkred;color:white;">Ab</span>';
                        }

                        if ($isAttendanceAdded > 0) {
                            // Display attendance data for weekdays
                            $checkInText = '';
                            $checkOutText = '';

                            foreach ($EmployeeAttendanceArray as $EmployeeAttendance) {
                                if ($EmployeeAttendance['AttendanceType'] == 'CheckIn') {
                                    $checkInText = '<span style="background-color:darkgreen;color:white;">CI</span>';
                                } elseif ($EmployeeAttendance['AttendanceType'] == 'CheckOut') {
                                    $checkOutText = '<span style="background-color:darkgreen;color:white;">CO</span>';
                                }
                            }

                            // Display attendance data for weekdays
                            if ($checkInText !== '' && $checkOutText !== '') {
                                $attendanceText .= $checkInText . ":" . $checkOutText;
                            } elseif ($checkOutText !== '') {
                                $attendanceText .= '!';
                            } elseif ($checkInText !== '') {
                                $attendanceText .= $checkInText;
                            }
                            $empName = $EmployeeAttendance['empname'];
                        }

                        // If absent, override other values
                        if ($absentText !== '') {
                            $attendanceText = $absentText;
                        }
                    }
                }

                // Set orange color for 'Sun' only in the current cell
                $tdStyle = ($dayOfWeek == 7) ? "style='background-color: orange; color: white'" : "";
                echo "<td $tdStyle>" . $attendanceText . "</td>";
            }

            $ciCoColumn = mysqli_query($db, "
                SELECT COUNT(DISTINCT DATE(AttendanceTime)) AS count
                FROM camsbiometricattendance
                WHERE UserID = '" . $EmployeesIDsArray[$counter] . "'
                AND DATE(AttendanceTime) >= '$firstDayOfMonth'
                AND DATE(AttendanceTime) <= '$lastDayOfMonth'
                AND AttendanceType = 'CheckIn'
                AND DATE(AttendanceTime) IN (
                    SELECT DATE(AttendanceTime)
                    FROM camsbiometricattendance
                    WHERE UserID = '" . $EmployeesIDsArray[$counter] . "'
                    AND DATE(AttendanceTime) >= '$firstDayOfMonth'
                    AND DATE(AttendanceTime) <= '$lastDayOfMonth'
                    AND AttendanceType = 'CheckOut'
                )
            ") or die(mysqli_error($db));

            $absentColumn = mysqli_query($db, "
                SELECT COUNT(empname) AS count
                FROM absent
                WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                AND DATE(AttendanceTime) >= '$firstDayOfMonth'
            ") or die(mysqli_error($db));

            $leavesData = mysqli_query($db, "
                SELECT `from`, `to`
                FROM leaves
                WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                AND status = 1
                AND status1 = 1
                AND (
                    (`from` BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth')
                    OR (`to` BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth')
                    OR (`from` <= '$firstDayOfMonth' AND `to` >= '$lastDayOfMonth')
                )
            ") or die(mysqli_error($db));

            // Initialize leave count
            $leaveCount = 0;
            while ($leaveEntry = mysqli_fetch_assoc($leavesData)) {
                $from = strtotime($leaveEntry['from']);
                $to = strtotime($leaveEntry['to']);

                // Calculate leave duration in days, excluding Sundays
                for ($k = 0; $k <= $to - $from; $k += 24 * 60 * 60) {
                    $currentDay = date('N', $from + $k);
                    if ($currentDay != 7 && $from + $k >= strtotime($firstDayOfMonth) && $from + $k <= strtotime($lastDayOfMonth)) {
                        $leaveCount++;
                    }
                }
            }

            $absentCount = mysqli_fetch_assoc($absentColumn)['count'];
            $ciCoCount = mysqli_fetch_assoc($ciCoColumn)['count'];

            // Calculate the number of working days in the current month
            $totalWorkingDays = $totalDaysInMonth - $sundaysCount;

            echo "<td>$ciCoCount/$totalWorkingDays</td>";
            echo "<td> $absentCount</td>";
            echo "<td>$leaveCount</td>";
            echo "</tr>";
            $counter++;
        }
    }
    ?>
</table>

<p>INDICATIONS:</p>
<p>Ab: Absent</p>
<P>CI: CheckedIn</P>
<P>CO: CheckedOut</P>
<p>L: Leave</p>
<P>!: Check  <a href="attendancelog.php" target="_blank">Attendance Log</a></P>
