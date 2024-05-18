<?php
session_start();
@include 'inc/config.php';
$currentDate = date("Y-m-d");
if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
    header('location:loginpage.php');
    exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
if ($user_name === '') {
    header('location:loginpage.php');
    exit();
}

$query = "SELECT user_type FROM user_form WHERE email = '$user_name'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    if ($row && isset($row['user_type'])) {
        $user_type = $row['user_type'];
        
        if ($user_type !== 'admin') {
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
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" />
  <style>
          .dropbtn {
  background-color: #ffe2c6;
  color: #ff5400;
  padding: 16px;
  font-size: 16px;    
  border: none;
  cursor: pointer;
  min-width: 160px;
  /* box-shadow: 0px 8px 16px 0px #ffe2c6; */
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  position: absolute;
  background-color: #f9f9f9;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 99999;
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
.digital-watch .hour,
.digital-watch .minute,
.digital-watch .second {
	position: relative;
	display: inline-block;
	/* margin: 30px; */
	font-size: 0;
}
.digital-watch .hour::before,
.digital-watch .hour::after,
.digital-watch .minute::before,
.digital-watch .minute::after {
	content: '';
	position: absolute;
	right: -9px;
	width: 6px;
	height: 6px;
	background-color: #ffa048;
}
.digital-watch .hour::before,
.digital-watch .minute::before {
	top:10px;
}
.digital-watch .hour::after,
.digital-watch .minute::after {
	top: 25px;
}
.digital-watch svg {
	display: inline-block;
	margin: 6px;
}
.digital-watch svg .segment {
	fill: rgba(0, 0, 0, 0.027);
	transition: .3s ease-in-out;
}
.digital-watch svg.num-1 .b,
.digital-watch svg.num-1 .c,

.digital-watch svg.num-2 .a,
.digital-watch svg.num-2 .b,
.digital-watch svg.num-2 .d,
.digital-watch svg.num-2 .e,
.digital-watch svg.num-2 .g,

.digital-watch svg.num-3 .a,
.digital-watch svg.num-3 .b,
.digital-watch svg.num-3 .c,
.digital-watch svg.num-3 .d,
.digital-watch svg.num-3 .g,

.digital-watch svg.num-4 .b,
.digital-watch svg.num-4 .c,
.digital-watch svg.num-4 .f,
.digital-watch svg.num-4 .g,

.digital-watch svg.num-5 .a,
.digital-watch svg.num-5 .c,
.digital-watch svg.num-5 .d,
.digital-watch svg.num-5 .f,
.digital-watch svg.num-5 .g,

.digital-watch svg.num-6 .a,
.digital-watch svg.num-6 .c,
.digital-watch svg.num-6 .d,
.digital-watch svg.num-6 .e,
.digital-watch svg.num-6 .f,
.digital-watch svg.num-6 .g,

.digital-watch svg.num-7 .a,
.digital-watch svg.num-7 .b,
.digital-watch svg.num-7 .c,

.digital-watch svg.num-8 .a,
.digital-watch svg.num-8 .b,
.digital-watch svg.num-8 .c,
.digital-watch svg.num-8 .d,
.digital-watch svg.num-8 .e,
.digital-watch svg.num-8 .f,
.digital-watch svg.num-8 .g,

.digital-watch svg.num-9 .a,
.digital-watch svg.num-9 .b,
.digital-watch svg.num-9 .c,
.digital-watch svg.num-9 .d,
.digital-watch svg.num-9 .f,
.digital-watch svg.num-9 .g,

.digital-watch svg.num-0 .a,
.digital-watch svg.num-0 .b,
.digital-watch svg.num-0 .c,
.digital-watch svg.num-0 .d,
.digital-watch svg.num-0 .e,
.digital-watch svg.num-0 .f {
	fill: #ff5400;
}
  </style>
    <script>
    function checkForUpdates() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
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
    <div class="index1">
      <div class="bg18"></div>
      <img class="index-child" alt="" src="./public/rectangle-11@2x.png" />

      <img class="index-item" alt="" src="./public/rectangle-21@2x.png" />

      <img class="logo-1-icon18" alt="" src="./public/logo-1@2x.png" />
      <a class="anikahrm18">
        <span>Anika</span>
        <span class="hrm18">HRM</span>
      </a>
      <h5 class="hr-management">HR Management</h5>
      
      <a href="logout.php"><button class="index-inner"></button>
      <div class="logout18">Logout</div></a>
      <a class="employee-list18" id="employeeList">Employee List</a>
      <a class="leaves18" id="leaves">Leaves</a>
      <a class="onboarding22" id="onboarding" href="./onboarding.php">Onboarding</a>
      <a class="attendance18" id="attendance">Attendance</a>
      <div class="payroll18">Payroll</div>
      <div class="reports18">Reports</div>
      <a class="fluentpeople-32-regular18" id="fluentpeople32Regular">
        <img class="vector-icon94" alt="" src="./public/vector7.svg" />
      </a>
      <a class="fluent-mdl2leave-user18" id="fluentMdl2leaveUser">
        <img class="vector-icon95" alt="" src="./public/vector.svg" />
      </a>
      <a
        class="fluentperson-clock-20-regular18"
        id="fluentpersonClock20Regular"
      >
        <img class="vector-icon96" alt="" src="./public/vector1.svg" />
      </a>
      <a class="uitcalender18" id="uitcalender">
        <img class="vector-icon97" alt="" src="./public/vector4.svg" />
      </a>
      <img
        class="arcticonsgoogle-pay18"
        alt=""
        src="./public/arcticonsgooglepay.svg"
      />

      <img
        class="streamlineinterface-content-c-icon18"
        alt=""
        src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg"
      />

      <img class="index-child2" alt="" src="./public/rectangle-4@2x.png" />

      <a class="dashboard18">Dashboard</a>
      <a class="akar-iconsdashboard18">
        <img class="vector-icon98" alt="" src="./public/vector14.svg" />
      </a>
      <div class="index-child3"></div>
      <div>
      <?php
    @include 'inc/config.php';
     
  $sql1 = "SELECT COUNT(*) as count
  FROM emp e
  JOIN CamsBiometricAttendance c ON e.UserID = c.UserID
  WHERE DATE(AttendanceTime) = '$currentDate' 
    AND AttendanceType = 'CheckIn'
    AND NOT EXISTS (
        SELECT 1
        FROM CamsBiometricAttendance co
        WHERE co.UserID = c.UserID
          AND DATE(co.AttendanceTime) = DATE(c.AttendanceTime)
          AND co.AttendanceType = 'CheckOut'
          AND co.AttendanceTime > c.AttendanceTime
    )";

      $result1 = $con->query($sql1);
    $row1 = $result1->fetch_assoc();
    $count1 = $row1['count'];
    $sql2 = "SELECT COUNT(*) as count FROM emp e
        JOIN leaves l ON e.empname = l.empname 
        WHERE l.status = 1 AND l.status1 = 1 AND '$currentDate'   BETWEEN DATE(l.from) AND DATE(l.to)";

    $result2 = $con->query($sql2);
    $row2 = $result2->fetch_assoc();
    $count2 = $row2['count'];


$sql3 = "SELECT COUNT(*) as count FROM absent a
        JOIN emp e ON a.empname = e.empname
        WHERE TIMESTAMP(DATE(AttendanceTime)) = '$currentDate'";


    $result3 = $con->query($sql3);
    $row3 = $result3->fetch_assoc();
    $count3 = $row3['count'];

    $sql4 = "SELECT COUNT(*) as count FROM emp";

    $result4 = $con->query($sql4);
    $row4 = $result4->fetch_assoc();
    $count4 = $row4['count'];
    
$sql5 = "SELECT COUNT(*) as count
  FROM emp e
  WHERE NOT EXISTS (
      SELECT 1
      FROM CamsBiometricAttendance c
      WHERE e.UserID = c.UserID
        AND DATE(c.AttendanceTime) = '$currentDate'
        AND c.AttendanceType = 'CheckIn'
  )
  AND e.UserID NOT IN (
      SELECT e.UserID
      FROM emp e
      JOIN leaves l ON e.empname = l.empname 
      WHERE l.status = 1 AND l.status1 = 1 AND '$currentDate' BETWEEN DATE(l.from) AND DATE(l.to)
      
      UNION
      
      SELECT e.UserID
      FROM absent a
      JOIN emp e ON a.empname = e.empname
      WHERE TIMESTAMP(DATE(AttendanceTime)) = '$currentDate'
  )";


  $result5 = $con->query($sql5);
  $row5 = $result5->fetch_assoc();
  $count5 = $row5['count'];
    ?>
   <div class="rectangle-parent" style="position: absolute; right: 380px;">
      <!-- <a class="frame-child"> </a>
      <a class="quick-access">Quick Access</a> -->
      <div class="dropdown" style="z-index:99999; margin-left: 120px;" >
        <button style="border-radius: 10px;" class="dropbtn" for="btnControl"><span style='font-weight:500; margin-left:15px; font-size:18px;'>Quick Access</span></button>
        <img src="./public/mdithunder1.png" width="15px" style='margin-top:-38px; margin-left:15px;'/>
        <div class="dropdown-content" style="border-radius: 10px; width: 200px; margin-left: -20px;">
          <div style="display: flex; gap: 5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">
            <div style="background-color: #ebecf0; width: 40px; height: 40px; border-radius: 5px; margin-left: 7px; margin-top: 7px; margin-bottom: 5px;">
              <img style="margin-left: 7px; margin-top: 7px;" src="./public/maillog-removebg-preview.png" width="25px" alt="">
            </div >
          <a href="maillog.php" style="font-size: 16px; margin-top: 6px;">Mail Log</a>
          </div>
          <div style="display: flex; gap: 5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">
            <div style="background-color: #ebecf0; width: 40px; height: 40px; border-radius: 5px; margin-left: 7px; margin-top: 7px;  margin-bottom: 5px;">
              <img style="margin-left: 7px; margin-top: 7px;" src="./public/desig.png" width="25px" alt="">
            </div>
          <a href="designation.php" style="font-size: 16px; margin-top: 6px;">Designation</a>
          </div>
          <div style="display: flex; gap: 5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">
            <div style="background-color: #ebecf0; width: 40px; height: 40px; border-radius: 5px; margin-left: 7px; margin-top: 7px;  margin-bottom: 5px;">
              <img style="margin-left: 7px; margin-top: 7px;" src="./public/markabsent.png" width="25px" alt="">
            </div>
          <a href="markabsent.php" style="font-size: 16px; margin-top: 6px;">Mark Absent</a>
          </div>
          <div style="display: flex; gap: 5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">
            <div style="background-color: #ebecf0; width: 40px; height: 40px; border-radius: 5px; margin-left: 7px; margin-top: 7px;  margin-bottom: 5px;">
              <img style="margin-left: 7px; margin-top: 7px;" src="./public/doc.png" width="25px" alt="">
            </div>
          <a href="documents.php" style="font-size: 16px; margin-top: 6px;">Documents</a>
          </div>
          <div style="display: flex; gap: 5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">
            <div style="background-color: #ebecf0; width: 40px; height: 40px; border-radius: 5px; margin-left: 7px; margin-top: 7px;  margin-bottom: 5px;">
              <img style="margin-left: 5px; margin-top: 5px;" src="./public/users-removebg-preview.png" width="30px" alt="">
            </div>
          <a href="users.php" style="font-size: 16px; margin-top: 6px;">Users</a>
          </div>
          <div style="display: flex; gap: 5px;  margin-bottom: 5px;">
            <div style="background-color: #ebecf0; width: 40px; height: 40px; border-radius: 5px; margin-left: 7px; margin-top: 7px; ">
              <img style="margin-left: 7px; margin-top: 7px;" src="./public/fingerprint_preview-removebg-preview.png" width="25px" alt="">
            </div>
          <a href="map.php" style="font-size: 16px; margin-top: 6px;">Map Biometric</a>
          </div>
      </div>
    </div>
     
    </div>
    <div style="top: 12px; position: absolute; right: 20px; background-color: #ffe2c6; border-radius: 10px; ">
      <div class="digital-watch" style="margin-left:-20px;">
        <svg width="0" height="0" viewBox="0 0 0 0">
          <defs>
            <g id="unit-h">
              <path d="M0 20 L20 40 L180 40 L200 20 L180 0 L20 0 Z"></path>
            </g>
            <g id="unit-v">
              <path d="M20 0 L0 20 L0 180 L20 200 L40 180 L40 20 Z"></path>
            </g>
          </defs>
        </svg>
        <div class="hour">
          <svg id="hour-1" class="num-0" width="20" height="30" viewBox="0 0 260 480">
            <use xlink:href="#unit-h" class="segment a" x="30" y="0"></use>
            <use xlink:href="#unit-v" class="segment b" x="220" y="30"></use>
            <use xlink:href="#unit-v" class="segment c" x="220" y="250"></use>
            <use xlink:href="#unit-h" class="segment d" x="30" y="440"></use>
            <use xlink:href="#unit-v" class="segment e" x="0" y="250"></use>
            <use xlink:href="#unit-v" class="segment f" x="0" y="30"></use>
            <use xlink:href="#unit-h" class="segment g" x="30" y="220"></use>
          </svg>
          <svg id="hour-2" class="num-0" width="20" height="30" viewBox="0 0 260 480">
            <use xlink:href="#unit-h" class="segment a" x="30" y="0"></use>
            <use xlink:href="#unit-v" class="segment b" x="220" y="30"></use>
            <use xlink:href="#unit-v" class="segment c" x="220" y="250"></use>
            <use xlink:href="#unit-h" class="segment d" x="30" y="440"></use>
            <use xlink:href="#unit-v" class="segment e" x="0" y="250"></use>
            <use xlink:href="#unit-v" class="segment f" x="0" y="30"></use>
            <use xlink:href="#unit-h" class="segment g" x="30" y="220"></use>
          </svg>
        </div>
        <div class="minute">
          <svg id="minute-1" class="num-0" width="20" height="30" viewBox="0 0 260 480">
            <use xlink:href="#unit-h" class="segment a" x="30" y="0"></use>
            <use xlink:href="#unit-v" class="segment b" x="220" y="30"></use>
            <use xlink:href="#unit-v" class="segment c" x="220" y="250"></use>
            <use xlink:href="#unit-h" class="segment d" x="30" y="440"></use>
            <use xlink:href="#unit-v" class="segment e" x="0" y="250"></use>
            <use xlink:href="#unit-v" class="segment f" x="0" y="30"></use>
            <use xlink:href="#unit-h" class="segment g" x="30" y="220"></use>
          </svg>
          <svg id="minute-2" class="num-0" width="20" height="30" viewBox="0 0 260 480">
            <use xlink:href="#unit-h" class="segment a" x="30" y="0"></use>
            <use xlink:href="#unit-v" class="segment b" x="220" y="30"></use>
            <use xlink:href="#unit-v" class="segment c" x="220" y="250"></use>
            <use xlink:href="#unit-h" class="segment d" x="30" y="440"></use>
            <use xlink:href="#unit-v" class="segment e" x="0" y="250"></use>
            <use xlink:href="#unit-v" class="segment f" x="0" y="30"></use>
            <use xlink:href="#unit-h" class="segment g" x="30" y="220"></use>
          </svg>
        </div>
        <div class="second">
          <svg id="second-1" class="num-0" width="20" height="30" viewBox="0 0 260 480">
            <use xlink:href="#unit-h" class="segment a" x="30" y="0"></use>
            <use xlink:href="#unit-v" class="segment b" x="220" y="30"></use>
            <use xlink:href="#unit-v" class="segment c" x="220" y="250"></use>
            <use xlink:href="#unit-h" class="segment d" x="30" y="440"></use>
            <use xlink:href="#unit-v" class="segment e" x="0" y="250"></use>
            <use xlink:href="#unit-v" class="segment f" x="0" y="30"></use>
            <use xlink:href="#unit-h" class="segment g" x="30" y="220"></use>
          </svg>
          <svg id="second-2" class="num-0" width="20" height="30" viewBox="0 0 260 480">
            <use xlink:href="#unit-h" class="segment a" x="30" y="0"></use>
            <use xlink:href="#unit-v" class="segment b" x="220" y="30"></use>
            <use xlink:href="#unit-v" class="segment c" x="220" y="250"></use>
            <use xlink:href="#unit-h" class="segment d" x="30" y="440"></use>
            <use xlink:href="#unit-v" class="segment e" x="0" y="250"></use>
            <use xlink:href="#unit-v" class="segment f" x="0" y="30"></use>
            <use xlink:href="#unit-h" class="segment g" x="30" y="220"></use>
          </svg>
        </div>
      </div>
    </div>
      <section class="frame-parent">
      <div id="main">
        <div class="frame-item">
          <h3 class="check-inout">Employee's on Duty<span style="font-size:14px;margin-left:20px;">
              <div class="image-2024-01-17-154939738-rem-parent" style="scale:0.3;z-index:10000;">
                <img class="image-2024-01-17-154939738-rem-icon" alt="" src="./public/image-20240117-154939738removebgpreview-1@2x.png" />

                <div class="ellipse-container">
                  <div class="frame-child"></div>
                  <b class="b2"><?php echo $count1; ?></b>
                </div>
              </div>
            </span></h3>
          <div class="frame-inner"></div>
          <div style="overflow-y: auto; overflow-x: hidden; height: 460px; width: 285px; margin-top: 60px;">
            <?php
            @include 'inc/config.php';
            if ($con->connect_error) {
              die("Connection failed: " . $con->connect_error);
            }
            $sql = "SELECT e.empname, e.pic, c.AttendanceTime, c.InputType, c.AttendanceType
        FROM emp e
        JOIN CamsBiometricAttendance c ON e.UserID = c.UserID
        WHERE TIMESTAMP(DATE(AttendanceTime)) = '$currentDate'   ORDER BY AttendanceTime DESC";

            $result = $con->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                   $attendanceTime = strtotime($row['AttendanceTime']);
                  echo '<table style="margin-top: -60px;">
                  <tr>
                  <td style="display: block; margin-bottom: 15px; padding: 4px;">
                    <div style="z-index: 9999; margin-top: 60px; margin-left: 12px; border-radius: var(--br-mini); background-color: var(--color-white); box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25); width: 257px; height: 145px;"></div>';
                
                    if ($row['AttendanceType'] == 'CheckIn') {
                      echo '<div class="asdf"></div>';
                    } elseif ($row['AttendanceType'] == 'CheckOut') {
                      echo '<div class="qwer"></div>';
                    }
                    echo '<p style="font-size: 16px; margin-left: 33px; margin-top: -20px;">' . $row['AttendanceType'] . '</p>
                          <p style="font-size: 13px; margin-left: 30px; margin-top: -8px;">' . $row['empname'] . '</p>';
           if (strtotime($row['AttendanceTime']) >= strtotime("17:30:00")) {
                            echo '<p style="font-size: 13px; margin-left: 30px; margin-top: -8px; color: black;">' . date("H:i:s", strtotime($row['AttendanceTime'])) . '</p>';
                        } elseif (strtotime($row['AttendanceTime']) > strtotime("9:40:00 AM")) {
                            echo '<p style="font-size: 13px; margin-left: 30px; margin-top: -8px; color: red;">' . date("H:i:s", strtotime($row['AttendanceTime'])) .'  &nbsp; [Late]' . '</p>';
                        } else {
                            echo '<p style="font-size: 13px; margin-left: 30px; margin-top: -8px; color: green;">' . date("H:i:s", strtotime($row['AttendanceTime'])) .'  &nbsp; [On-Time]'. '</p>';
                        }
                    echo '<p style="font-size: 13px; margin-left: 30px; margin-top: -8px;">' . $row['InputType'] . '</p>
                          <img class="hovpic" src="pics/' . $row['pic'] . '" width="50px" style="margin-top: -40px; margin-left: 200px; border-radius: 60%; height: 50px;" alt="">
                        </td>
                      </tr>       
            </table>';
              }
            } else {
              echo '<div style="text-align: center; margin-top: 50px; font-size: 18px;color:#097969;">No CheckIn/CheckOut today</div>';
            }
            $con->close();
            ?>

          </div>
        </div>
      </div>
      <div id="main1">

        <div class="frame-item" style="margin-left: 300px; z-index: 100;">
          <h3 class="check-inout" style=" z-index: 100;">Employee's on leave<span style="font-size:14px;margin-left:20px;">
              <div class="image-2024-01-17-154424414-rem-parent" style="scale:0.3;z-index:10000;">
                <img class="image-2024-01-17-154424414-rem-icon" alt="" src="./public/image-20240117-154424414removebgpreview-1@2x.png" />
                <div class="ellipse-parent">
                  <div class="frame-child"></div>
                  <b class="b"><?php echo $count2; ?></b>
                </div>
              </div>
            </span></h3>
          <div class="frame-inner"></div>
          <div style="overflow-y: auto; height: 460px; width: 285px; margin-top: 60px; z-index: 99999 !important;">
            <?php
            include 'inc/config.php';

            function formatDateTime($dateTime)
            {
              $formattedDate = date('Y-m-d', strtotime($dateTime));
              return (substr($dateTime, 11) === '00:00:00') ? $formattedDate : $dateTime;
            }

            $sql = "SELECT e.empname, e.empph, l.leavetype, l.from, l.to, l.status, l.status1, e.pic
        FROM emp e
        JOIN leaves l ON e.empname = l.empname 
        WHERE l.status = 1 AND l.status1 = 1 AND '$currentDate'   BETWEEN DATE(l.from) AND DATE(l.to)";

            $result = $con->query($sql);

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $fromDateTime = date('Y-m-d H:i:s', strtotime($row['from']));
                $toDateTime = date('Y-m-d H:i:s', strtotime($row['to']));

                echo '<table style="margin-top: -60px;">
                <tr>
                    <td style="display: block; margin-bottom: 24px;">
                        <div style="z-index: 9999; margin-top: 60px; margin-left: 12px; border-radius: var(--br-mini);background-color: var(--color-white);box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);width: 257px;height: 130px;"></div>
                        <div style="z-index: 9999; margin-top: -120px; margin-left: 30px; border-radius: var(--br-8xs); background-color: var(--color-lavender);width: 148px; height: 24px;"></div>
                        <p style="font-size: 16px; margin-left: 45px; margin-top: -20px;font-size:14px;">' . $row['leavetype'] . '</p>
                        <p style="font-size: 12px; margin-left: 30px; margin-top: -8px;">' . $row['empname'] . '</p>
                        <p style="font-size: 12px; margin-left: 30px; margin-top: -8px; width: 130px;">' . $row['empph'] . '</p>
                        <p class="leave-request-datetime" style="font-size: 12px; margin-left: 30px; margin-top: -8px; width: 170px;">' .
                  formatDateTime($fromDateTime) . ' to ' . formatDateTime($toDateTime) . '</p>
                        <img class="hovpic" src="pics/' . $row['pic'] . '" width="50px" style="margin-left: 200px; border-radius: 100px; margin-top: -40px;height:50px;" alt="">
                    </td>
                </tr>
            </table>';
              }
            } else {
              echo '<div style="text-align: center; margin-top: 50px; font-size: 18px;color:#097969;">No employee on Leave today</div>';
            }

            $result->close();
            $con->close();
            ?>

          </div>
        </div>
      </div>
      <div id="main2">

        <div class="frame-item" style="margin-left: 600px; z-index: 100;">

          <h3 class="check-inout" style=" z-index: 100;">Absentees<span style="font-size:14px;margin-left:20px;">
              <div class="image-2024-01-17-154712686-rem-parent" style="scale:0.3;z-index:10000;">
                <img class="image-2024-01-17-154712686-rem-icon" alt="" src="./public/image-20240117-154712686removebgpreview-1@2x.png" />

                <div class="ellipse-group">
                  <div class="frame-child"></div>
                  <b class="b"><?php echo $count3; ?></b>
                </div>
              </div>
            </span> </h3>
          <div class="frame-inner"></div>
          <div style="overflow-y: auto; height: 460px; width: 285px; margin-top: 60px; z-index: 99999 !important;">
            <?php
            @include 'inc/config.php';
            $sql = "SELECT a.empname, e.empph, e.pic, e.desg 
        FROM absent a
        JOIN emp e ON a.empname = e.empname
        WHERE DATE(a.AttendanceTime) = '$currentDate'  ";


            $result = $con->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '<table style="margin-top: -60px;">
              <tr>
                <td style="display: block;margin-bottom: 15px;padding:4px;">
                  <div style="z-index: 9999; margin-top: 60px; margin-left: 12px; border-radius: var(--br-mini);background-color: var(--color-white);box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);width: 257px;height: 120px;"></div>
                  <div style="z-index: 9999; margin-top: -110px; margin-left: 30px; border-radius: var(--br-8xs); background-color: var(--color-lavender);width: 148px; height: 24px;"></div>
                  <p style="font-size: 16px; margin-left: 30px; margin-top: -22px;font-size:14px;">' . $row['desg'] . '</p>
                  <p style="font-size: 13px; margin-left: 30px; margin-top: -8px;">' . $row['empname'] . '</p>
                  <p style="font-size: 13px; margin-left: 30px; margin-top: -8px;">' . $row['empph'] . '</p>
                  <img class="hovpic" src="pics/' . $row['pic'] . '" width="50px" style="margin-top: -35px; margin-left: 190px; border-radius: 50px;height:50px;" alt="">
                  </td>
                </td>
              </tr>
            </table>';
              }
            } else {
              echo '<div style="text-align: center; margin-top: 50px; font-size: 18px;color:#097969;">No absentees today</div>';
            }

            $con->close();
            ?>
          </div>
        </div>
      </div>
      <div id="main3">

        <div class="frame-item" style="margin-left: 900px; z-index: 100;">

          <h3 class="check-inout" style=" z-index: 100;">Employee Request's</h3>
          <div class="frame-inner" style=" z-index: 100;"></div>
          <div style="overflow-y: auto; height: 460px; width: 285px; margin-top: 60px; z-index: 99999 !important;">
            <?php
            include 'inc/config.php';
            $sql = "SELECT leaves.empname, leaves.applied, leaves.status, leaves.status1, emp.pic
        FROM leaves
        INNER JOIN emp ON leaves.empname = emp.empname
        WHERE ((leaves.status = 0 AND leaves.status1 = 0) OR (leaves.status = 3 AND leaves.status1 = 0)) 
        ORDER BY leaves.applied DESC";
            $result = mysqli_query($con, $sql);
           if ($result->num_rows > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $status = $row['status'];
                $status1 = $row['status1'];
                echo '<table style="margin-top: -60px;">';
                echo '<tr class="hover-dim">';
                echo '<td style="display: block;margin-bottom: 5px;padding:4px;">';
                echo '<a href="leave-management.php" style="text-decoration:none;color:black;">';
                echo '<div style="z-index: 9999; margin-top: 60px; margin-left: 12px; border-radius: var(--br-mini);background-color: var(--color-white);box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);width: 257px;height: 130px;"></div>';
                echo '<div style="z-index: 9999; margin-top: -120px; margin-left: 30px; border-radius: var(--br-8xs); background-color: var(--color-lightblue);width: 148px; height: 24px;"></div>';
                echo '<p style="font-size: 14px; margin-left: 43px; margin-top: -22px;">Leave Request</p>';
                echo '<p style="font-size: 12px; margin-left: 30px; margin-top: -5px;">' . $row['empname'] . '</p>';
                $formattedDate = date('H:i:s d-m-Y', strtotime($row['applied']));
                echo '<p style="font-size: 12px; margin-left: 30px; margin-top: -5px; width: 130px;">[Pending from-</p>';
                echo '<p style="font-size: 12px; margin-left: 30px; margin-top: -10px; width: 130px;">' . $formattedDate . ']</p>';
                echo '<p style="font-size: 12px; margin-left: 30px; margin-top: -7px;">' .
                  (($status == '0' && $status1 == '0') ? 'HR-Action Pending' : (($status == '3' && $status1 == '0') ? 'Pending at Approver' : '')) . '</p>';
                echo '<img class="hovpic" src="pics/' . $row['pic'] . '" width="50px" style="margin-top: -60px; margin-left: 190px; border-radius: 50px;height:50px;" alt="">';
                echo '</a>';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
              }
              mysqli_free_result($result);
            } else {
              echo '<div style="text-align: center; margin-top: 50px; font-size: 18px;color:#097969;">No requests today</div>';
            }
            mysqli_close($con);
            ?>

          </div>
        </div>
      </div>
      <div class="chart" style="display: flex; gap: 20px; margin-left: 400px; width: 335px; margin-top: 520px;">
        <div class="frame-item" style="height: 340px; margin-top: 540px; margin-left: 300px; width: 584px;"></div>
        <canvas id="myChart1" style="width: 500px; height: 400px; margin-top: 90px; z-index: 999999;"></canvas>
        <!--<canvas id="myChart" style="margin-top: 20px; z-index: 999999;"></canvas>-->
        <div style="z-index: 999999999; background-color: white; height: 40px; width: 270px; margin-left: -400px; margin-top: 30px; border-radius: 10px; display: flex; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.5);">
          <img src="./public/groupicon.png" width="62px" height="60px" style="margin-top: -12px;" alt="">
          <p style="font-size: 14px;  margin-top: 10px;margin-left:-10px;">Total Active Employee's => <sub style="font-size: 20px; font-weight: 600;"><?php echo $count4; ?></sub> </p>
        </div>
      </div>
      <div id="main4">
        <div class="frame-item" style="  margin-top: 540px; margin-left:900px; height: 340px;">
          <h3 class="check-inout">Birthday's</h3>
          <div class="frame-inner"></div>
          <div style="position:absolute;overflow-y: auto; height: 270px; width: 285px; margin-top: 60px; background-color: white; width: 270px; margin-left: 7px; border-radius: 10px; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.5);">
            <?php
            include('inc/config.php');

            $query = "SELECT pic, empname, empdob FROM emp ORDER BY MONTH(empdob), DAY(empdob)";
            $result = mysqli_query($con, $query);

            if ($result) {
              $todayData = '';
              $otherData = '';

              while ($row = mysqli_fetch_assoc($result)) {
                $limitedEmpName = substr($row['empname'], 0, 13);
                $formattedEmpDob = date('M, d', strtotime($row['empdob']));
                $isCurrentDate = date('M, d') == $formattedEmpDob;
                $trBackgroundColor = $isCurrentDate ? 'background: url(https://i.pinimg.com/originals/9a/1c/94/9a1c94e764a96733ff449a592bb64cfb.jpg);background-size: cover;outline:2px solid #ad8047;border-radius:25px;' : '';
                $trPicColor = $isCurrentDate ? 'outline:1px solid  #FFCC33;border-radius:30px;' : '';

                $rowData = '<table>
                        <tr >
                            <td></td>
                            <td> <img class="hovpic1" src="pics/' . $row['pic'] . '" width="30px" style="border-radius: 50px;' . $trPicColor . '" alt=""> </td>
                            <td style="font-size: 14px;' . $trBackgroundColor . '"><input type="text" value=" ' . $limitedEmpName . ' "  style="width:150px; border:none; pointer-events:none; background:transparent;/></td>
                            <td style="font-size: 14px; margin-top:12px; float:right;' . $trBackgroundColor . '">' . $formattedEmpDob . '</td>
                        </tr>
                    </table>';

                if ($isCurrentDate) {
                  $todayData .= $rowData;
                } else {
                  $otherData .= $rowData;
                }
              }

              echo $todayData . $otherData;
              mysqli_free_result($result);
            } else {
              echo "Error: " . mysqli_error($con);
            }

            mysqli_close($con);
            ?>



          </div>
        </div>
      </div>
      <div id="main5">
        <div class="frame-item" style="  margin-top: 540px; height: 340px;">
          <h3 class="check-inout">Stats</h3>
          <div class="frame-inner"></div>
              <div style="position:absolute;overflow-y: hidden; height: 270px; width: 285px; margin-top: 60px; background-color: white; width: 270px; margin-left: 7px; border-radius: 10px; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.5);">
        <p style="font-size:18px; margin-left:13px; padding-bottom:5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">Employee's on Duty <span style="margin-left:20px;">=> <b><?php echo $count1; ?></b></span></p>
    <p style="font-size:13px; margin-left:28px; padding-bottom:5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">|-> Checked In Employee's <span style="margin-left:16px;">=> <b><?php echo $count1; ?></b></span></p>
      <p style="font-size:13px; margin-left:28px; padding-bottom:5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">|-> Yet to CheckIn Employee's <span style="margin-left:0px;">=> <b><?php echo $count5; ?></b></span></p>
    <p style="font-size:18px; margin-left:13px; padding-bottom:5px; border-bottom: 1px solid rgba(223, 223, 223, 0.397);">Employee's on Leave <span style="margin-left:10px;">=> <b><?php echo $count2; ?></b></span></p>
    <p style="font-size:18px; margin-left:13px; padding-bottom:5px; border-bottom: 3px solid rgba(223, 223, 223, 0.597);">Absentees <span style="margin-left:97px;">=> <b><?php echo $count3; ?></b></span></p>
<p style="font-size:18px; margin-left:10px;margin-top:-5px;">Workforce Status <span style="margin-left:40px;font-size:22px;">=> <b style="background:#FB8C0B;border-radius:20%;color:white;padding:4px;"><?php echo $count1 + $count2 + $count3 + $count5; ?></b></span></p>

</div>
        </div>
      </div>
    </section>
      </div>
      <img class="tablerlogout-icon18" alt="" src="./public/tablerlogout.svg" />
    </div>
    <?php
  @include 'inc/config.php';
  $sql1 = "SELECT COUNT(*) as count
  FROM emp e
  JOIN CamsBiometricAttendance c ON e.UserID = c.UserID
  WHERE DATE(AttendanceTime) = '$currentDate' 
    AND AttendanceType = 'CheckIn'
    AND NOT EXISTS (
        SELECT 1
        FROM CamsBiometricAttendance co
        WHERE co.UserID = c.UserID
          AND DATE(co.AttendanceTime) = DATE(c.AttendanceTime)
          AND co.AttendanceType = 'CheckOut'
          AND co.AttendanceTime > c.AttendanceTime
    )";

  $result1 = $con->query($sql1);
  $row1 = $result1->fetch_assoc();
  $count1 = $row1['count'];
  $sql2 = "SELECT COUNT(*) as count FROM emp e
        JOIN leaves l ON e.empname = l.empname 
        WHERE l.status = 1 AND l.status1 = 1 AND '$currentDate'    BETWEEN DATE(l.from) AND DATE(l.to)";

  $result2 = $con->query($sql2);
  $row2 = $result2->fetch_assoc();
  $count2 = $row2['count'];

  $sql3 = "SELECT COUNT(*) as count FROM absent a
        JOIN emp e ON a.empname = e.empname
        WHERE TIMESTAMP(DATE(AttendanceTime)) = '$currentDate'  ";

  $result3 = $con->query($sql3);
  $row3 = $result3->fetch_assoc();
  $count3 = $row3['count'];

  $sql4 = "SELECT COUNT(*) as count FROM emp";

  $result4 = $con->query($sql4);
  $row4 = $result4->fetch_assoc();
  $count4 = $row4['count'];
  $con->close();
  ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piechart-outlabels@0.1.4/dist/chartjs-plugin-piechart-outlabels.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
<script>
  function changeTime() {
	var hour = moment().format("HH");
	var minute = moment().format("mm");
	var second = moment().format("ss");

	document.getElementById("hour-1").setAttribute("class","num-"+hour.substr(0,1));
	document.getElementById("hour-2").setAttribute("class","num-"+hour.substr(1,1));
	document.getElementById("minute-1").setAttribute("class","num-"+minute.substr(0,1));
	document.getElementById("minute-2").setAttribute("class","num-"+minute.substr(1,1));
	document.getElementById("second-1").setAttribute("class","num-"+second.substr(0,1));
	document.getElementById("second-2").setAttribute("class","num-"+second.substr(1,1));

	setTimeout(changeTime, 1000);
}

changeTime();
</script>
<script>
  var maxCount = <?php echo ceil($count4); ?>;
  maxCount = Math.ceil(maxCount);
</script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var count = Math.ceil(<?php echo $count4; ?>);
  var chart = new Chart(ctx, {
    type: 'polarArea',
    labels: ["Absentees", "Employee's on leave", "Employee's on Duty"],
    data: {
      datasets: [{
        label: 'EMS',
        data: [<?php echo $count3; ?>, <?php echo $count2; ?>, <?php echo $count1; ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.4)',
          'rgba(54, 162, 235, 0.4)',
          'rgba(154, 255, 132, 0.4)',
        ],
        borderColor: [
          'rgba(255, 80, 132, 1)',
          'rgba(54, 70, 235, 1)',
          'rgba(154, 255, 13, 9)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        r: {
          beginAtZero: true,
          max: maxCount,
          ticks: {
            stepSize: 1,
          },
        }
      }
    }
  });
</script>
<script>
  var ctx = document.getElementById('myChart1').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Employee's on Duty", "Employee's on leave", "Absentees"],
      datasets: [{
        data: [<?php echo $count1; ?>, <?php echo $count2; ?>, <?php echo $count3; ?>],
        backgroundColor: [
          'rgba(154, 255, 132, 0.4)',
          'rgba(54, 162, 235, 0.4)',
          'rgba(255, 99, 132, 0.4)',
        ],
        borderColor: [
          'rgba(154, 255, 13, 9)',
          'rgba(54, 70, 235, 1)',
          'rgba(255, 80, 132, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          max: maxCount,
          ticks: {
            stepSize: 1,
          },
        },
      },
      plugins: {
        legend: {
          display: false,
        },
      },
    }
  });
</script>
<script>
  var ctx = document.getElementById('myChart2').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Employee's on Duty", "Employee's on leave", "Absentees"],
      datasets: [{
        data: [<?php echo $count1; ?>, <?php echo $count2; ?>, <?php echo $count3; ?>],
        backgroundColor: [
          'rgba(154, 255, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 99, 132, 0.2)',
        ],
        borderColor: [
          'rgba(154, 255, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 99, 132, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false,
        },
      },
      tooltips: {
        enabled: false
      },
      animation: {
        animateRotate: true,
        animateScale: true
      }
    }
  });
</script>
    <script>
      var employeeList = document.getElementById("employeeList");
      if (employeeList) {
        employeeList.addEventListener("click", function (e) {
          window.location.href = "./employee-management.php";
        });
      }
      
      var leaves = document.getElementById("leaves");
      if (leaves) {
        leaves.addEventListener("click", function (e) {
          window.location.href = "./leave-management.php";
        });
      }
      
      var onboarding = document.getElementById("onboarding");
      if (onboarding) {
        onboarding.addEventListener("click", function (e) {
          window.location.href = "./onboarding.php";
        });
      }
      
      var attendance = document.getElementById("attendance");
      if (attendance) {
        attendance.addEventListener("click", function (e) {
          window.location.href = "./attendence.php";
        });
      }
      
      var fluentpeople32Regular = document.getElementById("fluentpeople32Regular");
      if (fluentpeople32Regular) {
        fluentpeople32Regular.addEventListener("click", function (e) {
          window.location.href = "./employee-management.php";
        });
      }
      
      var fluentMdl2leaveUser = document.getElementById("fluentMdl2leaveUser");
      if (fluentMdl2leaveUser) {
        fluentMdl2leaveUser.addEventListener("click", function (e) {
          window.location.href = "./onboarding.php";
        });
      }
      
      var fluentpersonClock20Regular = document.getElementById(
        "fluentpersonClock20Regular"
      );
      if (fluentpersonClock20Regular) {
        fluentpersonClock20Regular.addEventListener("click", function (e) {
          window.location.href = "./leave-management.php";
        });
      }
      
      var uitcalender = document.getElementById("uitcalender");
      if (uitcalender) {
        uitcalender.addEventListener("click", function (e) {
          window.location.href = "./documents.php";
        });
      }
      
      var leavesList = document.getElementById("leavesList");
      if (leavesList) {
        leavesList.addEventListener("click", function (e) {
          window.location.href = "./leave-management.php";
        });
      }
      
      var attendanceReport = document.getElementById("attendanceReport");
      if (attendanceReport) {
        attendanceReport.addEventListener("click", function (e) {
          window.location.href = "./documents.php";
        });
      }
      
      var onboarding1 = document.getElementById("onboarding1");
      if (onboarding1) {
        onboarding1.addEventListener("click", function (e) {
          window.location.href = "./onboarding.php";
        });
      }
      
      var employeeList1 = document.getElementById("employeeList1");
      if (employeeList1) {
        employeeList1.addEventListener("click", function (e) {
          window.location.href = "./employee-management.php";
        });
      }
      
      var applyLeave = document.getElementById("applyLeave");
      if (applyLeave) {
        applyLeave.addEventListener("click", function (e) {
          window.location.href = "./apply-leave.html";
        });
      }
      
      var solarnotesOutline = document.getElementById("solarnotesOutline");
      if (solarnotesOutline) {
        solarnotesOutline.addEventListener("click", function (e) {
          window.location.href = "./leave-management.php";
        });
      }
      
      var ionperson = document.getElementById("ionperson");
      if (ionperson) {
        ionperson.addEventListener("click", function (e) {
          window.location.href = "./designation.php";
        });
      }
      
      var fluentpersonClock24Filled = document.getElementById(
        "fluentpersonClock24Filled"
      );
      if (fluentpersonClock24Filled) {
        fluentpersonClock24Filled.addEventListener("click", function (e) {
          window.location.href = "./apply-leave.html";
        });
      }
      
      var uiscalender = document.getElementById("uiscalender");
      if (uiscalender) {
        uiscalender.addEventListener("click", function (e) {
          window.location.href = "./documents.php";
        });
      }
      
      var fluentpersonArrowBack28Fi = document.getElementById(
        "fluentpersonArrowBack28Fi"
      );
      if (fluentpersonArrowBack28Fi) {
        fluentpersonArrowBack28Fi.addEventListener("click", function (e) {
          window.location.href = "./onboarding.php";
        });
      }
      </script>
  </body>
</html>
