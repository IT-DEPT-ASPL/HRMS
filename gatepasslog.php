<!DOCTYPE html>
<?php
@include 'inc/config.php';
session_start();
$hrmsHost = "localhost";
$hrmsUser = "root";
$hrmsPassword = "";
$hrmsDatabase = "ems";

$leaveManagementHost = "localhost";
$leaveManagementUser = "root";
$leaveManagementPassword = "";
$leaveManagementDatabase = "simpleave";
$hrmsCon = mysqli_connect($hrmsHost, $hrmsUser, $hrmsPassword, $hrmsDatabase);

if (!$hrmsCon) {
  die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
  echo "";
  exit();
}

$sqlStatusCheck = "SELECT empstatus FROM emp WHERE empemail = '{$_SESSION['user_name']}'";
$resultStatusCheck = mysqli_query($hrmsCon, $sqlStatusCheck);
$statusRow = mysqli_fetch_assoc($resultStatusCheck);

if ($statusRow['empstatus'] == 0) {
  $sqlHRMS = "SELECT * FROM emp WHERE empemail = '{$_SESSION['user_name']}'";
  $resultHRMS = mysqli_query($hrmsCon, $sqlHRMS);

  $rowHRMS = mysqli_fetch_assoc($resultHRMS);

  if ($resultHRMS) {
    $leaveManagementCon = mysqli_connect($leaveManagementHost, $leaveManagementUser, $leaveManagementPassword, $leaveManagementDatabase);

    if (!$leaveManagementCon) {
      die("Connection failed: " . mysqli_connect_error());
    }
?>
    <html>

    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="initial-scale=1, width=device-width" />

      <link rel="stylesheet" href="./gatepasslog.css" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" />
    </head>

    <body>
      <section class="gatepasslog">
        <section class="bg"></section>
        <section class="gatepasslog-child"></section>
        <h2 class="gatepass-log">/Gatepass Log</h2>
        <img class="gatepasslog-item" alt="" src="./public/rectangle-2@2x.png" />

        <a class="anikahrm">
          <span>Anika</span>
          <span class="hrm">HRM</span>
        </a>
        <a class="employee-management" id="employeeManagement">Employee Management</a>
        <button class="gatepasslog-inner"></button>
        <div class="logout">Logout</div>
        <a class="leaves">Leaves</a>
        <a class="attendance">Attendance</a>
        <div class="payroll">Payroll</div>
        <a class="fluentperson-clock-20-regular">
          <img class="vector-icon" alt="" src="./public/vector.svg" />
        </a>
        <img class="uitcalender-icon" alt="" src="./public/uitcalender.svg" />

        <img class="arcticonsgoogle-pay" alt="" src="./public/arcticonsgooglepay.svg" />

        <img class="ellipse-icon" alt="" src="./public/ellipse-1@2x.png" />

        <img class="material-symbolsperson-icon" alt="" src="./public/materialsymbolsperson.svg" />

        <a href="employee-dashboard.php">
          <img class="rectangle-icon" alt="" src="./public/rectangle-4@2x.png" /></a>

        <img class="tablerlogout-icon" alt="" src="./public/tablerlogout.svg" />

        <a class="uitcalender">
          <img class="vector-icon1" alt="" src="./public/vector1.svg" />
        </a>
        <a class="dashboard" id="dashboard">Dashboard</a>
        <a class="akar-iconsdashboard" id="akarIconsdashboard">
          <img class="vector-icon2" alt="" src="./public/vector2.svg" />
        </a>
        <img class="logo-1-icon" alt="" src="./public/logo-1@2x.png" />

        <section class="frame-parent" style="width: 1300px;margin-left:-80px;">
          <div style="display: flex; gap: 10px; ">
            <div style="display: flex; gap: 10px;">
              <svg style="margin-left: 40px;" xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 24 24' fill='none' stroke='#4a90e2' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'>
                <path d='M16 17l5-5-5-5M19.8 12H9M10 3H4v18h6' />
              </svg>
              <p style="margin-top: 9px;">: One way pass</p>
            </div>
            <div style="display: flex; gap: 10px; margin-left: 35px;">
              <img src="./public/tick.png" alt="" width="50px" height="50px">
              <p style="margin-top: 9px;">: Employee marked in</p>
            </div>
            <div style="display: flex; gap: 10px; margin-left: 35px;">
              <img style="margin-top: -7px;" src="./public/cross.png" alt="" width="60px" height="60px">
              <p style="margin-top: 9px;">: Employee yet to mark in</p>
            </div>
            <div style="display: flex; gap: 10px; margin-left: 35px;">
              <svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 24 24' fill='none' stroke='#e24a4a' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'>
                <path d='M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z' />
                <path d='M14 3v5h5M9.9 17.1L14 13M9.9 12.9L14 17' />
              </svg>
              <p style="margin-top: 9px;">: Gatepass Rejected</p>
            </div>
          </div>
          <div class="rectangle-parent" style="margin-top:40px;">


            <?php
            $sqlLeaveManagement = "SELECT * FROM leaves WHERE mobile = '{$rowHRMS['empph']}' ORDER BY id DESC";
            $resultLeaveManagement = mysqli_query($leaveManagementCon, $sqlLeaveManagement);

            if ($resultLeaveManagement) {
            ?>

              <?php
              while ($rowLeaveManagement = mysqli_fetch_assoc($resultLeaveManagement)) {
              ?>
                <?php
                $timestamp = strtotime($rowLeaveManagement['leavedate']);
                $formattedDate = date('D', $timestamp);
                $formattedDate1 = date('d', $timestamp);
                $formattedDate2 = date('M', $timestamp);
                $formattedDate3 = date('H\H  i\M', $timestamp);
                $hours = date('H', $timestamp);
                $minutes = date('i', $timestamp);
                $formattedDateWithLabels = "$hours Hrs $minutes mins";

                $timestamp1 = strtotime($rowLeaveManagement['marktime']);
                $hours1 = date('H', $timestamp1);
                $minutes1 = date('i', $timestamp1);
                $formattedDateWithLabels1 = "$hours1 Hrs $minutes1 mins";

                ?>
                <div>
                  <table>
                    <tr>
                      <td>

                        <div class="frame-child" style="width: 1260px;"></div>
                        <p style="filter: contrast(200); margin-left: 190px; margin-top: -90px;">Gatepass ID:</p>
                        <p style="filter: contrast(200);margin-left: 960px; margin-top: -54px;"> <?php echo $rowLeaveManagement['email'] ?></p>
                        <p style="filter: contrast(200);margin-left: 1085px; margin-top: -15px;"> <?php
                                                                                                  if (!empty($rowLeaveManagement['email1'])) {
                                                                                                    echo $rowLeaveManagement['email1'];
                                                                                                  } else {
                                                                                                    echo "[Action Pending]";
                                                                                                  }
                                                                                                  ?></p>
                        <p style="filter: contrast(200); margin-left: 1015px; margin-top: -15px;"> <?php
                                                                                                    if ($rowLeaveManagement['status'] == 0) {
                                                                                                      echo "<span style='color: #fcf00e;'>Pending </span>";
                                                                                                    } elseif ($rowLeaveManagement['status'] == 1) {
                                                                                                      echo "<span style='color: #00ff77;'>Approved</span>";
                                                                                                    } elseif ($rowLeaveManagement['status'] == 2) {
                                                                                                      echo "<span style='color: #f35c17;'>Rejected</span>";
                                                                                                    }

                                                                                                    ?></p>
                        <p style="filter: contrast(200);margin-left: 450px; font-size: 25px; margin-top: -55px;"><?php
                                                                                                                  if ($rowLeaveManagement['status'] == 2) {
                                                                                                                    echo "<span class='badge badge-danger'>[GP Rejected]</span>";
                                                                                                                  } elseif ($rowLeaveManagement['mark'] == 0 & $rowLeaveManagement['way'] == '2 WAY') {
                                                                                                                    echo "<span class='badge badge-danger'>[to be marked]</span>";
                                                                                                                  } elseif ($rowLeaveManagement['mark'] == 0 & $rowLeaveManagement['way'] == '1 WAY') {
                                                                                                                    echo "<span style='font-size:15px !important;' class='badge badge-default'>N/A</span>";
                                                                                                                  } else {
                                                                                                                    echo $formattedDateWithLabels1;
                                                                                                                  }

                                                                                                                  ?></p>
                        <p style="filter: contrast(200);margin-left: 410px; font-size: 25px; margin-top: -55px;">IN:</p>
                        <p style="filter: contrast(200);margin-left: 387px; font-size: 25px; margin-top: -100px;">OUT:</p>
                        <p style="filter: contrast(200);margin-left: 450px; font-size: 25px; margin-top: -55px;"><?php
                                                                                                                  if ($rowLeaveManagement['status'] == 2) {
                                                                                                                    echo "<span class='badge badge-danger'>[GP Rejected]</span>";
                                                                                                                  } else {
                                                                                                                    echo $formattedDateWithLabels;
                                                                                                                  }
                                                                                                                  ?></p>
                        <div class="frame-item" style="margin-top: -75px; margin-left: 8px;"></div>
                        <p style=" color: white; font-weight: 400; filter: contrast(200);margin-left: 20px; font-size: 30px; margin-top: -40px;"><?php echo $formattedDate1; ?> <?php echo $formattedDate2; ?></p>
                        <p style=" color: white; font-weight: 400; filter: contrast(200);margin-left: 30px; font-size: 30px; margin-top: -135px;"><?php echo $rowLeaveManagement['way'] ?></p>
                        <h3 style="color: white; filter: contrast(200); margin-left: 30px; font-size: 34px; margin-top: -35px;"><?php echo $formattedDate; ?></h3>
                        <div class="frame-inner" style="margin-left: 380px; margin-top: -90px;"></div>
                        <div class="line-div" style="margin-left: 820px; margin-top: -78px;"></div>
                        <div class="line-div" style="margin-left: 630px; margin-top: -80px;"></div>
                        <p style="filter: contrast(200);margin-left: 853px; margin-top: -86px;">Issued By:</p>
                        <p style="filter: contrast(200);margin-left: 853px; margin-top: -15px;">Approved/Rejected By:</p>
                        <p style="filter: contrast(200);margin-left: 853px; margin-top: -15px;">Approval Status:</p>
                        <p style="filter: contrast(200);margin-left: 160px; margin-top: -55px;"><?php echo date('Ymd', strtotime($rowLeaveManagement['leavedate'])); ?>-000<?php echo $rowLeaveManagement['id']; ?></p>
                        <p style="filter: contrast(200);margin-left: 640px; font-size: 25px; margin-top: -45px;"><?php if ($rowLeaveManagement['status'] == 2) {
                                                                                                                    echo "<span class='badge badge-danger'> [GP Rejected]</span>";
                                                                                                                  } elseif ($rowLeaveManagement['way'] == '1 WAY') {
                                                                                                                    echo "<span style='font-size:15px !important;' class='badge badge-default'>N/A</span>";
                                                                                                                  } elseif ($rowLeaveManagement['mark'] == 0 & $rowLeaveManagement['way'] == '2 WAY') {
                                                                                                                    echo "<span class='badge badge-danger'>[to be marked]</span>";
                                                                                                                  } elseif ($rowLeaveManagement['status'] == 0) {
                                                                                                                    echo "<span class='badge badge-warning'>Pending <br>for Approval </span>";
                                                                                                                  } else {
                                                                                                                    $date1 = new DateTime(date('Y-m-d H:i:s', strtotime('+12 hours +30 minutes', strtotime($rowLeaveManagement['marktime']))));
                                                                                                                    $date2 = new DateTime($rowLeaveManagement['leavedate']);
                                                                                                                    $interval = $date1->diff($date2);
                                                                                                                    echo $interval->format('%Hhrs %imins');
                                                                                                                  } ?></p>
                        <p style="filter: contrast(200);margin-left: 640px; font-size: 25px; margin-top: -99px;">OUT Duration</p>
                        <?php
                        if ((($rowLeaveManagement['status'] == 0 || $rowLeaveManagement['status'] == 2) & $rowLeaveManagement['way'] == '1 WAY')) {
                          echo "<svg style='margin-top: 20px;' xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 24 24' fill='none' stroke='#4a90e2' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><path d='M16 17l5-5-5-5M19.8 12H9M10 3H4v18h6'/></svg>
                                        ";
                        } elseif ($rowLeaveManagement['status'] == 2) {
                          echo "
                                      <svg style='margin-top: 20px;' xmlns='http://www.w3.org/2000/svg' width='50' height='50' viewBox='0 0 24 24' fill='none' stroke='#e24a4a' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><path d='M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8l-6-6z'/><path d='M14 3v5h5M9.9 17.1L14 13M9.9 12.9L14 17'/></svg>

                                  ";
                        } elseif ($rowLeaveManagement['status'] == 2 & $rowLeaveManagement['way'] == '2 WAY' & $rowLeaveManagement['mark'] == '0') {
                          echo "
                                        <img src='./public/cross.png'  width='65px' style='margin-top: 20px;'>
                                    ";
                        } else {
                          echo "
                                        <img src='./public/tick.png' width='55px' style='margin-top: 20px;'>
                                    ";
                        }

                        ?>

                      </td>

                    <?php
                  }
                    ?>

                  <?php
                } else {
                  echo "Error in Leave Management System query: " . mysqli_error($leaveManagementCon);
                }
                  ?>
                    </tr>
                  </table>
                </div>
          </div>


        </section>
      </section>
  <?php
    mysqli_close($leaveManagementCon);
  } else {
    echo "Error in HRMS query: " . mysqli_error($hrmsCon);
  }

  mysqli_close($hrmsCon);
} else {
  echo "";
  exit();
}
  ?>
  <script>
    var employeeManagement = document.getElementById("employeeManagement");
    if (employeeManagement) {
      employeeManagement.addEventListener("click", function(e) {
        // Please sync "Homepage" to the project
      });
    }

    var dashboard = document.getElementById("dashboard");
    if (dashboard) {
      dashboard.addEventListener("click", function(e) {
        // Please sync "Homepage" to the project
      });
    }

    var akarIconsdashboard = document.getElementById("akarIconsdashboard");
    if (akarIconsdashboard) {
      akarIconsdashboard.addEventListener("click", function(e) {
        // Please sync "Homepage" to the project
      });
    }
  </script>
    </body>

    </html>