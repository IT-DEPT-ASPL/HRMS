<!DOCTYPE html>
<?php

@include 'inc/config.php';

session_start();

if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
  header('location:loginpage.php');
}

?>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />

  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/punch-i-n.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <style>
    /* Scrollbar Styling */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background-color: #ebebeb;
      -webkit-border-radius: 10px;
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
      -webkit-border-radius: 10px;
      border-radius: 10px;
      background: #cacaca;
    }
  </style>
</head>

<body>
  <div class="punchin">
    <div class="bg12"></div>
    <div class="rectangle-parent18">
      <div class="frame-child159"></div>
      <a class="frame-child160" style="margin-left: -150px;" id="rectangleLink"> </a>
      <a class="frame-child161" id="rectangleLink1" style="background-color: bisque;cursor: none;margin-left:-150px;"> </a>
      <a class="frame-child162" style="background-color: #E8E8E8;margin-left:-150px;"> </a>
      <a class="frame-child163" style="margin-left: -150px;" id="rectangleLink3"> </a>
      <a class="attendence2" style="margin-left: -155px;" id="attendence">Attendance</a>
      <a class="records2" id="records" style="color:orangered;cursor: none; margin-left:-158px;">Check IN</a>
      <a href="punchout.php" class="punch-inout2" style="color:#000000;margin-left:-135px;">Check OUT</a>
      <a class="my-attendence2" id="myAttendence" style="margin-left: -150px;">My Attendance</a>
      <a href="attendancelog.php" class="frame-child163" id="rectangleLink3" style="margin-left:80px;"> </a>
      <a href="attendancelog.php" class="my-attendence2" id="myAttendence" style="margin-left:75px;">Attendance Log</a>
    </div>
    <img class="punchin-child" alt="" src="./public/rectangle-1@2x.png" />

    <img class="punchin-item" alt="" src="./public/rectangle-2@2x.png" />

    <img class="logo-1-icon12" alt="" src="./public/logo-1@2x.png" />

    <a class="anikahrm12" href="./index.php" id="anikaHRM">
      <span>Anika</span>
      <span class="hrm12">HRM</span>
    </a>
    <a class="attendence-management2" href="./index.php" id="attendenceManagement">Attendance Management</a>
    <button class="punchin-inner"><a href="logout.php" style="color:white; text-decoration:none; font-size:25px; margin-left:20px;">Logout</a></button>
    <div class="payroll12">Payroll</div>
    <div class="reports12">Reports</div>
    <img class="uitcalender-icon12" alt="" src="./public/uitcalender.svg" />

    <img class="arcticonsgoogle-pay12" alt="" src="./public/arcticonsgooglepay.svg" />

    <img class="streamlineinterface-content-c-icon12" alt="" src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg" />

    <!--<img class="punchin-child1" alt="" src="./public/ellipse-1@2x.png" />-->

    <!--<img-->
    <!--  class="material-symbolsperson-icon12"-->
    <!--  alt=""-->
    <!--  src="./public/materialsymbolsperson.svg"-->
    <!--/>-->

    <img class="punchin-child2" alt="" src="./public/rectangle-4@2x.png" />

    <a class="dashboard12" href="./index.php" id="dashboard">Dashboard</a>
    <a class="fluentpeople-32-regular12" id="fluentpeople32Regular">
      <img class="vector-icon62" alt="" src="./public/vector7.svg" />
    </a>
    <a class="employee-list12" id="employeeList">Employee List</a>
    <a class="akar-iconsdashboard12" href="./index.php" id="akarIconsdashboard">
      <img class="vector-icon63" alt="" src="./public/vector3.svg" />
    </a>
    <img class="tablerlogout-icon12" alt="" src="./public/tablerlogout.svg" />

    <a class="leaves12" id="leaves">Leaves</a>
    <a class="fluentperson-clock-20-regular12" id="fluentpersonClock20Regular">
      <img class="vector-icon64" alt="" src="./public/vector1.svg" />
    </a>
    <a class="onboarding14" id="onboarding">Onboarding</a>
    <a class="fluent-mdl2leave-user12" id="fluentMdl2leaveUser">
      <img class="vector-icon65" alt="" src="./public/vector.svg" />
    </a>
    <a class="attendance12" href="attendence.php">Attendance</a>
    <a class="uitcalender12">
      <img class="vector-icon66" alt="" src="./public/vector11.svg" />
    </a>
    <div class="oouinext-ltr"></div>
    <div class="rectangle-parent19">
      <div class="frame-child164" style="height:400px !IMPORTANT;"></div>
      <div class="punch-in">Check IN</div>
      <div class="frame-child165"></div>
      <div class="frame-child165" style="width:780px;"></div>
      <div class="employee-name6" style="margin-top: -45px;">Employee Name</div>
      <div class="employee-name6" style="width:500px;margin-top: 120px;">Reason for Posting Attendance thru System</div>
      <div class="date1" style="width: 500px; margin-top: -90px;">Date - Time</div>

      <form id="updateForm">
        <input class="frame-child167" style="font-size: 20px; margin-top: -95px; height: 35px;" type="datetime-local" name="AttendanceTime" />
        <input type="hidden" value="CheckIn" name="AttendanceType">
        <input type="hidden" value="System" name="InputType">
        <select class="frame-child166" style="font-size: 20px; margin-top: 110px; height: 40px;" name="option" onchange="toggleAddOption()">
          <option value="">--select--</option>
          <option value="Power Cut">Power Cut</option>
          <option value="CAMS instrument fault">CAMS instrument fault</option>
          <option value="Backdated Attendance">Backdated Attendance</option>
          <option value="Other- mention">Other- mention</option>
        </select>
        <input class="frame-child167" placeholder="Write the Reason here" style="font-size: 20px; margin-top: 45px; height: 40px;" type="text" name="addoption" />
        <select class="frame-child166" id="detail" style="font-size: 20px; margin-top: -50px; height: 40px;" name="UserId">
          <option value="">--select--</option>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "ems";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT empname, UserId FROM emp WHERE empstatus=0";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value='" . $row["UserId"] . "'>" . $row["empname"] . "</option>";
            }
          } else {
            echo "0 results";
          }

          $conn->close();
          ?>
        </select>

        <button class="frame-child170" style="margin-top:-100px; color:white; font-size:25px;">IN</button>
      </form>

      <div style="position: absolute; margin-top: 420px; width: 1000px; height: 380px; overflow-y: auto; margin-left: 120px;">
        <table class="data w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">

              </th>
              <th scope="col" class="px-6 py-3">
                Employee Name
              </th>
              <th scope="col" class="px-6 py-3">
                CheckIn Time
              </th>
              <th scope="col" class="px-6 py-3">
                Attendance Type
              </th>
              <th scope="col" class="px-6 py-3">
                Input Type
              </th>
            </tr>
          </thead>
          <?php
          $sql = "SELECT emp.empname, emp.pic, CamsBiometricAttendance.posted, CamsBiometricAttendance.AttendanceTime, CamsBiometricAttendance.AttendanceType, CamsBiometricAttendance.InputType, CamsBiometricAttendance.option, CamsBiometricAttendance.addoption 
FROM emp
INNER JOIN CamsBiometricAttendance ON emp.UserID = CamsBiometricAttendance.UserID 
WHERE CamsBiometricAttendance.AttendanceType = 'CheckIn'
ORDER BY CamsBiometricAttendance.AttendanceTime DESC";



          $que = mysqli_query($con, $sql);
          $cnt = 1;
          while ($result = mysqli_fetch_assoc($que)) {
          ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="px-6 py-4"><img src="pics/<?php echo $result['pic']; ?>" width="40px" height="40px" style="border-radius: 50px; border: 2px solid rgb(161, 161, 161);"></td>
              <td class="px-6 py-4"><?php echo $result['empname']; ?></td>
              <td class="px-6 py-4"><?php echo $result['AttendanceTime']; ?></td>
              <td class="px-6 py-4"><?php echo $result['AttendanceType']; ?></td>
              <td class="px-6 py-4">
                <?php echo $result['InputType']; ?> <span style="font-size:10px !important;"><?php
                                                                                              if ($result['posted'] !== NULL) {
                                                                                                echo date('Y-m-d H:i:s', strtotime('+5 hours 30 minutes', strtotime($result['posted'])));
                                                                                              } else {
                                                                                                echo "";
                                                                                              }
                                                                                              ?>
                </span>
                <BR>
                <?php
                if (!empty($result['addoption'])) {
                  echo "<span style='font-size:16px;border-top:0.1px solid black;white-space:nowrap;'>Reason: " . $result['addoption'] . "</span> ";
                } elseif (!empty($result['option'])) {
                  echo "<span style='font-size:16px;border-top:0.1px solid black;white-space:nowrap;'>Reason: " . $result['option'] . "</span> ";
                } else {
                  echo "";
                }
                ?>
              </td>
            </tr>
          <?php $cnt++;
          } ?>
        </table>

      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      // Initialize Select2 on your dropdown
      $('#detail').select2({
        width: '200px', // Adjust the width as needed
        placeholder: '--sss--',
        minimumResultsForSearch: -1, // Disable search box
      });
    });
  </script>
  <script>
    function toggleAddOption() {
      var optionSelect = document.querySelector('select[name="option"]');
      var addOptionInput = document.querySelector('input[name="addoption"]');

      if (optionSelect.value === 'Other- mention') {
        addOptionInput.style.display = 'block';
      } else {
        addOptionInput.style.display = 'none';
      }
    }

    toggleAddOption();
  </script>

  <script>
    $(document).ready(function() {

      $("#updateForm").submit(function(e) {
        e.preventDefault();

        var userId = $("select[name='UserId']").val();
        var time = $("input[name='AttendanceTime']").val();
        var checkIn = $("input[name='AttendanceType']").val();
        var Type = $("input[name='InputType']").val();
        var option = $("select[name='option']").val();
        var addoption = $("input[name='addoption']").val();

        $.ajax({
          type: "POST",
          url: "update_cams.php",
          data: {
            userId: userId,
            time: time,
            checkIn: checkIn,
            Type: Type,
            option: option,
            addoption: addoption
          },
          success: function(response) {
            Swal.fire({
              icon: 'success',
              title: 'Check In Done!',
              text: response,
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'punch-i-n.php';
              }
            });

            $("select[name='UserId']").val('');
            $("input[name='AttendanceTime']").val('');
            $("input[name='AttendanceType']").val('');
            $("input[name='InputType']").val('');
            $("select[name='option']").val();
            $("input[name='addoption']").val();
          }
        });
      });
    });
  </script>
  <script>
    var rectangleLink = document.getElementById("rectangleLink");
    if (rectangleLink) {
      rectangleLink.addEventListener("click", function(e) {
        window.location.href = "./attendence.php";
      });
    }



    var rectangleLink3 = document.getElementById("rectangleLink3");
    if (rectangleLink3) {
      rectangleLink3.addEventListener("click", function(e) {
        window.location.href = "./my-attendence.php";
      });
    }

    var attendence = document.getElementById("attendence");
    if (attendence) {
      attendence.addEventListener("click", function(e) {
        window.location.href = "./attendence.php";
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
        window.location.href = "./employee-management.php";
      });
    }

    var employeeList = document.getElementById("employeeList");
    if (employeeList) {
      employeeList.addEventListener("click", function(e) {
        window.location.href = "./employee-management.php";
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
        window.location.href = "./leave-management.php";
      });
    }

    var fluentpersonClock20Regular = document.getElementById(
      "fluentpersonClock20Regular"
    );
    if (fluentpersonClock20Regular) {
      fluentpersonClock20Regular.addEventListener("click", function(e) {
        window.location.href = "./leave-management.php";
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

    var rectangle1 = document.getElementById("rectangle1");
    if (rectangle1) {
      rectangle1.addEventListener("click", function(e) {
        window.location.href = "./punch-o-u-t.php";
      });
    }

    var iNText = document.getElementById("iNText");
    if (iNText) {
      iNText.addEventListener("click", function(e) {
        window.location.href = "./punch-o-u-t.php";
      });
    }
  </script>
</body>

</html>