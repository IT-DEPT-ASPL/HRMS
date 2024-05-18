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

    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/attendence.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap"
    />
    <style>
         table {
        z-index: 100;
  border-collapse: collapse;
  /* border-radius: 200px; */
  background-color: white;
/*   overflow: hidden; */
}

th, td {
  padding: 1em;
  background: white;
  color: rgb(52, 52, 52);
  border-bottom: 2px solid rgb(193, 193, 193); 
}
    </style>
  </head>
  <body>
    <div class="attendence4">
      <div class="bg14"></div>
      <div class="rectangle-parent22">
        <div class="frame-child187"></div>
        <a class="frame-child188"> </a>
        <a class="frame-child189" id="rectangleLink1"> </a>
        <a class="frame-child190" id="rectangleLink2"> </a>
        <a class="frame-child191" id="rectangleLink3"> </a>
        <a class="attendence5">Attendence</a>
        <a class="records5" id="records">Records</a>
        <a class="punch-inout4" id="punchINOUT">Punch IN/OUT</a>
        <a class="my-attendence4" id="myAttendence">My Attendence</a>
      </div>
      <div class="rectangle-parent23" >
<table class="data" style="margin-left: auto; margin-right:auto;">
    <!-- Header row -->
    <tr>
        <th>Employee Id</th>
        <th>Full Name</th>
        <th colspan="2" style="border-left: 2px solid rgb(182, 182, 182);">In Time <span style="margin-left:110px;"> -</span><span style="margin-left:50px;"> Input Type</span></th>
        <th colspan="2" style="border-left: 2px solid rgb(182, 182, 182);">Out Time <span style="margin-left:110px;"> -</span><span style="margin-left:50px;"> Input Type</span></th>
    </tr>

    <?php
    $sql = "SELECT emp.emp_no, emp.empname, CamsBiometricAttendance.*
    FROM emp
    INNER JOIN CamsBiometricAttendance ON emp.UserID = CamsBiometricAttendance.UserID
    ORDER BY CamsBiometricAttendance.id DESC";

    $que = mysqli_query($con, $sql);
    $cnt = 1;

    $userCheckOut = array(); // To store check-out information for each user

    while ($result = mysqli_fetch_assoc($que)) {
        $userId = $result['UserID'];

        if ($result['AttendanceType'] == 'CheckOut' || $result['AttendanceType'] == 'BreakOut') {
            // Store check-out information for later use
            $userCheckOut[$userId] = array(
                'AttendanceTime' => $result['AttendanceTime'],
                'InputType' => $result['InputType']
            );
        } else {
            // Display check-in information
    ?>
        <tr>
            <td><?php echo $result['emp_no']; ?></td>
            <td><?php echo $result['empname']; ?></td>

            <!-- In Time - Input Type -->
            <td style="border-left: 2px solid rgb(182, 182, 182);">
                <?php echo ($result['AttendanceType'] == 'CheckIn' || $result['AttendanceType'] == 'BreakIn') ? $result['AttendanceTime'] : ''; ?>
            </td>
            <td>
                <?php echo ($result['AttendanceType'] == 'CheckIn' || $result['AttendanceType'] == 'BreakIn') ? $result['InputType'] : ''; ?>
            </td>

            <!-- Out Time - Input Type -->
            <td style="border-left: 2px solid rgb(182, 182, 182);">
                <?php
                // Display check-out information if available
                if (isset($userCheckOut[$userId])) {
                    echo $userCheckOut[$userId]['AttendanceTime'];
                } else {
                    echo 'Yet to Check Out';
                }
                ?>
            </td>
            <td>
                <?php
                // Display check-out input type if available
                if (isset($userCheckOut[$userId])) {
                    echo $userCheckOut[$userId]['InputType'];
                } else {
                    echo 'Yet to Check Out';
                }
                ?>
            </td>
        </tr>
<?php
        }
        $cnt++;
    }
?>
</table>
      </div>
      <img class="attendence-child" alt="" src="./public/rectangle-1@2x.png" />

      <img class="attendence-item" alt="" src="./public/rectangle-2@2x.png" />

      <img class="logo-1-icon14" alt="" src="./public/logo-1@2x.png" />

      <a class="anikahrm14" href="./index.html" id="anikaHRM">
        <span>Anika</span>
        <span class="hrm14">HRM</span>
      </a>
      <a
        class="attendence-management4"
        href="./index.html"
        id="attendenceManagement"
        >Attendence Management</a
      >
      <button class="attendence-inner"></button>
      <div class="logout14">Logout</div>
      <div class="payroll14">Payroll</div>
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
      />

      <img class="attendence-child1" alt="" src="./public/ellipse-1@2x.png" />

      <img
        class="material-symbolsperson-icon14"
        alt=""
        src="./public/materialsymbolsperson.svg"
      />

      <img class="attendence-child2" alt="" src="./public/rectangle-4@2x.png" />

      <a class="dashboard14" href="./index.html" id="dashboard">Dashboard</a>
      <a class="fluentpeople-32-regular14" id="fluentpeople32Regular">
        <img class="vector-icon73" alt="" src="./public/vector7.svg" />
      </a>
      <a class="employee-list14" id="employeeList">Employee List</a>
      <a
        class="akar-iconsdashboard14"
        href="./index.html"
        id="akarIconsdashboard"
      >
        <img class="vector-icon74" alt="" src="./public/vector3.svg" />
      </a>
      <img class="tablerlogout-icon14" alt="" src="./public/tablerlogout.svg" />

      <a class="leaves14" id="leaves">Leaves</a>
      <a
        class="fluentperson-clock-20-regular14"
        id="fluentpersonClock20Regular"
      >
        <img class="vector-icon75" alt="" src="./public/vector1.svg" />
      </a>
      <a class="onboarding16" id="onboarding">Onboarding</a>
      <a class="fluent-mdl2leave-user14" id="fluentMdl2leaveUser">
        <img class="vector-icon76" alt="" src="./public/vector.svg" />
      </a>
      <a class="attendance14">Attendance</a>
      <a class="uitcalender14">
        <img class="vector-icon77" alt="" src="./public/vector11.svg" />
      </a>
      <div class="oouinext-ltr3"></div>
    </div>

    <script>
      var rectangleLink1 = document.getElementById("rectangleLink1");
      if (rectangleLink1) {
        rectangleLink1.addEventListener("click", function (e) {
          window.location.href = "./records.html";
        });
      }
      
      var rectangleLink2 = document.getElementById("rectangleLink2");
      if (rectangleLink2) {
        rectangleLink2.addEventListener("click", function (e) {
          window.location.href = "./punch-i-n.html";
        });
      }
      
      var rectangleLink3 = document.getElementById("rectangleLink3");
      if (rectangleLink3) {
        rectangleLink3.addEventListener("click", function (e) {
          window.location.href = "./my-attendence.php";
        });
      }
      
      var records = document.getElementById("records");
      if (records) {
        records.addEventListener("click", function (e) {
          window.location.href = "./records.html";
        });
      }
      
      var punchINOUT = document.getElementById("punchINOUT");
      if (punchINOUT) {
        punchINOUT.addEventListener("click", function (e) {
          window.location.href = "./punch-i-n.html";
        });
      }
      
      var myAttendence = document.getElementById("myAttendence");
      if (myAttendence) {
        myAttendence.addEventListener("click", function (e) {
          window.location.href = "./my-attendence.php";
        });
      }
      
      var anikaHRM = document.getElementById("anikaHRM");
      if (anikaHRM) {
        anikaHRM.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var attendenceManagement = document.getElementById("attendenceManagement");
      if (attendenceManagement) {
        attendenceManagement.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var dashboard = document.getElementById("dashboard");
      if (dashboard) {
        dashboard.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var fluentpeople32Regular = document.getElementById("fluentpeople32Regular");
      if (fluentpeople32Regular) {
        fluentpeople32Regular.addEventListener("click", function (e) {
          window.location.href = "./employee-management.html";
        });
      }
      
      var employeeList = document.getElementById("employeeList");
      if (employeeList) {
        employeeList.addEventListener("click", function (e) {
          window.location.href = "./employee-management.html";
        });
      }
      
      var akarIconsdashboard = document.getElementById("akarIconsdashboard");
      if (akarIconsdashboard) {
        akarIconsdashboard.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var leaves = document.getElementById("leaves");
      if (leaves) {
        leaves.addEventListener("click", function (e) {
          window.location.href = "./leave-management.html";
        });
      }
      
      var fluentpersonClock20Regular = document.getElementById(
        "fluentpersonClock20Regular"
      );
      if (fluentpersonClock20Regular) {
        fluentpersonClock20Regular.addEventListener("click", function (e) {
          window.location.href = "./leave-management.html";
        });
      }
      
      var onboarding = document.getElementById("onboarding");
      if (onboarding) {
        onboarding.addEventListener("click", function (e) {
          window.location.href = "./onboarding.html";
        });
      }
      
      var fluentMdl2leaveUser = document.getElementById("fluentMdl2leaveUser");
      if (fluentMdl2leaveUser) {
        fluentMdl2leaveUser.addEventListener("click", function (e) {
          window.location.href = "./onboarding.html";
        });
      }
      </script>
  </body>
</html>
