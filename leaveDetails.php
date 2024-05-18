<?php

@include 'inc/config.php';

session_start();

if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
  header('location:loginpage.php');
}

$user_name = $_SESSION['user_name'];
$query = "SELECT user_type FROM user_form WHERE email = '$user_name'";
$result = mysqli_query($con, $query);

if ($result) {
  $row = mysqli_fetch_assoc($result);
  $user_type = $row['user_type'];

  if ($user_type !== 'admin') {
    header('location:loginpage.php');
  }
} else {
  die("Error: Unable to fetch user details.");
}

?>
<?php
$ID = $_GET['id'];
$query = mysqli_query($con, "
    SELECT l.*, e.pic, lb.cl, lb.sl, lb.co 
    FROM leaves l 
    JOIN emp e ON l.empname = e.empname 
    JOIN leavebalance lb ON l.empname = lb.empname 
    WHERE l.id='$ID'
");
$row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />

  <link rel="stylesheet" href="./css/leaveOverview.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>
<style>
  .addin {
    border: 1px solid #FA840D;
    border-radius: 7px
  }

  .remove {
    display: none;
  }

  input {
    font-size: 15px !important;
  }

  a:hover {
    text-decoration: none;
    color: inherit;
  }
</style>

<body>
  <div class="leaveoverview">
    <div class="bg"></div>
    <img class="leaveoverview-child" alt="" src="./public/rectangle-1@2x.png" />

    <img class="leaveoverview-item" alt="" src="./public/rectangle-2@2x.png" />

    <img class="logo-1-icon" alt="" src="./public/logo-1@2x.png" />

    <a class="anikahrm" id="anikaHRM">
      <span>Anika</span>
    </a>
    <a class="leave-management" id="leaveManagement" style="color: white;">Leave Management</a>
    <button class="leaveoverview-inner"></button>
    <div class="logout">Logout</div>
    <a class="onboarding" href="./onboarding.php" id="onboarding">Onboarding</a>
    <a class="attendance" href="./attendence.php" id="attendance">Attendance</a>
    <div class="payroll">Payroll</div>
    <div class="reports">Reports</div>
    <a class="fluent-mdl2leave-user" id="fluentMdl2leaveUser">
      <img class="vector-icon" alt="" src="./public/vector.svg" />
    </a>
    <img class="uitcalender-icon" alt="" src="./public/uitcalender@2x.png" />

    <img class="arcticonsgoogle-pay" alt="" src="./public/arcticonsgooglepay.svg" />

    <img class="streamlineinterface-content-c-icon" alt="" src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg" />

    <!--<img class="ellipse-icon" alt="" src="./public/ellipse-1@2x.png" />-->

    <!--<img class="material-symbolsperson-icon" alt="" src="./public/materialsymbolsperson.svg" />-->

    <img class="rectangle-icon" style="margin-left: 30px;" alt="" src="./public/rectangle-4@2x.png" />

    <a class="dashboard" href="./index.php" id="dashboard">Dashboard</a>
    <a class="fluentpeople-32-regular" id="fluentpeople32Regular">
      <img class="vector-icon1" alt="" src="./public/vector7.svg" />
    </a>
    <a class="employee-list" href="./employee-management.php" id="employeeList">Employee List</a>
    <a class="akar-iconsdashboard" id="akarIconsdashboard">
      <img class="vector-icon2" alt="" src="./public/vector3.svg" />
    </a>
    <img class="tablerlogout-icon" alt="" src="./public/tablerlogout.svg" />

    <a class="uitcalender" id="uitcalender">
      <img class="vector-icon3" alt="" src="./public/vector4.svg" />
    </a>
    <a class="leaves" style="color: white;">Leaves</a>
    <a class="fluentperson-clock-20-regular">
      <img class="vector-icon4" alt="" src="./public/vector10.svg" />
    </a>
    <section class="rectangle-parent">
      <div class="frame-child" style="height: 780px;"></div>
      <h3 class="leave-details">Leave Details</h3>
      <!-- edit icon -->
      <?php
      $status1 = $row['status1'];
      $status = $row['status'];
      ?>

      <?php if ($status1 !== '1' && $status !== '2') : ?>
        <img src="./public/edit-xxl.png" style="position: absolute; width: 37px; margin-left: 1000px; margin-top: 20px; cursor: pointer;" onclick="updateFunc(); updateFunc1();" alt="" readonly />


      <?php endif; ?>
      <!-- / -->

      <?php
      if (!empty($row['hrtime'])) {
        echo '<p style="position: absolute; margin-left: 50px; margin-top: 35px; font-size:15px;">Modified Leave Details On <b>' . date('d-m-Y H:i:s', strtotime('+5 hours +30 minutes', strtotime($row['hrtime']))) . '</b> </p>';
      }
      ?>

      <input class="mohan-reddy" type="text" style="margin-left:-10px; font-size:20px !important; width:200px;" value="<?php echo $row['empname']; ?>" readonly />
      <input class="naradamohan1gmailcom" type="email" style="width:290px; margin-left:-20px; font-size:20px !important;" value="<?php echo $row['empemail']; ?>" readonly />
      <form id="employeeForm">
        <?php
        $leavetype2 =  $row['leavetype2'];

        if ($leavetype2 === 'FN' || $leavetype2 === 'AN') {
          echo '<input class="input" style="margin-left:-20px; font-size:20px !important;"  type="datetime-local" name="from" value="' . date('Y-m-d\TH:i', strtotime($row['from'])) . '" readonly/>';
          echo '<input class="input3" style="margin-left:-20px; font-size:20px !important;"  type="datetime-local" name="to" value="' . date('Y-m-d\TH:i', strtotime($row['to'])) . '" readonly />';
        } else {
          echo '<input class="input" style="margin-left:-8px; font-size:20px !important;" id="ghjk" type="date" name="from" value="' . date('Y-m-d', strtotime($row['from'])) . '" readonly/>';
          echo '<input class="input3" style="margin-left:-8px; font-size:20px !important;" id="asdf" type="date" name="to" value="' . date('Y-m-d', strtotime($row['to'])) . '" readonly />';
        }
        ?>
        <div class="modal" id="second-modal" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-second-modal-close close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="position:absolute; left:20px;">Leave Reason</h4>
              </div>
              <div class="modal-body" style="height:300px;">
                <textarea name="reason" style="font-weight:100; font-size:18px; width:100%; height:100%; border:none; resize:none;" id="tyui" readonly>
        <?php echo $row['reason']; ?>
        </textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="margin-lg" style="position: absolute; z-index: 999999999999; margin-left: 500px; margin-top: 370px;">
          <button type="button" class="btn-second-modal btn btn-sm" style="background-color: rgb(66, 66, 255); color: white;">
            Click to view reason
          </button>

        </div>
        <div class="margin-lg" style="position: absolute; z-index: 999999999999; margin-left: 695px; margin-top: 380px;">LB:<?php echo $row['co'] + $row['cl'] + $row['sl']; ?> </div>
        <textarea class="fever" style="font-size:22px;overflow:hidden; margin-left:-95px; resize:none; width:800px;" name="reason" readonly>
             <?php $empname = $row['reason'];
              echo strlen($empname) > 22 ? substr($empname, 0, 22) . '...' : $empname;
              ?>
        </textarea>
        <?php
        if (!is_null($row['hrremark'])) {
        ?>
          <p class="approver-remark" style="font-size:22px;">HR Remarks:</p>
          <textarea name="hrremark" class="fever1" style="margin-left:-85px; margin-top:-4px; font-size:22px;" readonly id="qwer"><?php echo $row['hrremark']; ?></textarea>

        <?php
        }
        ?>
        <button class="rectangle-button remove" id="updatebtn" style="color: white; text-align: center; margin-top: 90px; margin-left: 420px;">Update</button>
      </form>

      <div class="casual-leave" style="font-size:20px; margin-top:5px; margin-left:-7px;">
        <?php echo $row['leavetype']; ?>
        <?php if (!empty($row['leavetype2'])) {
          echo $row['leavetype2'];
        } ?>
      </div>

      <input class="input2" type="tel" style="margin-left:-20px; font-size:20px !important;" value="<?php echo $row['empph']; ?>" readonly />/>
      <input class="input1" type="text" style="margin-left:-20px; font-size:20px !important;" value="<?php echo date('d-m-Y', strtotime('+12 hours +30 minutes', strtotime($row['applied']))); ?>" readonly />
      <?php
      $status = $row['status'];
      $status1 = $row['status1'];
      ?>
      <p class="pending" style="margin-top:7px;">
        <?php
        if ($status == '2' && $status1 == '0') {
          echo '<span class=\'bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 inline-flex items-center rounded dark:bg-gray-700 dark:text-pink-400 border border-pink-400\'>
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v18H3zM15 9l-6 6m0-6l6 6"/></svg>
      Rejected
      </span>';
        } elseif ($status == '2' && $status1 == '1') {
          echo '<span class=\'bg-pink-100 text-pink-800 text-xs font-medium me-2 px-2.5 py-0.5 inline-flex items-center rounded dark:bg-gray-700 dark:text-pink-400 border border-pink-400\'>
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" fill="none" stroke="#d0021b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v18H3zM15 9l-6 6m0-6l6 6"/></svg>
      Approver Rejected
      </span>';
        } elseif ($status == '1' && $status1 == '1') {
          echo '<span class=\'bg-green-100 text-green-800 text-xs font-medium inline-flex items-center me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400\'>
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 24 24" fill="none" stroke="#417505" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
    Approved
      </span>';
        } elseif ($status == '0' && $status1 == '0') {
          echo '<span class=\'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 inline-flex items-center rounded dark:bg-gray-700 dark:text-red-400 border border-red-400\'>
      <svg xmlns=\'http://www.w3.org/2000/svg\' width=\'22\' height=\'20\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'#fb0b0b\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'>
          <path d=\'M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z\'></path>
          <line x1=\'12\' y1=\'9\' x2=\'12\' y2=\'13\'></line>
          <line x1=\'12\' y1=\'17\' x2=\'12.01\' y2=\'17\'></line>
      </svg>
      HR-Action Pending
      </span>';
        } elseif ($status == '3' && $status1 == '0') {
          echo '<span class=\'bg-yellow-100 text-yellow-800 text-xs font-medium inline-flex items-center px-3 py-1.5 rounded dark:bg-gray-700 dark:text-yellow-400 border border-yellow-400\'>
        <svg class=\'w-3.5 h-5.5 me-1\' aria-hidden=\'true\' xmlns=\'http://www.w3.org/2000/svg\' fillF=\'currentColor\' viewBox=\'0 0 20 20\'>
        <path d=\'M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z\'/>
        </svg>Pending at Approver
        </span> ';
        }
        ?>
      </p>
      <p class="employee-name">Employee Name:</p>
      <p class="email">Email:</p>
      <p class="leave-from">Leave From:</p>
      <p class="leave-appied">Leave Applied:</p>
      <p class="leave-type">Leave Type:</p>
      <p class="contact">Contact:</p>
      <p class="leave-to">Leave To:</p>
      <p class="status">Status:</p>
      <img class="screenshot-2023-10-27-141446-1" alt="Employee Image" src="pics/<?php echo $row['pic']; ?>" style="height:170px;" />
      <p class="leave-reason" style="font-size:22px; margin-top:-10px">Leave Reason:</p>

      <!-- Approver Code -->
      <?php
      if ($row['status1'] == 1 || $row['status'] == 2 || ($row['status1'] == 0 &&  $row['status'] == 1)) {
      ?>
        <p class="approver-action-on" style="margin-left: 560px;">Action Perfomed at:</p>
        <p class="approver-action-on">Approver:</p>
        <?php
        if (!is_null($row['aprtime'])) {
        ?>
          <p class="fever2" style="width: 300px; margin-left: 553px; margin-top:8px; font-size: 18px;">
            <?php echo date('d-m-Y H:i:s', strtotime('+5 hours +30 minutes', strtotime($row['aprtime']))); ?>
          </p>
        <?php
        } else if (!is_null($row['mgrtime'])) {
        ?>
          <p class="fever2" style="width: 300px; margin-left: 553px; margin-top:8px; font-size: 18px;">
            <?php echo date('d-m-Y H:i:s', strtotime('+5 hours +30 minutes', strtotime($row['mgrtime']))); ?>
          </p>
        <?php
        } else {
        ?>
          <p class="fever2" style="margin-left: 550px;font-size: 15px;"> Action Pending</p>
        <?php
        }
        ?>
        <?php
        if (!empty($row['aprname'])) {
        ?>
          <p class="fever2" style="width: 300px; margin-left:-120px; margin-top:2px;"><?php echo $row['aprname']; ?></p>
        <?php
        } else {
        ?>
          <p class="fever2" style="width: 300px; margin-left:-120px; margin-top:2px;"><?php echo $row['mgrname']; ?></p>
        <?php
        }
        ?>

      <?php
      } else {
      }
      ?>
      <?php
      if (($row['status'] == "2")) {
      ?>
        <p class="leave-reason" style="margin-top: 200px;">Rejection Reason:</p>
        <p class="fever2" style="font-size: 22px; margin-top: 72px; margin-left: 0px;">
          <?php echo $row['mgrremark'] !== null ? $row['mgrremark'] : $row['aprremark']; ?>
        </p>
        <div class="frame-child9" style="height: 61px; margin-top: 495px;"></div>
        <div class="frame-child6" style="height: 61px; margin-top: 495px;"></div>
        <div class="frame-inner" style="margin-top: 60px;"></div>
      <?php
      }
      ?>
      <div class="frame-inner"></div>
      <div class="frame-child8" style="margin-top: 421px; height: 72px; margin-left: -50px;"></div>
      <div class="frame-child9" style="height: 70px; margin-top: 425px;"></div>
      <div class="frame-child6" style="height: 70px; margin-top: 425px;"></div>
      <!-- end of approver code -->
      <div class="frame-item"></div>
      <div class="line-div"></div>
      <div class="frame-child1"></div>
      <div class="frame-child2"></div>
      <div class="frame-child3"></div>
      <div class="frame-child4"></div>
      <div class="frame-child5"></div>
      <div class="frame-child6" style="height: 422px; margin-top: 2px;"></div>
      <div class="frame-child7"></div>
      <div class="frame-child8"></div>
      <div class="frame-child9" style="height: 422px; margin-top: 2px;"></div>
      <?php
      $status1 = $row['status1'];
      $status = $row['status'];
      ?>
      <?php if (($status1 == '0'  &&  $status == '0') || ($status1 == '0'  &&  $status == '4') || ($status1 == '0'  &&  $status == '3')) : ?>
        <button class="rectangle-button" id="modalOpen" style="color: white; text-align: center; margin-top: 90px;">Set Action</button>
        <button class="rectangle-button remove" onclick="window.location.reload();" id="cancelbtn" style="color: white; background-color: #ff3434; text-align: center; margin-top: 90px; margin-left: 230px;">Cancel</button>
      <?php endif; ?>

      <div class="modal fade" id="theModal" tabindex="-1" role="dialog" aria-labelledby="theModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Set Action</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="margin-left: 90px;">
              <label style="font-size: 17px;" for="approve">Perform Action</label><br>
              <form id="updateForm" data-id="<?php echo $ID; ?>">
                <select name="status" id="approve" onchange="approveFunc(); existingFunction();" style="border-radius: 5px; font-size: 17px; width: 300px; height: 40px;">
                  <option selected disabled value="">--Choose--</option>
                  <option id="sendmanager" value="4">Send to Manager</option>
                  <option id="sendapprover" value="3">Send to Approver</option>
                  <option value="2">Reject</option>
                </select><br id="qwsa" class="remove">
                <label class="remove" style="font-size: 17px;" id="appp3p" for="app">Select Manager</label><br id="asdfghj" class="remove">

                <input type="hidden" name="email">
                <input type="text" name="mgrname" id="mgrname">

                <input type="hidden" id="empname" name="empname" value="<?php echo $row['empname']; ?>">

                <select id="managerDropdown" style="display:none;">
                  <option value="">--select--</option>
                  <?php
                  $dbHost = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "ems";

                  $conn = new mysqli($dbHost, $username, $password, $dbname);

                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT empname, email FROM manager";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row["empname"] . "' data-email='" . $row["email"] . "'>" . $row["empname"] . "</option>";
                    }
                  } else {
                    echo "0 results";
                  }
                  $conn->close();
                  ?>
                </select> 
                <br id="qwsa1" class="remove">

                <label class="remove" style="font-size: 17px;" id="appp2p" for="app">Select Approver</label><br>
                <input type="hidden" name="apremail">

                <select class="remove" name="aprname" id="approverDropdown" onchange="fetchEmail()" style="border-radius: 5px; font-size: 17px; width: 300px; height: 40px;">
                  <option value="">--select--</option>
                  <?php
                  $dbHost = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "ems";

                  $conn = new mysqli($dbHost, $username, $password, $dbname);

                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  $sql = "SELECT aprname, apremail FROM approver";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row["aprname"] . "' data-email='" . $row["apremail"] . "'>" . $row["aprname"] . "</option>";
                    }
                  } else {
                    echo "0 results";
                  }

                  $conn->close();
                  ?>
                </select> <br id="qwsa2" class="remove">
                <label for="" style="font-size: 17px;">Remarks</label><br>
                <textarea name="remark" style="border-radius: 5px; font-size: 17px;resize: none;" id="" cols="30" rows="2"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" data-dismiss="modal">Close</button>
              <button type="submit" class="focus:outline-none text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" id="modalClose">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js'></script>
<script>
  function fetchEmail() {
    var selectedAprName = document.getElementById('app').value;
    var apremailInput = document.getElementsByName('apremail')[0];

    var selectedOption = document.querySelector('#app option[value="' + selectedAprName + '"]');
    var selectedEmail = selectedOption ? selectedOption.getAttribute('data-email') : '';


    apremailInput.value = selectedEmail;
  }
</script>
<script>
  function fetchEmail2() {
    var selectedAprName2 = document.getElementById('app').value;
    var apremailInput2 = document.getElementsByName('email')[0];

    var selectedOption = document.querySelector('#app option[value="' + selectedAprName2 + '"]');
    var selectedEmail = selectedOption ? selectedOption.getAttribute('data-email') : '';


    apremailInput2.value = selectedEmail;
  }
</script>
<script>
    function existingFunction() {
        console.log("Existing function triggered"); // Debug: Log function trigger
        var selectBox = document.getElementById("approve");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;

        console.log("Selected value:", selectedValue); // Debug: Log selected value

        // Retrieve the employee name from the appropriate element on the page
        var empNameElement = document.getElementById("empname");
        var empname = empNameElement.value;

        console.log("Employee name:", empname); // Debug: Log employee name

        if (selectedValue === "4" && empname) { // If "Send to Manager" option is selected and empname is not empty
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                console.log("XHR ReadyState:", this.readyState); // Debug: Log XHR ready state
                if (this.readyState == 4) {
                    console.log("XHR Status:", this.status); // Debug: Log XHR status
                    if (this.status == 200) {
                        console.log("Response:", this.responseText); // Debug: Log XHR response
                        document.getElementById("mgrname").value = this.responseText; // Update mgrname input field
                    } else {
                        console.error("XHR request failed"); // Debug: Log XHR failure
                    }
                }
            };
            xhr.open("GET", "get_manager_name.php?empname=" + empname, true); // Pass empname as a parameter in the URL
            console.log("Sending XHR request"); // Debug: Log XHR send
            xhr.send();
        }
    }
</script>


<script>
  $(document).ready(function() {
    $("#modalOpen").click(function() {
      $("#theModal").modal("show");
    });

    $("#updateForm").submit(function(event) {
      event.preventDefault();

      var formData = $(this).serialize();

      var id = $(this).data('id');
      formData += '&id=' + id;

      Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        }
      });

      $.ajax({
        type: "POST",
        url: "update_leaves.php",
        data: formData,
        dataType: "json",
        success: function(response) {
          Swal.close();

          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message,
            }).then(function() {
              $("#theModal").modal("hide");
              window.location.href = 'leave-management.php';
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error updating leave record: ' + response.message,
            });
          }
        },
        error: function(xhr, status, error) {
          Swal.close();

          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error updating leave record. Please try again. Status: ' + status + ', Error: ' + error,
          });
        }
      });
    });

    $("#modalClose").click(function() {
      $("#theModal").modal("hide");
    });
  });

  function updateFunc() {
    document.getElementById('asdf').removeAttribute('readonly');
    document.getElementById('ghjk').removeAttribute('readonly');

    document.getElementById('tyui').removeAttribute('readonly');
    document.getElementById('updatebtn').classList.remove('remove');
    document.getElementById('modalOpen').classList.add('remove');
    document.getElementById('cancelbtn').classList.remove('remove');
    document.getElementById('asdf').classList.add('addin');
    document.getElementById('ghjk').classList.add('addin');
    document.getElementById('tyui').classList.add('addin');
    document.getElementById('qwer').classList.add('addin');
    document.getElementById('qwer').removeAttribute('readonly');

  }
  document.addEventListener('DOMContentLoaded', function() {
    function updateFunc1() {

      var qwerElement = document.getElementById('qwer');
      var tyuiElement = document.getElementById('tyui');

      if (qwerElement) {
        qwerElement.classList.add('addin');
        if (qwerElement.hasAttribute('readonly')) {
          qwerElement.removeAttribute('readonly');
          console.log("qwer updated");
        }
      }

      if (tyuiElement) {
        tyuiElement.classList.add('addin');
        if (tyuiElement.hasAttribute('readonly')) {
          tyuiElement.removeAttribute('readonly');
          console.log("tyui updated");
        }
      }

      document.getElementById('updatebtn').classList.remove('remove');
      document.getElementById('modalOpen').classList.add('remove');
      document.getElementById('cancelbtn').classList.remove('remove');
    }
    var imgElement = document.querySelector('img[src="./public/edit-xxl.png"]');
    if (imgElement) {
      imgElement.addEventListener('click', updateFunc1);
    }
  });

  function approveFunc() {
    var dropdown1 = document.getElementById('approve');
    var dropdown234 = document.getElementById('managerDropdown');
    var dropdownApproval = document.getElementById('approverDropdown');

    if (dropdown1.value === '3') {
      //   dropdown234.classList.remove('remove');
      document.getElementById('appp2p').classList.remove('remove');
      document.getElementById('qwsa').classList.remove('remove');
      document.getElementById('qwsa2').classList.remove('remove');

      document.getElementById('approverDropdown').classList.remove('remove');
      document.getElementById('sendmanager').classList.add('remove');
      //   dropdownApproval.classList.add('remove');
    } else if (dropdown1.value === '4') {
      dropdown234.classList.remove('remove');
      document.getElementById('appp3p').classList.remove('remove');
      document.getElementById('qwsa').classList.remove('remove');
      document.getElementById('qwsa1').classList.remove('remove');
      document.getElementById('sendapprover').classList.add('remove');
      document.getElementById('asdfghj').classList.remove('remove');
    } else if (dropdown1.value === '2') {
      dropdown234.classList.add('remove');
      document.getElementById('qwsa').classList.add('remove');
      document.getElementById('qwsa1').classList.add('remove');
      document.getElementById('appp2p').classList.add('remove');
      document.getElementById('appp3p').classList.add('remove');
      document.getElementById('sendapprover').classList.remove('remove');
      document.getElementById('sendmanager').classList.remove('remove');
      dropdownApproval.classList.add('remove');
    }
  }
</script>

<script>
  $(document).ready(function() {
    $('#employeeForm').submit(function(e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: 'update_leavedetail.php?id=<?php echo $ID; ?>',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(response) {
          if (response === 'ok') {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Leaves Details Updated successfully!',
            }).then(function() {
              window.location.href = "leaveDetails.php?id=<?php echo $ID; ?>";
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Form submission failed!',
            });
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>
<script>
  var within_first_modal = false;
  $('.btn-second-modal').on('click', function() {
    if ($(this).hasClass('within-first-modal')) {
      within_first_modal = true;
      $('#first-modal').modal('hide');
    }
    $('#second-modal').modal('show');
  });

  $('.btn-second-modal-close').on('click', function() {
    $('#second-modal').modal('hide');
    if (within_first_modal) {
      $('#first-modal').modal('show');
      within_first_modal = false;
    }
  });

  $('.btn-toggle-fade').on('click', function() {
    if ($('.modal').hasClass('fade')) {
      $('.modal').removeClass('fade');
      $(this).removeClass('btn-success');
    } else {
      $('.modal').addClass('fade');
      $(this).addClass('btn-success');
    }
  });
</script>

</html>