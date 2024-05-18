<?php
	$con=mysqli_connect("localhost","root","","ems");
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
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./empmobcss/globalqw.css" />
    <link rel="stylesheet" href="./empmobcss/attendenceemp-mob.css" />
    <link rel="stylesheet" href="./empmobcss/empjob-details-mob.css" />
    <link rel="stylesheet" href="./empmobcss/attendancelogemp-mob.css" />
    <link rel="stylesheet" href="./llog.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap"
    />
  </head>
  <body>
    <div class="attendenceemp-mob" style="height: 100svh;">
      <div class="logo-1-group">
        <img class="logo-1-icon1" alt="" src="./public/logo-1@2x.png" />

        <a class="attendance-management" style="width: 300px;">Attendance Management</a>
      </div>
      <div class="attendenceemp-mob-child"></div>
      <div class="attendenceemp-mob-item"></div>
      <div class="rectangle-parent">
        <a class="frame-item" href="./attendenceemp-mob.html" style="background-color: #E8E8E8;"> </a>
        <a class="frame-inner" style="background-color: #ffe2c6;"> </a>
        <a href="./monthly-attendance-emp.html" class="rectangle-a" style="width: 100px;"> </a>
        <a class="attendance" href="./attendenceemp-mob.html" style="color: black; margin-left: 29px;">Attendance</a>
        <a class="punch-inout" style="width: 100px; margin-left: -44px; color: #ff5400;">Attendance Log</a>
        <a class="my-attendance" href="./monthly-attendance-emp.html" style="width: 100px; margin-left: -30px; color: black;">Monthly Attendance</a>
      </div>
      <div class="rectangle-parent23" style="width: 400px; overflow-x: hidden; margin-top: 10px;">
        <table>
        <?php
$user_name = $_SESSION['user_name'];

$sql = "SELECT emp.emp_no, emp.empname, cams.AttendanceTime, '6:00PM' AS OutType, cams.InputType, cams.AttendanceType
        FROM emp 
        INNER JOIN CamsBiometricAttendance cams ON emp.UserID = cams.UserID 
        WHERE emp.empemail = '$user_name'
        ORDER BY AttendanceTime DESC";

    $que = mysqli_query($con, $sql);
    $cnt = 1;

    while ($result = mysqli_fetch_assoc($que)) {
        $timestamp = strtotime($result['AttendanceTime']);
        $formattedDate = date('D', $timestamp);
        $formattedDate1 = date('d-m-Y', $timestamp);
        $hours = date('H', $timestamp);
        $minutes = date('i', $timestamp);
        $formattedDateWithLabels = "$hours Hrs $minutes mins";

        $cssClass = '';
        $typeLabel = '';

        switch ($result['AttendanceType']) {
            case 'CheckIn':
                $cssClass = 'frame-child106';
                $typeLabel = 'CHECK IN:';
                break;
            case 'BreakIn':
                $cssClass = 'frame-child106';
                $typeLabel = 'BREAK IN:';
                break;
            case 'CheckOut':
            case 'BreakOut':
                $cssClass = 'frame-child107';
                $typeLabel = $result['AttendanceType'] == 'CheckOut' ? 'CHECK OUT:' : 'BREAK OUT:';
                break;
        }
        ?>
          <tr>
            <td style="display: block; margin-bottom: 10px;">
              <div style="margin-bottom: 18px;">
                <div class="frame-child106 <?php echo $cssClass; ?>"></div>
              <div class="frame-child108" style="margin-top: -67px; margin-left: 4px;"></div>
              <h3 style="color: white; font-size: 21px; font-weight: 500; margin-top: -55px; margin-left: 14px;"><?php echo $formattedDate; ?></h3>
              <h3 style="color: white; font-size: 11px; font-weight: 300; margin-top: -18px; margin-left: 8px;"><?php echo $formattedDate1; ?></h3>
              <p style="margin-left: 80px; margin-top: -52px;"><?php echo $typeLabel; ?></p>
              <p style="margin-left: 80px; margin-top: -10px;"><?php echo $formattedDateWithLabels; ?></p>
              <div class="line-div" style="margin-left: 190px; <?php echo $cssClass === 'frame-child106' ? '545' : '545'; ?>px; margin-top: -50px;"></div>
              <p style="margin-left: 200px; margin-top: -43px;">Input Type:</p>
              <p style="margin-left: 200px; margin-top: -8px;"><?php echo $result['InputType']; ?></p>
              </div>
              <!-- Check Out -->
              <!-- <div>
                <div class="frame-child107"></div>
                <div class="frame-child109" style="margin-top: -67px; margin-left: 4px;"></div>
                <h3 style="color: white; font-size: 21px; font-weight: 500; margin-top: -55px; margin-left: 14px;">Mon</h3>
                <h3 style="color: white; font-size: 14px; font-weight: 300; margin-top: -18px; margin-left: 8px;">20-12-23</h3>
                <p style="margin-left: 80px; margin-top: -52px;">CHECK OUT:</p>
                <p style="margin-left: 80px; margin-top: -10px;">00hr 00min</p>
                <div class="frame-child110" style="margin-left: 160px; margin-top: -50px;"></div>
                <p style="margin-left: 180px; margin-top: -43px;">Input Type:</p>
                <p style="margin-left: 180px; margin-top: -8px;">FingerPrint</p>
              </div> -->
              </td>
          </tr>
          <?php
        $cnt++;
    }
    ?>
        </table>
      </div>
      <div class="arcticonsgoogle-pay-parent">
        <img
          class="arcticonsgoogle-pay1"
          alt=""
          src="./public/arcticonsgooglepay1@2x.png"
          id="arcticonsgooglePay"
        />

        <div class="ellipse-div"></div>
        <a class="akar-iconsdashboard1" id="akarIconsdashboard">
          <img class="vector-icon3" alt="" src="./public/vector@2xdash.png" />
        </a>
        <a
          class="fluentperson-clock-20-regular1"
          id="fluentpersonClock20Regular"
        >
          <img
            class="vector-icon4"
            alt=""
            src="./public/vector1@2xleaves.png"
          />
        </a>
        <a class="uitcalender1">
          <img
            class="vector-icon5"
            alt=""
            src="./public/vector3@2xattenblack.png"
          />
        </a>
      </div>
    </div>

    <script>
      var arcticonsgooglePay = document.getElementById("arcticonsgooglePay");
      if (arcticonsgooglePay) {
        arcticonsgooglePay.addEventListener("click", function (e) {
          window.location.href = "./directoryemp-mob.html";
        });
      }
      
      var akarIconsdashboard = document.getElementById("akarIconsdashboard");
      if (akarIconsdashboard) {
        akarIconsdashboard.addEventListener("click", function (e) {
          window.location.href = "./emp-dashboard-mob.html";
        });
      }
      
      var fluentpersonClock20Regular = document.getElementById(
        "fluentpersonClock20Regular"
      );
      if (fluentpersonClock20Regular) {
        fluentpersonClock20Regular.addEventListener("click", function (e) {
          window.location.href = "./apply-leaveemp-mob.html";
        });
      }
      </script>
  </body>
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