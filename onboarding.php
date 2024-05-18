<?php include('inc/config.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/onboarding.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap"
    />
    <style>
      table {
        margin-left: 50px;
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
    <div class="onboarding17">
      <div class="bg15"></div>
      <img class="onboarding-child" alt="" src="./public/rectangle-1@2x.png" />

      <img class="onboarding-item" alt="" src="./public/rectangle-2@2x.png" />

      <img class="logo-1-icon15" alt="" src="./public/logo-1@2x.png" />

      <a class="anikahrm15" href="./index.html" id="anikaHRM">
        <span>Anika</span>
        <span class="hrm15">HRM</span>
      </a>
      <a class="onboarding18" href="./index.html" id="onboarding"
        >Onboarding</a
      >
      <button class="onboarding-inner"></button>
      <div class="logout15">Logout</div>
      <a class="attendance15" id="attendance">Attendance</a>
      <div class="payroll15">Payroll</div>
      <div class="reports15">Reports</div>
      <img class="uitcalender-icon15" alt="" src="./public/uitcalender.svg" />

      <img
        class="arcticonsgoogle-pay15"
        alt=""
        src="./public/arcticonsgooglepay.svg"
      />

      <img
        class="streamlineinterface-content-c-icon15"
        alt=""
        src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg"
      />

      <img class="onboarding-child1" alt="" src="./public/ellipse-1@2x.png" />

      <img
        class="material-symbolsperson-icon15"
        alt=""
        src="./public/materialsymbolsperson.svg"
      />

      <img class="onboarding-child2" alt="" src="./public/rectangle-4@2x.png" />

      <a class="dashboard15" href="./index.html" id="dashboard">Dashboard</a>
      <a class="fluentpeople-32-regular15" id="fluentpeople32Regular">
        <img class="vector-icon78" alt="" src="./public/vector7.svg" />
      </a>
      <a class="employee-list15" id="employeeList">Employee List</a>
      <a
        class="akar-iconsdashboard15"
        href="./index.html"
        id="akarIconsdashboard"
      >
        <img class="vector-icon79" alt="" src="./public/vector3.svg" />
      </a>
      <img class="tablerlogout-icon15" alt="" src="./public/tablerlogout.svg" />

      <a class="uitcalender15" id="uitcalender">
        <img class="vector-icon80" alt="" src="./public/vector4.svg" />
      </a>
      <a class="leaves15" id="leaves">Leaves</a>
      <a
        class="fluentperson-clock-20-regular15"
        id="fluentpersonClock20Regular"
      >
        <img class="vector-icon81" alt="" src="./public/vector1.svg" />
      </a>
      <a class="onboarding19">Onboarding</a>
      <a class="fluent-mdl2leave-user15">
        <img class="vector-icon82" alt="" src="./public/vector8.svg" />
      </a>
      <div class="rectangle-parent24">
        <!-- <div class="frame-child203"></div> -->
        <table class="data">
          <tr>
            <th>No.</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
          <?php
          $sql = "SELECT * FROM onb  WHERE status=0 ORDER BY id DESC";
           $que = mysqli_query($con,$sql);
           $cnt = 1;
           if(mysqli_num_rows($que) > 0)
                                        {
                                            foreach($que as $result) 
                                            { ?>
          <tr>
          <td><?php echo $cnt;?></td>
            <td><?php echo $result['empname'];?></td>
            <td><?php echo $result['empph'];?></td>
            <td><?php echo $result['empemail'];?></td>
            <td> <a style="text-decoration: none; color: goldenrod;" href="employee-approval.php?id=<?php echo $result['ID']; ?>" >Action</a> </td>
          </tr>
          <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <tr>
                                            <td colspan="5" style="text-align: center;">No Onboarding Requests</td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    

        </table>
       

        
      </div>
    </div>

    <script>
      var anikaHRM = document.getElementById("anikaHRM");
      if (anikaHRM) {
        anikaHRM.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var onboarding = document.getElementById("onboarding");
      if (onboarding) {
        onboarding.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var attendance = document.getElementById("attendance");
      if (attendance) {
        attendance.addEventListener("click", function (e) {
          window.location.href = "./attendence.php";
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
          window.location.href = "./employee-management.php";
        });
      }
      
      var employeeList = document.getElementById("employeeList");
      if (employeeList) {
        employeeList.addEventListener("click", function (e) {
          window.location.href = "./employee-management.php";
        });
      }
      
      var akarIconsdashboard = document.getElementById("akarIconsdashboard");
      if (akarIconsdashboard) {
        akarIconsdashboard.addEventListener("click", function (e) {
          window.location.href = "./index.html";
        });
      }
      
      var uitcalender = document.getElementById("uitcalender");
      if (uitcalender) {
        uitcalender.addEventListener("click", function (e) {
          window.location.href = "./attendence.php";
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
      
      var akarIconsedit9 = document.getElementById("akarIconsedit9");
      if (akarIconsedit9) {
        akarIconsedit9.addEventListener("click", function (e) {
          window.location.href = "./employee-approval.html";
        });
      }
      </script>
  </body>
</html>
