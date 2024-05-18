<!DOCTYPE html>
<?php

@include 'inc/config.php';

session_start();

if(!isset($_SESSION['user_name']) && !isset($_SESSION['name'])){
   header('location:loginpage.php');
}

?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./attendanceemp.css" />
    <link rel="stylesheet" href="./attendanceemp123.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap"
    />
  </head>
  <body>
    <section class="attendenceempdash">
      <div class="bg"></div>
      <img
        class="attendenceempdash-child"
        alt=""
        src="./public/rectangle-1@2x.png"
      />

      <img
        class="attendenceempdash-item"
        alt=""
        src="./public/rectangle-2@2x.png"
      />

      <a class="anikahrm">
        <span>Anika</span>
        <span class="hrm">HRM</span>
      </a>
      <a class="employee-management" id="employeeManagement"
        >Attendance Management</a
      >
      <button class="attendenceempdash-inner"></button>
      <div class="logout">Logout</div>
      <a class="leaves">Leaves</a>
      <div style="margin-top: -40px;" class="payroll">Payroll</div>
      <a class="fluentperson-clock-20-regular">
        <img class="vector-icon" alt="" src="./public/vector.svg" />
      </a>
      <img class="uitcalender-icon" alt="" src="./public/uitcalender.svg" />

      <img style="margin-top: -40px;"
        class="arcticonsgoogle-pay"
        alt=""
        src="./public/arcticonsgooglepay.svg"
      />

      <img class="ellipse-icon" alt="" src="./public/ellipse-1@2x.png" />

      <img
        class="material-symbolsperson-icon"
        alt=""
        src="./public/materialsymbolsperson.svg"
      />

      <img style="margin-top: -55px;" class="rectangle-icon" alt="" src="./public/rectangle-4@2x.png" />

      <img class="tablerlogout-icon" alt="" src="./public/tablerlogout.svg" />

      <a style="margin-top: -55px;" class="uitcalender">
        <img class="vector-icon1" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" alt="" src="./public/vector1.svg" />
      </a>
      <a style="margin-top: 70px;" class="dashboard" id="dashboard">Dashboard</a>
      <a style="margin-top: 70px;" class="akar-iconsdashboard" id="akarIconsdashboard">
        <img class="vector-icon2" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" alt="" src="./public/vector2.svg" />
      </a>
      <img class="logo-1-icon" alt="" src="./public/logo-1@2x.png" />

      <a style="margin-top: -55px;" class="attendance">Attendance</a>
      <div class="rectangle-parent" style="width: 1200px;">
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
                $cssClass = 'frame-child';
                $typeLabel = 'CHECK IN:';
                break;
            case 'BreakIn':
                $cssClass = 'frame-child';
                $typeLabel = 'BREAK IN:';
                break;
            case 'CheckOut':
            case 'BreakOut':
                $cssClass = 'frame-child123';
                $typeLabel = $result['AttendanceType'] == 'CheckOut' ? 'CHECK OUT:' : 'BREAK OUT:';
                break;
        }
        ?>
          <tr>
          <td >
                <div class="<?php echo $cssClass; ?>"></div>
                <div class="frame-child1" style="margin-top: -130px; margin-left: 10px;"></div>
                <p style="margin-left: 13px; margin-top: -50px;"><?php echo $formattedDate1; ?></p>
                <p style="margin-left: 32px; margin-top: -90px; font-weight: 800; font-size: 35px;"><?php echo $formattedDate; ?></p>
                <div class="line-div" style="margin-left: <?php echo $cssClass === 'frame-child' ? '545' : '545'; ?>px; margin-top: -80px;"></div>
                <p style="font-size: 30px; color: black; margin-left: 600px; margin-top: -60px;">Input Type:</p>
                <p style="font-size: 30px; color: black; margin-left: 760px; margin-top: -64px;"><?php echo $result['InputType']; ?></p>

                <p style="font-size: 30px; color: black; margin-left: 150px; margin-top: -60px;"><?php echo $typeLabel; ?></p>
                <p style="font-size: 30px; color: black; margin-left: 320px; margin-top: -65px;"><?php echo $formattedDateWithLabels; ?></p>
            </td>
          </tr>
          <?php
        $cnt++;
    }
    ?>
        </table>
      </div>
      <div class="rectangle-group">
        <div class="frame-child20"></div>
        <a href="attendenceemp2.php" class="rectangle-a" style="margin-left: -150px;"> </a>
        <a class="frame-child23"  id="rectangleLink3" style="margin-left: -570px;"> </a>
        <a href="attendenceemp2.php" class="attendence" style="margin-left: -150px;">Attendance</a>
        <a class="my-attendence1" id="myAttendence" style="margin-left: -570px;">Attendance Log</a>
      </div>
      <img class="logo-1-icon" alt="" src="./public/logo-1@2x.png" />
    </div>
    </section>

    <script>
      var employeeManagement = document.getElementById("employeeManagement");
      if (employeeManagement) {
        employeeManagement.addEventListener("click", function (e) {
        });
      }
      
      var dashboard = document.getElementById("dashboard");
      if (dashboard) {
        dashboard.addEventListener("click", function (e) {
        });
      }
      
      var akarIconsdashboard = document.getElementById("akarIconsdashboard");
      if (akarIconsdashboard) {
        akarIconsdashboard.addEventListener("click", function (e) {
        });
      }
      </script>
  </body>
</html>
