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
       <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
         table {
        z-index: 100;
  border-collapse: collapse;
  background-color: white;
}

th, td {
  padding: 1em;
  border-bottom: 2px solid rgb(193, 193, 193); 
}
.even {
  border-bottom: 2px solid #e8e8e8ba; 
    }

    .odd {
        background-color: #e9e9e9 !important; 
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
    <div class="attendence4">
      <div class="bg14"></div>
      <div class="rectangle-parent22">
        <div class="frame-child187"></div>
        <a class="frame-child188"> </a>
        <a class="frame-child189" id="rectangleLink1"> </a>
        <a href="punchout.php" class="frame-child190" id="rectangleLink2"> </a>
        <a class="frame-child191" id="rectangleLink3"> </a>
        <a class="attendence5">Attendance</a>
        <a class="records5" id="records">Check IN</a>
        <a class="punch-inout4" id="punchINOUT">Check OUT</a>
        <a class="my-attendence4" id="myAttendence">My Attendance</a>
    <a class="frame-child191" id="rectangleLink3" style="margin-left: 230px;"> </a>
        <a href="attendancelog.php" class="my-attendence4" id="myAttendence" style="margin-left: 230px;">Attendance log</a>
      </div>
      <div class="rectangle-parent23" style="overflow-y: auto;">
       <table class="data" style="margin-left: auto; margin-right:auto;">
    <tr>
      <th >Date</th>
        <th style="border-left: 2px solid rgb(182, 182, 182);"></th>
        <th>Employee Name</th>
             <th colspan="2" style="white-space:nowrap; border-left: 2px solid rgb(182, 182, 182);">In Time <span style="margin-left:110px;"> -</span><span style="margin-left:50px;"> Input Type</span></th>
        <th colspan="2" style="white-space:nowrap;border-left: 2px solid rgb(182, 182, 182);">Out Time <span style="margin-left:70px;"> -</span><span style="margin-left:30px;"> Input Type</span></th>
    </tr>

    <?php
    $sql = "SELECT emp.emp_no, emp.empname,emp.pic, CamsBiometricAttendance.*
    FROM emp
    INNER JOIN CamsBiometricAttendance ON emp.UserID = CamsBiometricAttendance.UserID
    ORDER BY CamsBiometricAttendance.id DESC";

    $que = mysqli_query($con, $sql);
    $cnt = 1;

    $userCheckOut = array();
    $prevDay = null; 

    while ($result = mysqli_fetch_assoc($que)) {
        $userId = $result['UserID'];
        $dayOfMonth = date('j', strtotime($result['AttendanceTime']));
        $formattedDate = date('D j M', strtotime($result['AttendanceTime']));
        $rowColorClass = ($dayOfMonth % 2 == 0) ? 'even' : 'odd';

        if ($result['AttendanceType'] == 'CheckOut') {
            $userCheckOut[$userId] = array(
                'AttendanceTime' => $result['AttendanceTime'],
                'InputType' => $result['InputType']
            );
        } elseif ($result['AttendanceType'] == 'CheckIn') {
            $currentDay = date('j', strtotime($result['AttendanceTime']));
            $borderBottom = ($prevDay !== null && $currentDay !== $prevDay) ? 'border-top: 4px solid #FB8B0B;' : '';

    ?>
        <tr class="<?php echo $rowColorClass; ?>" style="<?php echo $borderBottom; ?>">
        <td style="white-space:nowrap;"><?php echo $formattedDate; ?></td>
          <td style="border-left: 2px solid rgb(182, 182, 182);"><img class="hovpic" src="pics/<?php echo $result['pic']; ?>" width="40px" height="40px" style="border-radius: 50px; border: 0.5px solid rgb(161, 161, 161);"></td>
            <td><?php echo $result['empname']; ?></td>

            <td style="border-left: 2px solid rgb(182, 182, 182);">
                <?php echo $result['AttendanceTime']; ?>
            </td>
            <td>
                <?php echo $result['InputType']; ?>
            </td>
            <td style="border-left: 2px solid rgb(182, 182, 182);">
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
      </div>
      <img class="attendence-child" alt="" src="./public/rectangle-1@2x.png" />

      <img class="attendence-item" alt="" src="./public/rectangle-2@2x.png" />

      <img class="logo-1-icon14" alt="" src="./public/logo-1@2x.png" />

      <a class="anikahrm14" href="./index.php" id="anikaHRM">
        <span>Anika</span>
        <span class="hrm14">HRM</span>
      </a>
      <a
        class="attendence-management4"
        href="./index.php"
        id="attendenceManagement"
        >Attendance Management</a
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

      <a class="dashboard14" href="./index.php" id="dashboard">Dashboard</a>
      <a class="fluentpeople-32-regular14" id="fluentpeople32Regular">
        <img class="vector-icon73" alt="" src="./public/vector7.svg" />
      </a>
      <a class="employee-list14" id="employeeList">Employee List</a>
      <a
        class="akar-iconsdashboard14"
        href="./index.php"
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
          window.location.href = "./punch-i-n.php";
        });
      }
      
      var rectangleLink2 = document.getElementById("rectangleLink2");
      if (rectangleLink2) {
        rectangleLink2.addEventListener("click", function (e) {
          window.location.href = "./punch-i-n.php";
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
          window.location.href = "./punch-i-n.php";
        });
      }
      
      var punchINOUT = document.getElementById("punchINOUT");
      if (punchINOUT) {
        punchINOUT.addEventListener("click", function (e) {
          window.location.href = "./punchout.php";
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
          window.location.href = "./index.php";
        });
      }
      
      var attendenceManagement = document.getElementById("attendenceManagement");
      if (attendenceManagement) {
        attendenceManagement.addEventListener("click", function (e) {
          window.location.href = "./index.php";
        });
      }
      
      var dashboard = document.getElementById("dashboard");
      if (dashboard) {
        dashboard.addEventListener("click", function (e) {
          window.location.href = "./index.php";
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
          window.location.href = "./index.php";
        });
      }
      
      var leaves = document.getElementById("leaves");
      if (leaves) {
        leaves.addEventListener("click", function (e) {
          window.location.href = "./leave-management.php";
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
      
      var onboarding = document.getElementById("onboarding");
      if (onboarding) {
        onboarding.addEventListener("click", function (e) {
          window.location.href = "./onboarding.php";
        });
      }
      
      var fluentMdl2leaveUser = document.getElementById("fluentMdl2leaveUser");
      if (fluentMdl2leaveUser) {
        fluentMdl2leaveUser.addEventListener("click", function (e) {
          window.location.href = "./onboarding.php";
        });
      }
      </script>
  </body>
</html>
