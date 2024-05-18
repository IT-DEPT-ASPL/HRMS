<?php
require_once("inc/config.php");
require_once("dbconfig.php");
session_start();
if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                icon: 'error',
                title: 'Account Terminated',
                text: 'Contact HR, also check your mail for more info.',
              }).then(function() {
                window.location.href = 'loginpage.php';
              });
            });
          </script>";
    exit();
  }
  $sqlStatusCheck = "SELECT empstatus FROM emp WHERE empemail = '{$_SESSION['user_name']}'";
  $resultStatusCheck = mysqli_query($con, $sqlStatusCheck);
  $statusRow = mysqli_fetch_assoc($resultStatusCheck);
  
  if ($statusRow['empstatus'] == 0) {

    $firstDayOfMonth = date("Y-m-01");
    $totalDaysInMonth = date("t", strtotime($firstDayOfMonth));

// Fetching Employees 
$fetchingEmployees = mysqli_query($db, "SELECT * FROM emp WHERE empemail = '{$_SESSION['user_name']}'") or die(mysqli_error($db));
$totalNumberOfEmployees = mysqli_num_rows($fetchingEmployees);

$EmployeesNamesArray = array();
$EmployeesIDsArray = array();
$counter = 0;
while ($Employees = mysqli_fetch_assoc($fetchingEmployees)) {
    $EmployeesNamesArray[] = $Employees['empname'];
    $EmployeesIDsArray[] = $Employees['UserID'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/global6.css" />
    <link rel="stylesheet" href="./css/email-form.css" />
    <link rel="stylesheet" href="./css/email-form2.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" />
    <style>
        .lead{
            white-space:nowrap;
            pointer-events: none;
        }
        .udbtn:hover{
color:black !important;
background-color: white !important;
outline:1px solid #F46114;
        }
        .select {
  position: relative;
  min-width: 200px;
}
.select svg {
  position: absolute;
  right: 12px;
  top: calc(50% - 3px);
  width: 10px;
  height: 6px;
  stroke-width: 2px;
  stroke: #9098a9;
  fill: none;
  stroke-linecap: round;
  stroke-linejoin: round;
  pointer-events: none;
}
.select select {
  padding: 7px 40px 7px 12px;
  width: 100%;
  border: 1px solid #e8eaed;
  border-radius: 5px;
  background: #fff;
  box-shadow: 0 1px 3px -2px #9098a9;
  cursor: pointer;
  font-family: inherit;
  font-size: 16px;
  transition: all 150ms ease;
}
.select select:required:invalid {
  color: #5a667f;
}
.select select option {
  color: #223254;
}
.select select option[value=""][disabled] {
  display: none;
}
.select select:focus {
  outline: none;
  border-color: #07f;
  box-shadow: 0 0 0 2px rgba(0,119,255,0.2);
}
.select select:hover + svg {
  stroke: #07f;
}
.sprites {
  position: absolute;
  width: 0;
  height: 0;
  pointer-events: none;
  user-select: none;
}

    </style>
</head>

<body style="overflow:hidden;">
    <div class="emailform">
        <div class="bg1"></div>
        <img class="emailform-child" alt="" src="./public/rectangle-1@2x.png" />

        <img class="logo-1-icon1" alt="" src="./public/logo-1@2x.png" />

        <a class="anikahrm1">
            <span>Anika</span>
            <span class="hrm1">HRM</span>
        </a>
        <a class="employee-management1" id="employeeManagement">Attendance Management</a>
        <img class="uitcalender-icon1" alt="" src="./public/uitcalemnder.svg" />
        <div style="position: absolute; font-size: 15px;margin-top:110px; overflow-y:auto; height:850px;">
        <form method="post" action="">
                <table border="1" style="border-color: rgb(170, 170, 170);scale:0.9; " cellspacing="0" class="table table-bordered table-hover">
                    <?php
                    $lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth)). ' 23:59:59';
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
                            echo "<td rowspan='2'>Employee Name</td>";
                            for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                                echo "<td>$j</td>";
                            }
                            echo "<td colspan='5' style='text-align:center;'>Total</td>";
                            $currentDate = date('Y-m-d');
                            $lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth));
                            
                            if ($currentDate === $lastDayOfMonth) {
                                echo "<td rowspan='2' >Confirmed by employee</td>";
                        } else {
                            echo "";
                        }
                            echo "</tr>";
                        } else if ($i == 2) {
                            echo "<tr>";
                            for ($j = 0; $j < $totalDaysInMonth; $j++) {
                                echo "<td>" . date("D", strtotime("+$j days", strtotime($firstDayOfMonth))) . "</td>";
                            }
                            echo "<td>Absent</td>";
                            echo "<td>Leaves</td>";
                            echo "<td>Present</td>";
                            echo "<td>NWD</td>";
                            echo "<td>AP(%)</td>";
                            echo "</tr>";
                        } else {
                            echo "<tr>";
                            echo "<td>" . $EmployeesNamesArray[$counter] ."</td>";
                
                            $color = "";
                            for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                                $dateOfAttendance = date("Y-m-$j");
                    
                                // Check if the date is a holiday
                                $fetchingHoliday = mysqli_query($db, "
                                    SELECT value
                                    FROM holiday
                                    WHERE date = '$dateOfAttendance'
                                ") or die(mysqli_error($db));
                    
                                $isHoliday = mysqli_num_rows($fetchingHoliday);
                    
                                // Default value for non-holiday
                                $attendanceText = '';
                    
                             // Default value for non-holiday
                $attendanceText = '';
                
                                if ($dayOfWeek != 7) {
                                    // Check for leaves entries
                                    
                                    $fetchingLeaves = mysqli_query($db, "
                                    SELECT empname, leavetype
                                    FROM leaves
                                    WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                                    AND DATE(`from`) <= '$dateOfAttendance'
                                    AND DATE(`to`) >= '$dateOfAttendance'
                                    AND status = 1
                                    AND status1 = 1
                                ") or die(mysqli_error($db));
                                
                                $isLeavesAdded = mysqli_num_rows($fetchingLeaves);
                                
                                if ($isLeavesAdded > 0) {
                                    $leaveEntry = mysqli_fetch_assoc($fetchingLeaves);
                                    
                                    // Check the leavetype and set the attendance text accordingly
                                    if ($leaveEntry['leavetype'] == 'HALF DAY') {
                                        $attendanceText = '<span style="font-weight: 600; color:rgb(104, 104, 104); padding: 0.1em;">HDL</span>';
                                        
                                        // Fetch attendance data for weekdays (excluding Sundays)
                                        $fetchingEmployeesAttendance = mysqli_query($db, "
                                            SELECT CBA.AttendanceType, E.empname
                                            FROM CamsBiometricAttendance AS CBA
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
                                            $absentText = '<span style="font-weight: 600; color:rgb(255, 23, 23); padding: 0.1em;">Ab</span>';
                                        }
                                
                                        if ($isAttendanceAdded > 0) {
                                            // Display attendance data for weekdays
                                            $checkInText = '';
                                            $checkOutText = '';
                                
                                            foreach ($EmployeeAttendanceArray as $EmployeeAttendance) {
                                                if ($EmployeeAttendance['AttendanceType'] == 'CheckIn') {
                                                    $checkInText = '<span style="font-weight: 600; color:rgb(0, 146, 0); padding: 0.1em;">CI</span>';
                                                } elseif ($EmployeeAttendance['AttendanceType'] == 'CheckOut') {
                                                    $checkOutText = '<span style="font-weight: 600; color:rgb(0, 146, 0); padding: 0.1em;">CO</span>';
                                                }
                                            }
                                
                                            // Display attendance data for weekdays
                                            if ($checkInText !== '' && $checkOutText !== '') {
                                                $attendanceText .= $checkInText . ":" . $checkOutText;
                                            } elseif ($checkOutText !== '') {
                                                $attendanceText .= $checkOutText;
                                            } elseif ($checkInText !== '') {
                                                $attendanceText .= $checkInText;
                                            }
                                            $empName = $EmployeeAttendance['empname'];
                                        }
                                    } else {
                                        $attendanceText = '<span style="font-weight: 600; color:rgb(104, 104, 104); padding: 0.1em;">L</span>';
                                    }
                                } else {
                                        // Fetch attendance data for weekdays (excluding Sundays)
                                        $fetchingEmployeesAttendance = mysqli_query($db, "
                                            SELECT CBA.AttendanceType, E.empname
                                            FROM CamsBiometricAttendance AS CBA
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
                                            $absentText = '<span style="font-weight: 600; color:rgb(255, 23, 23); padding: 0.1em;">Ab</span>';
                                        }
                
                                        if ($isAttendanceAdded > 0) {
                                            // Display attendance data for weekdays
                                            $checkInText = '';
                                            $checkOutText = '';
                
                                            foreach ($EmployeeAttendanceArray as $EmployeeAttendance) {
                                                if ($EmployeeAttendance['AttendanceType'] == 'CheckIn') {
                                                    $checkInText = '<span style="font-weight: 600; color:rgb(0, 146, 0);">CI</span>';
                                                } elseif ($EmployeeAttendance['AttendanceType'] == 'CheckOut') {
                                                    $checkOutText = '<span style="font-weight: 600; color:rgb(0, 146, 0);">CO</span>';
                                                }
                                            }
                
                                            // Display attendance data for weekdays
                                            if ($checkInText !== '' && $checkOutText !== '') {
                                                $attendanceText .= $checkInText . " " . $checkOutText;
                                            } elseif ($checkOutText !== '') {
                                                $attendanceText .= $checkOutText;
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
                                $tdStyle = ($dayOfWeek == 7 && $isHoliday == 0) ? "style='background-color: orange; color: white'" : "";
                
                                echo "<td $tdStyle>" . $attendanceText . "</td>";
                                
                            }
                            $ciCoColumn = mysqli_query($db, "
                            SELECT COUNT(*) AS count
                            FROM (
                                SELECT DISTINCT a.AttendanceDate
                                FROM (
                                    SELECT DATE(AttendanceTime) AS AttendanceDate
                                    FROM CamsBiometricAttendance
                                    WHERE UserID = '" . $EmployeesIDsArray[$counter] . "'
                                    AND MONTH(AttendanceTime) = 1
                                    AND YEAR(AttendanceTime) = 2024
                                    AND AttendanceType = 'CheckIn'
                                ) AS a
                                JOIN (
                                    SELECT DATE(AttendanceTime) AS AttendanceDate
                                    FROM CamsBiometricAttendance
                                    WHERE UserID = '" . $EmployeesIDsArray[$counter] . "'
                                    AND MONTH(AttendanceTime) = 1
                                    AND YEAR(AttendanceTime) = 2024
                                    AND AttendanceType = 'CheckOut'
                                ) AS b ON DATEDIFF(b.AttendanceDate, a.AttendanceDate) <= 1
                            ) AS matching_pairs
                        ") or die(mysqli_error($db));
                        
                
                            $firstDayOfMonth = date("Y-m-01");
                            $lastDayOfMonth = date("Y-m-t");
                            
                            $absentColumn = mysqli_query($db, "
                                SELECT COUNT(empname) AS count
                                FROM absent
                                WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                                AND AttendanceTime >= '$firstDayOfMonth'
                                AND AttendanceTime <= '$lastDayOfMonth 23:59:59'
                            ") or die(mysqli_error($db));
                            
                
                            $leavesData = mysqli_query($db, "
                            SELECT `from`, `to`
                            FROM leaves
                            WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                            AND status = 1
                            AND status1 = 1
                            AND leavetype != 'HALF DAY'
                            AND (
                                (`from` BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth')
                                OR (`to` BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth')
                                OR (`from` <= '$firstDayOfMonth' AND `to` >= '$lastDayOfMonth')
                            )
                        ") or die(mysqli_error($db));
                        $leavesData1 = mysqli_query($db, "
                    SELECT `from`, `to`
                    FROM leaves
                    WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                    AND status = 1
                    AND status1 = 1
                    AND leavetype = 'HALF DAY'
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
                
                            $leaveCount1 = 0;
                            while ($leaveEntry = mysqli_fetch_assoc($leavesData1)) {
                                $from = strtotime($leaveEntry['from']);
                                $to = strtotime($leaveEntry['to']);
                            
                                // Calculate leave duration in days, excluding Sundays
                                for ($k = 0; $k <= $to - $from; $k += 24 * 60 * 60) {
                                    $currentDay = date('N', $from + $k);
                                    if ($currentDay != 7 && $from + $k >= strtotime($firstDayOfMonth) && $from + $k <= strtotime($lastDayOfMonth)) {
                                        $leaveCount1 += 0.5; // Increment by 0.5 for each valid leave day
                                    }
                                }
                            }
                            // Calculate the number of working days in the current month, excluding Sundays and holidays
                $totalWorkingDays = $totalDaysInMonth - $sundaysCount;
                
                $fetchingHolidays = mysqli_query($db, "
                    SELECT COUNT(DISTINCT date) AS count
                    FROM holiday
                    WHERE date >= '$firstDayOfMonth'
                    AND date <= '$lastDayOfMonth'
                ") or die(mysqli_error($db));
                
                $holidaysCount = mysqli_fetch_assoc($fetchingHolidays)['count'];
                
                            $absentCount = mysqli_fetch_assoc($absentColumn)['count'];
                            $ciCoCount = mysqli_fetch_assoc($ciCoColumn)['count'];
                        
                            // Calculate the number of working days in the current month
                            $ciCoCount= $ciCoCount-$leaveCount1;
                            $totalleavesCount = $leaveCount+$leaveCount1 ;
                            $ciCoCount1 = $ciCoCount;
                            $totalWorkingDays = $totalDaysInMonth;
                            $attendancePercentage = ($ciCoCount1 / $totalWorkingDays) * 100;
                          
                            echo "<td style='background-color:rgb(200, 10, 25);color:white;text-align:center;'> $absentCount</td>";
                            echo "<td style='background-color:silver;color:black;text-align:center;'>$totalleavesCount</td>";
                            echo "<td style='background-color:rgb(40, 200, 85);color:black;text-align:center;'>$ciCoCount</td>";
                            echo "<td style='background-color:rgb(1, 100, 255);color:white;text-align:center;'>$ciCoCount1/$totalWorkingDays</td>";
                            echo "<td style='background-color:rgb(1, 100, 255);color:white;text-align:center;'>" . round($attendancePercentage, 2) . "%</td>";
                            $caRecord = mysqli_query($db, "
                            SELECT COUNT(empname) AS count
                            FROM CA
                            WHERE empname = '" . $EmployeesNamesArray[$counter] . "'
                            AND submissionTime >= '$firstDayOfMonth'
                            AND submissionTime <= '$lastDayOfMonth 23:59:59'
                        ") or die(mysqli_error($db));
                        
                        
                
                        $caCount = mysqli_fetch_assoc($caRecord)['count'];
                            $confirmedText = ($caCount > 0) ? 'Yes' : '';
                         
                            $currentDate = date('Y-m-d');
                            $lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth));
                            
                            if ($currentDate === $lastDayOfMonth) {
                            echo "<td style='background-color: lightgreen;text-align:center;'>$confirmedText</td>";
                        } else {
                            echo "";
                            
                        }  
                        
                
                            echo "</tr>";
                            $counter++;
                        }
                    }
                    ?>
                    <tr>
                            <td colspan="<?php echo $totalDaysInMonth + 7; ?>">
                            <?php
                $currentDate = date('Y-m-d');
                $lastDayOfMonth = date('Y-m-t', strtotime($firstDayOfMonth));
                
                if ($currentDate === $lastDayOfMonth) {
                    echo "<a href='javascript:void(0);' onclick='confirmAttendance()'>Confirm</a>";
                } else {
                    echo "";
                }   
                ?>
                            <!--<a class="btn udbtn" style="background-color: #FB8A0B;color:white;" href='javascript:void(0);' onclick='downloadAndUpload()'>Upload</a>-->
                            <a class="btn udbtn" style="background-color: #FB8A0B;color:white;" href="print-details3.php" target="_blank" >Download</a>
                            </td>
                        </tr>
                </table>
                </form>
                <div style="display: flex; gap: 10px; margin-left:100px;">
                <p class="h5" style="color:black;margin-top:8px;">INDICATIONS:</p>
                <p class="lead btn btn-outline-danger">Ab: Absent</p>
                <a style="text-decoration: none; color: inherit;" href="attendancelog.php" target="_blank"> <P class=" btn" style="outline:1px solid #FB8A0B;color:#F46114"><img style="margin-bottom:4px;" src="https://upload.wikimedia.org/wikipedia/commons/archive/3/3b/20180610093750%21OOjs_UI_icon_alert-warning.svg">: Check Attendance Log</P></a>
                <p class="lead btn btn-outline-secondary">L: Leave</p>
                <p class="lead btn btn-outline-secondary">HDL: Half Day Leave</p>
                <P class="lead btn btn-outline-success">CI: CheckedIn</P>
                <P class="lead btn btn-outline-success">CO: CheckedOut</P>
                <p class="lead btn btn-outline-primary">NWD: Net Working Days</p>
                <p class="lead btn btn-outline-primary">AP: Attendance Percentage</p>
                </div>

        </div>
    </div>

</body>
<script>
    function updateIframeSource() {
        const pdfSelector = document.getElementById('pdfSelector');
        const selectedPdf = pdfSelector.value;

        const pdfContainer = document.getElementById('pdfContainer');
        const pdfTitle = document.getElementById('pdfTitle');
        const downloadLink = document.getElementById('downloadLink');
        const pdfIframe = document.getElementById('pdfIframe');

        if (selectedPdf) {
            pdfContainer.style.display = 'block';
            pdfTitle.textContent = `Attendance Sheet: ${selectedPdf}`;
            const pdfPath = `attendencepdf/${selectedPdf}`;
            pdfIframe.src = `${pdfPath}#toolbar=0`;
            downloadLink.href = pdfPath;
            downloadLink.style.display = 'block';
        } else {
            pdfContainer.style.display = 'none';
            pdfTitle.textContent = '';
            pdfIframe.src = '';
            downloadLink.href = '';
            downloadLink.style.display = 'none';
        }
    }
</script>
<script>
    function confirmAttendance() {
        // Get the values to be sent to the server
        var empEmail = '<?php echo $_SESSION['user_name']; ?>';
        var empName = '<?php echo $EmployeesNamesArray[0]; ?>'; // Assuming there is only one employee for simplicity
        var submissionTime = new Date().toISOString().slice(0, 19).replace("T", " "); // Format date as string

        // Send an AJAX request to the server to update the 'CA' table
        $.ajax({
            type: "POST",
            url: "update_ca_table.php",
            data: {
                empEmail: empEmail,
                empName: empName,
                submissionTime: submissionTime
            },
            success: function (response) {
                // Log the response to the console for debugging
                console.log(response);

                // Handle the response from the server using SweetAlert2
                if (response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Attendance confirmed successfully!',
                    }).then(function() {
                        // Redirect to sheet_emp.php after the user clicks "OK"
                        window.location = 'sheet_emp.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to confirm attendance.',
                        text: 'Please try again.',
                    });
                }
            },
            error: function (xhr, status, error) {
                // Log any AJAX errors to the console for debugging
                console.error(xhr.responseText);
            }
        });
    }
</script>
</html>
<?php
} else {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              icon: 'error',
              title: 'Account Terminated',
              text: 'Contact HR, also check your mail for more info.',
            }).then(function() {
              window.location.href = 'loginpage.php';
            });
          });
        </script>";
  exit();
}
?>