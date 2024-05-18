<!DOCTYPE html>
<?php
session_start();
@include 'inc/config.php';

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
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/my-attendence.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;600&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <style>
      td{
        display: block;
        margin-bottom: 20px;
      }
      
    </style>
  </head>
  <body>
    <div class="my-attendence">
      <div class="bg"></div>
      <img
        class="my-attendence-child"
        alt=""
        src="./public/rectangle-1@2x.png"
      />

      <img
        class="my-attendence-item"
        alt=""
        src="./public/rectangle-2@2x.png"
      />

      <a class="anikahrm" id="anikaHRM">
        <span>Anika</span>
        <span class="hrm">HRM</span>
      </a>
      <a class="attendance-management" id="attendanceManagement"
        >Attendance Management</a
      >
      <button class="my-attendence-inner"><a href="logout.php" style="color:white; text-decoration:none; font-size:25px; margin-left:20px;">Logout</a></button>
      <div class="payroll">Payroll</div>
      <div class="reports">Reports</div>
      <img class="uitcalender-icon" alt="" src="./public/uitcalender.svg" />

      <img
        class="arcticonsgoogle-pay"
        alt=""
        src="./public/arcticonsgooglepay.svg"
      />

      <img
        class="streamlineinterface-content-c-icon"
        alt=""
        src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg"
      />

      <!--<img-->
      <!--  class="material-symbolsperson-icon"-->
      <!--  alt=""-->
      <!--  src="./public/materialsymbolsperson.svg"-->
      <!--/>-->

      <img class="rectangle-icon" alt="" src="./public/rectangle-4@2x.png" />

      <a class="dashboard" id="dashboard" href="./index.php">Dashboard</a>
      <a class="fluentpeople-32-regular" style="margin-top: 130px;" id="fluentpeople32Regular">
        <img class="vector-icon" alt="" src="./public/vector.svg" />
      </a>
      <a class="employee-list" id="employeeList" href="./employee-management.php">Employee List</a>
      <a class="akar-iconsdashboard" style="margin-top: 130px;" id="akarIconsdashboard">
        <img class="vector-icon1" alt="" src="./public/vector1.svg" />
      </a>
      <img class="tablerlogout-icon" alt="" src="./public/tablerlogout.svg" />

      <a class="leaves" id="leaves" href="./leave-management.php">Leaves</a>
      <a class="fluentperson-clock-20-regular"  style="margin-top: -65px;" id="fluentpersonClock20Regular">
        <img class="vector-icon2" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" alt="" src="./public/vector2.svg" />
      </a>
      <a class="onboarding" id="onboarding" href="./onboarding.php">Onboarding</a>
      <a class="fluent-mdl2leave-user"  style="margin-top: -200px;" id="fluentMdl2leaveUser">
        <img class="vector-icon3" alt="" src="./public/vector3.svg" />
      </a>
      <a class="attendance"  href="attendence.php">Attendance</a>
      <a class="uitcalender">
        <img class="vector-icon4" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" alt="" src="./public/vector4.svg" />
      </a>
      <div class="rectangle-parent" style="width: 1200px;">
      <div class="container justify-content-center">
    <div class="row">
       <div class="col-md-5">
           <div class="input-group mb-1">
  <input type="text" class="form-control input-text"id="filterInput" onkeyup="filterTable()" placeholder="Search for employee name...">
  <div class="input-group-append" style="background:white;">
    <span style="border-radius:0px;pointer-events: none; border-color: #fd7e14;" class="btn btn-outline-warning btn-lg" type="button"><i class="fa fa-search"></i></span>
  </div>
</div>
       </div>        
    </div>
</div>
      <table  id="attendanceTable">
    <?php
$user_name = $_SESSION['user_name'];

$sql = "SELECT emp.emp_no, emp.empname, cams.AttendanceTime, '6:00PM' AS OutType, cams.InputType, cams.AttendanceType
        FROM emp 
        INNER JOIN CamsBiometricAttendance cams ON emp.UserID = cams.UserID 
        ORDER BY cams.AttendanceTime desc";

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
            <td>
                <div class="<?php echo $cssClass; ?>"></div>
                <div class="frame-child1" style=" margin-top: -130px; margin-left: 10px;"></div>
                <p style="margin-left: 13px; margin-top: -50px;"><?php echo $formattedDate1; ?></p>
                <p style="margin-left: 32px; margin-top: -90px; font-weight: 800; font-size: 35px;"><?php echo $formattedDate; ?></p>
                <div class="line-div" style="margin-left: <?php echo $cssClass === 'frame-child' ? '545' : '545'; ?>px; margin-top: -80px;"></div>
                <p style="font-size: 30px; color: black; margin-left: 600px; margin-top: -60px;">Input Type:</p>
                <p style="font-size: 30px; color: black; margin-left: 760px; margin-top: -64px;"><?php echo $result['InputType']; ?></p>
        
                <p style="font-size: 30px; color: black; margin-left: 150px; margin-top: -80px;"><?php echo $typeLabel; ?></p>
                <p style="font-size: 30px; color: black; margin-left: 320px; margin-top: -65px;"><?php echo $formattedDateWithLabels; ?></p>
                <p style="font-size: 20px; color: black; margin-left: 150px; margin-top: -20px;"><?php echo $result['empname']; ?></p>
              </td>
        </tr>
        <?php
        $cnt++;
    }
    ?>
</table>
      </div>
      <!--<img class="ellipse-icon" alt="" src="./public/ellipse-1@2x.png" />-->
      <div class="rectangle-group">
        <div class="frame-child20"></div>
        <a href="attendence.php" class="rectangle-a" style="margin-left: -150px;"> </a>
        <a class="frame-child21" id="rectangleLink1" style="margin-left: -150px;"> </a>
        <a class="frame-child22" id="rectangleLink2" style="margin-left: -150px;"> </a>
        <a class="frame-child23"href="./my-attendence.php" id="rectangleLink3" style="margin-left: -150px; background-color: #E8E8E8;"> </a>
        <a class="frame-child23"  id="rectangleLink3" style="margin-left: 80px;"> </a>
        <a href="attendence.php" class="attendence" style="margin-left: -150px;">Attendance</a>
        <a class="records" href="./punch-i-n.php" id="records" style="margin-left: -150px;">Check IN</a>
        <a class="punch-inout" href="punchout.php" id="punchINOUT" style="margin-left: -132px;">Check OUT</a>
        <a class="my-attendence1" href="./my-attendence.php" id="myAttendence" style="margin-left: -150px; color: black;">My Attendance</a>
        <a class="my-attendence1" id="myAttendence" style="margin-left: 74px;">Attendance Log</a>
      </div>
      <img class="logo-1-icon" alt="" src="./public/logo-1@2x.png" />
    </div>
    <script>
function filterTable() {
    var input = document.getElementById('filterInput');
    var filter = input.value.toUpperCase();

    var table = document.getElementById('attendanceTable');

    var rows = table.getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var shouldShow = false;

        if (i === 0) {
            shouldShow = true;
        } else {
            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];

                var isHeaderCell = cell.classList.contains('static-cell');

                if (!isHeaderCell) {
                    var txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        shouldShow = true;
                        break;
                    }
                }
            }
        }

        if (shouldShow) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

</script>
  </body>
</html>
