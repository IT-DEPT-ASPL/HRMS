<?php
session_start();
@include 'inc/config.php';

if (empty($_SESSION['user_name']) && empty($_SESSION['name'])) {
  header('location:loginpage.php');
  exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
if (empty($user_name)) {
  header('location:loginpage.php');
  exit();
}
$query = "SELECT uf.*, m.status as manager_status 
              FROM user_form uf
              LEFT JOIN manager m ON uf.email = m.email 
              WHERE uf.email = '$user_name'";
$result = mysqli_query($con, $query);

if ($result) {
  $row = mysqli_fetch_assoc($result);

  if ($row && isset($row['user_type'])) {
    $user_type = $row['user_type'];

    if ($user_type !== 'admin' && $user_type !== 'user') {
      header('location:loginpage.php');
      exit();
    }
    if ($user_type === 'user' && empty($row['manager_status'])) {
      header('location:loginpage.php');
      exit();
    }
  } else {
    die("Error: Unable to fetch user details.");
  }
} else {
  die("Error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />

  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/attendence.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
    table {
      z-index: 100;
      border-collapse: collapse;
      background-color: white;
    }

    th,
    td {
      padding: 1em;
      border-bottom: 2px solid rgb(193, 193, 193);
    }

    .even {
      border-bottom: 2px solid #e8e8e8ba;
    }

    .odd {
      background-color: #e9e9e9 !important;
    }

    .dropbtn {
      background-color: #45C380;
      color: #ffffff;
      padding: 16px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px #45C380;
    }


    .dropdown-content {
      position: absolute;
      background-color: #f9f9f9;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 98;
      max-height: 0;
      min-width: 160px;
      transition: max-height 0.15s ease-out;
      overflow: hidden;
    }

    .dropdown-content a {
      color: black;
      background-color: #f9f9f9;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #e2e2e2;
    }

    .dropdown:hover .dropdown-content {
      max-height: 500px;
      min-width: 160px;
      transition: max-height 0.25s ease-in;
    }

    .dropdown:hover .dropbtn {
      /* background-color: #f9f9f9;
  border-bottom: 1px solid #e0e0e0; */
      transition: max-height 0.25s ease-in;
    }
  </style>
  <script>
    function checkForUpdates() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            try {
              var response = JSON.parse(xhr.responseText.replace(/(['"])?([a-zA-Z0-9_]+)(['"])?:/g, '"$2":'));

              console.log(response);

              if (response && response.hasUpdates) {
                console.log('Reloading page...');
                // Reload the page if updates are found
                location.reload();
              }
            } catch (error) {
              console.error('Error parsing JSON response. Raw response:', xhr.responseText);
              console.error('Error details:', error);
            }
          } else {
            console.error('Error in AJAX request. Status:', xhr.status);
          }
        }
      };

      xhr.open("GET", "getattendence.php", true);
      xhr.send();
    }

    setInterval(checkForUpdates, 1000);
  </script>
</head>

<body>
  <div class="attendence4">
    <div class="bg14"></div>
    <div class="rectangle-parent22" style="margin-left:260px;">
      <div class="frame-child187"></div>
      <div class="dropdown">
        <button class="attendence5" style="margin-left: -300px; border: none; background: none; margin-top: -14px;" for="btnControl"><img src="./public/9710841.png" width="50px" alt="">
          <div class="dropdown-content" style="margin-left: -40px; border-radius: 20px;">
            <a href="sheet_mgr.php" style="border-bottom: 1px solid rgb(185, 185, 185);">Overall Attendance</a>
            <?php
            $manager_query = "SELECT desg FROM manager WHERE email = '$user_name'";
            $manager_result = mysqli_query($con, $manager_query);

            $manager_designations = array();

            while ($row = mysqli_fetch_assoc($manager_result)) {
              $designations = array_map('trim', explode(',', $row['desg']));
              $manager_designations = array_merge($manager_designations, $designations);
            }
            $manager_designations = array_unique(array_filter($manager_designations));
            if (in_array('SECURITY GAURDS', $manager_designations)) {
              $inClause = implode("','", $manager_designations);
              $sql = "SELECT empname FROM emp WHERE emp.desg IN ('$inClause')";

              $result = mysqli_query($con, $sql);

              if (mysqli_num_rows($result) > 0) {
                echo '<a href="sheet_gaurd_mgr.php">Overall Attendance(SG)</a>';
              }
            } else {
              echo '';
            }
            ?>

          </div>
        </button>
      </div>
      <a class="frame-child188" style="margin-left: -150px;"> </a>
      <a class="frame-child189" style="margin-left: -150px;" id="rectangleLink1"> </a>
      <a href="" class="frame-child190" style="margin-left: -150px;" id="rectangleLink2"> </a>
      <a class="attendence5" style="margin-left: -150px;">Attendance</a>
      <a class="records5" href="attendancelog_mgr.php" id="records" style="margin-left: -180px; width:200px;">Attendance Log</a>
      <a class="punch-inout4" href="" id="punchINOUT" style="margin-left: -169px; width:250px;">Remote Attendance</a>
    </div>
    <div class="rectangle-parent23" style="overflow-y:auto;">
      <?php
      $manager_query = "SELECT desg FROM manager WHERE email = '$user_name'";
      $manager_result = mysqli_query($con, $manager_query);

      if ($manager_result) {
        $manager_designations = array();

        while ($row = mysqli_fetch_assoc($manager_result)) {
          $designations = array_map('trim', explode(',', $row['desg']));
          $manager_designations = array_merge($manager_designations, $designations);
        }
        $manager_designations = array_unique(array_filter($manager_designations));

        if (!empty($manager_designations)) {
          $inClause = implode("','", $manager_designations);
          $employee_query = "SELECT emp.emp_no, emp.empname, emp.pic, emp.dept, CamsBiometricAttendance.*
          FROM emp
          INNER JOIN CamsBiometricAttendance ON emp.UserID = CamsBiometricAttendance.UserID
          WHERE emp.desg IN ('$inClause') 
          ORDER BY CamsBiometricAttendance.AttendanceTime DESC";


          $employee_result = mysqli_query($con, $employee_query);
          $cnt = 1;
      ?>

          <table class="data" style="margin-left: auto; margin-right:auto;">
            <tr>
              <th>Date</th>
              <th style="border-left: 2px solid rgb(182, 182, 182);"></th>
              <th>Employee Name</th>
              <th colspan="2" style="white-space:nowrap; border-left: 2px solid rgb(182, 182, 182);">In Time <span style="margin-left:110px;"> -</span><span style="margin-left:50px;"> Input Type</span></th>
              <th colspan="2" style="white-space:nowrap;border-left: 2px solid rgb(182, 182, 182);">Out Time <span style="margin-left:70px;"> -</span><span style="margin-left:30px;"> Input Type</span></th>
            </tr>
            <?php
            $userCheckOut = array();
            $prevDay = null;

            while ($result = mysqli_fetch_assoc($employee_result)) {
              $userId = $result['UserID'];
              $dayOfMonth = date('j', strtotime($result['AttendanceTime']));
              $formattedDate = date('D j M', strtotime($result['AttendanceTime']));
              $rowColorClass = ($dayOfMonth % 2 == 0) ? 'even' : 'odd';

              if ($result['AttendanceType'] == 'CheckOut') {
                $userCheckOut[$userId] = array(
                  'AttendanceTime' => $result['AttendanceTime'],
                  'InputType' => $result['InputType'],
                  'Department' => $result['dept']
                );
              } elseif ($result['AttendanceType'] == 'CheckIn') {
                $currentDay = date('j', strtotime($result['AttendanceTime']));
                $borderBottom = ($prevDay !== null && $currentDay !== $prevDay) ? 'border-top: 4px solid #FB8B0B;' : '';

                $inTimeColor = (strtotime($result['AttendanceTime']) > strtotime('9:40 AM', strtotime($result['AttendanceTime']))) ? 'color: red !important;' : 'color: green !important;';

                $outTimeColors = isset($userCheckOut[$userId]) ? getColorForCheckOut($userCheckOut[$userId]) : array('color: red !important;', 'color: red !important;');
                $outTimeColor = $outTimeColors[0];

            ?>
                <tr class="<?php echo $rowColorClass; ?>" style="<?php echo $borderBottom; ?>">
                  <td style="white-space:nowrap;"><?php echo $formattedDate; ?></td>
                  <td style="border-left: 2px solid rgb(182, 182, 182);"><img class="hovpic" src="pics/<?php echo $result['pic']; ?>" width="40px" height="40px" style="border-radius: 50px; border: 0.5px solid rgb(161, 161, 161);"></td>
                  <td><?php echo $result['empname']; ?></td>

                  <td style="border-left: 2px solid rgb(182, 182, 182); <?php echo $inTimeColor; ?>">
                    <?php echo $result['AttendanceTime']; ?>
                  </td>
                  <td>
                    <?php echo $result['InputType']; ?>
                  </td>
                  <td style="border-left: 2px solid rgb(182, 182, 182); <?php echo $outTimeColor; ?>">
                    <?php
                    if (isset($userCheckOut[$userId])) {
                      echo $userCheckOut[$userId]['AttendanceTime'];
                    } else {
                      echo '<span style="color: red !important;">Yet to Check Out!</span>';
                    }
                    ?>
                  </td>
                  <td>
                    <?php
                    if (isset($userCheckOut[$userId])) {
                      echo $userCheckOut[$userId]['InputType'];
                    } else {
                      echo '<span style="color: red !important;">Yet to Check Out!</span>';
                    }
                    ?>
                  </td>
                </tr>
            <?php

                $prevDay = $currentDay;
              }
              $cnt++;
            }
            ?>
          </table>
      <?php
        } else {
          die("Error: No valid designations found for the manager.");
        }
      } else {
        die("Error: " . mysqli_error($con));
      }
      ?>
      <?php
      function getColorForCheckOut($checkOutInfo)
      {
        $outTimeColor = 'color: red !important;';
        $outTimeColor1 = 'color: green !important;';

        if ($checkOutInfo['Department'] == 'HOUSE KEEPING' || $checkOutInfo['Department'] == 'KITCHEN') {
          // Check if the time is beyond 5:30 PM
          if (strtotime($checkOutInfo['AttendanceTime']) >= strtotime('5:30 PM', strtotime($checkOutInfo['AttendanceTime']))) {
            $outTimeColor = 'color: green !important;';
          } else {
            $outTimeColor1 = 'color: red !important;';
          }
        } else {
          // For other departments, check if the time is beyond 6:00 PM
          if (strtotime($checkOutInfo['AttendanceTime']) >= strtotime('6:00 PM', strtotime($checkOutInfo['AttendanceTime']))) {
            $outTimeColor = 'color: green !important;';
          } else {
            $outTimeColor1 = 'color: red !important;';
          }
        }

        // Return both colors as an array
        return array($outTimeColor, $outTimeColor1);
      }
      ?>



    </div>
    <img class="attendence-child" alt="" src="./public/rectangle-1@2x.png" />

    <img class="attendence-item" alt="" src="./public/rectangle-2@2x.png" />

    <img class="logo-1-icon14" alt="" src="./public/logo-1@2x.png" />

    <a class="anikahrm14" href="./index.php" id="anikaHRM">
      <span>Anika</span>
      <span class="hrm14">HRM</span>
    </a>
    <a class="attendence-management4" href="./index.php" id="attendenceManagement">Attendance Management</a>
    <button class="attendence-inner"><a href="logout.php" style="color:white; text-decoration:none; font-size:25px; margin-left:20px;">Logout</a></button>
    <!-- <div class="payroll14">Payroll</div>
      <div class="reports14">Reports</div>
      <img class="uitcalender-icon14" alt="" src="./public/uitcalender.svg" />

      <img
        class="arcticonsgoogle-pay14"
        alt=""
        src="./public/arcticonsgooglepay.svg"
      />

      <img
        class="streamlineinterface-content-c-icon14"
        alt=""
        src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg"
      /> -->

    <!--<img class="attendence-child1" alt="" src="./public/ellipse-1@2x.png" />-->

    <!--<img-->
    <!--  class="material-symbolsperson-icon14"-->
    <!--  alt=""-->
    <!--  src="./public/materialsymbolsperson.svg"-->
    <!--/>-->

    <img class="attendence-child2" style="margin-top: -50px;" alt="" src="./public/rectangle-4@2x.png" />

    <a class="dashboard14" href="./index.php" id="dashboard">Dashboard</a>
    <a class="fluentpeople-32-regular14" id="fluentpeople32Regular">
      <img class="vector-icon73" alt="" src="./public/vector7.svg" />
    </a>
    <a class="employee-list14" id="employeeList">Employee List</a>
    <a class="akar-iconsdashboard14" href="./index.php" id="akarIconsdashboard">
      <img class="vector-icon74" alt="" src="./public/vector3.svg" />
    </a>
    <img class="tablerlogout-icon14" alt="" src="./public/tablerlogout.svg" />

    <a class="leaves14" id="leaves">Leaves</a>
    <a class="fluentperson-clock-20-regular14" id="fluentpersonClock20Regular">
      <img class="vector-icon75" alt="" src="./public/vector1.svg" />
    </a>
    <!-- <a class="onboarding16" id="onboarding">Onboarding</a> -->
    <!-- <a class="fluent-mdl2leave-user14" id="fluentMdl2leaveUser">
        <img class="vector-icon76" alt="" src="./public/vector.svg" />
      </a> -->
    <a class="attendance14" style="margin-top: -50px;">Attendance</a>
    <a class="uitcalender14" style="margin-top: -50px;">
      <img class="vector-icon77" alt="" src="./public/vector11.svg" />
    </a>
    <div class="oouinext-ltr3"></div>
  </div>

  <script>
    var rectangleLink1 = document.getElementById("rectangleLink1");
    if (rectangleLink1) {
      rectangleLink1.addEventListener("click", function(e) {
        window.location.href = "./punch-i-n.php";
      });
    }

    var rectangleLink2 = document.getElementById("rectangleLink2");
    if (rectangleLink2) {
      rectangleLink2.addEventListener("click", function(e) {
        window.location.href = "./punch-i-n.php";
      });
    }

    var rectangleLink3 = document.getElementById("rectangleLink3");
    if (rectangleLink3) {
      rectangleLink3.addEventListener("click", function(e) {
        window.location.href = "./my-attendence.php";
      });
    }

    var records = document.getElementById("records");
    if (records) {
      records.addEventListener("click", function(e) {
        window.location.href = "./punch-i-n.php";
      });
    }

    var punchINOUT = document.getElementById("punchINOUT");
    if (punchINOUT) {
      punchINOUT.addEventListener("click", function(e) {
        window.location.href = "./punchout.php";
      });
    }

    var myAttendence = document.getElementById("myAttendence");
    if (myAttendence) {
      myAttendence.addEventListener("click", function(e) {
        window.location.href = "./my-attendence.php";
      });
    }

    var anikaHRM = document.getElementById("anikaHRM");
    if (anikaHRM) {
      anikaHRM.addEventListener("click", function(e) {
        window.location.href = "./index.php";
      });
    }

    var attendenceManagement = document.getElementById("attendenceManagement");
    if (attendenceManagement) {
      attendenceManagement.addEventListener("click", function(e) {
        window.location.href = "./index.php";
      });
    }

    var dashboard = document.getElementById("dashboard");
    if (dashboard) {
      dashboard.addEventListener("click", function(e) {
        window.location.href = "./index.php";
      });
    }

    var fluentpeople32Regular = document.getElementById("fluentpeople32Regular");
    if (fluentpeople32Regular) {
      fluentpeople32Regular.addEventListener("click", function(e) {
        window.location.href = "./employee-management_mgr.php";
      });
    }

    var employeeList = document.getElementById("employeeList");
    if (employeeList) {
      employeeList.addEventListener("click", function(e) {
        window.location.href = "./employee-management_mgr.php";
      });
    }

    var akarIconsdashboard = document.getElementById("akarIconsdashboard");
    if (akarIconsdashboard) {
      akarIconsdashboard.addEventListener("click", function(e) {
        window.location.href = "./index.php";
      });
    }

    var leaves = document.getElementById("leaves");
    if (leaves) {
      leaves.addEventListener("click", function(e) {
        window.location.href = "./leave-management_mgr.php";
      });
    }

    var fluentpersonClock20Regular = document.getElementById(
      "fluentpersonClock20Regular"
    );
    if (fluentpersonClock20Regular) {
      fluentpersonClock20Regular.addEventListener("click", function(e) {
        window.location.href = "./leave-management_mgr.php";
      });
    }

    var onboarding = document.getElementById("onboarding");
    if (onboarding) {
      onboarding.addEventListener("click", function(e) {
        window.location.href = "./onboarding.php";
      });
    }

    var fluentMdl2leaveUser = document.getElementById("fluentMdl2leaveUser");
    if (fluentMdl2leaveUser) {
      fluentMdl2leaveUser.addEventListener("click", function(e) {
        window.location.href = "./onboarding.php";
      });
    }
  </script>
</body>

</html>