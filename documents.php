<?php
include_once 'inc/config.php';

$sql = "select pdf from emp";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/onboarding.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap"
    />
    <style>
        table {
          margin-left: 150px;
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
      <h5 class="hr-management" style="margin-left: 300px;">/Documents</h5>
      <button class="index-inner"></button>
      <div class="logout18">Logout</div>
      <a class="employee-list18" id="employeeList" href="employee-management.php">Employee List</a>
      <a class="leaves18" id="leaves">Leaves</a>
      <a class="onboarding22" id="onboarding">Onboarding</a>
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

      <img class="index-child1" alt="" src="./public/ellipse-1@2x.png" />

      <img
        class="material-symbolsperson-icon18"
        alt=""
        src="./public/materialsymbolsperson.svg"
      />

      <img class="index-child2" alt="" src="./public/rectangle-4@2x.png" />

      <a class="dashboard18" href="index.php">Dashboard</a>
      <a class="akar-iconsdashboard18">
        <img class="vector-icon98" alt="" src="./public/vector14.svg" />
      </a>
      <div class="rectangle-parent24">
       
        <table class="data">
          <tr>
            <th>No.</th>
            <th>Documents Name</th>
            <th>View</th>
            <th>Download</th>
          </tr>
          <?php
                $i = 1;
                while($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['pdf']; ?></td>
            <td><a target="_blank" href="pdfs/<?php echo $row['pdf']; ?>"><img src="./public/images-removebg-preview.png" width="30px" style="margin-left: 10px;" alt=""></a></td>
            <td><a download href="pdfs/<?php echo $row['pdf']; ?>"><img src="./public/image-removebg-preview.png" width="30px" style="margin-left: 40px;" alt=""></a></td>
          </tr>
          <?php }?>
        </table>
       

        
      </div>
      <img class="tablerlogout-icon18" alt="" src="./public/tablerlogout.svg" />
    </div>

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
          window.location.href = "./leave-management.html";
        });
      }
      
      var onboarding = document.getElementById("onboarding");
      if (onboarding) {
        onboarding.addEventListener("click", function (e) {
          window.location.href = "./onboarding.html";
        });
      }
      
      var attendance = document.getElementById("attendance");
      if (attendance) {
        attendance.addEventListener("click", function (e) {
          window.location.href = "./attendence.html";
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
          window.location.href = "./onboarding.html";
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
      
      var uitcalender = document.getElementById("uitcalender");
      if (uitcalender) {
        uitcalender.addEventListener("click", function (e) {
          window.location.href = "./attendence.html";
        });
      }
      
      var leavesList = document.getElementById("leavesList");
      if (leavesList) {
        leavesList.addEventListener("click", function (e) {
          window.location.href = "./leave-management.html";
        });
      }
      
      var attendanceReport = document.getElementById("attendanceReport");
      if (attendanceReport) {
        attendanceReport.addEventListener("click", function (e) {
          window.location.href = "./attendence.html";
        });
      }
      
      var onboarding1 = document.getElementById("onboarding1");
      if (onboarding1) {
        onboarding1.addEventListener("click", function (e) {
          window.location.href = "./onboarding.html";
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
          window.location.href = "./leave-management.html";
        });
      }
      
      var ionperson = document.getElementById("ionperson");
      if (ionperson) {
        ionperson.addEventListener("click", function (e) {
          window.location.href = "./employee-management.php";
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
          window.location.href = "./attendence.html";
        });
      }
      
      var fluentpersonArrowBack28Fi = document.getElementById(
        "fluentpersonArrowBack28Fi"
      );
      if (fluentpersonArrowBack28Fi) {
        fluentpersonArrowBack28Fi.addEventListener("click", function (e) {
          window.location.href = "./onboarding.html";
        });
      }
      </script>
  </body>
</html>
