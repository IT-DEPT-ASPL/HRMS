<?php
@include '../inc/config.php';
session_start();


if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              icon: 'error',
              title: 'Account Terminated',
            text: 'Login Again, if your still facing issues Contact HR!',
            }).then(function() {
              window.location.href = 'login-mob.php';
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
    <link rel="stylesheet" href="./empmobcss/emp-dashboard-mob.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" />
    <style>
      .calendar-container {
        height: auto;
        width: 400px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.4);
        padding: 20px 20px;
      }

      .calendar-week {
        display: flex;
        list-style: none;
        align-items: center;
        padding-inline-start: 0px;
      }

      .calendar-week-day {
        max-width: 57.1px;
        width: 100%;
        text-align: center;
        color: #525659;
      }

      .calendar-days {
        margin-top: 30px;
        list-style: none;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
        gap: 20px;
        padding-inline-start: 0px;
      }

      .calendar-day {
        text-align: center;
        color: #525659;
        padding: 10px;
      }

      .calendar-month-arrow-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .calendar-month-year-container {
        padding: 10px 10px 20px 10px;
        color: #525659;
        cursor: pointer;
      }

      .calendar-arrow-container {
        margin-top: -5px;
      }

      .calendar-left-arrow,
      .calendar-right-arrow {
        height: 30px;
        width: 30px;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        color: #525659;
      }

      .calendar-today-button {
        margin-top: -10px;
        border-radius: 10px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        color: #525659;
        padding: 5px 10px;
      }

      .calendar-today-button {
        height: 27px;
        margin-right: 10px;
        background-color: #ec7625;
        color: white;
      }

      .calendar-months,
      .calendar-years {
        flex: 1;
        border-radius: 10px;
        height: 30px;
        border: none;
        cursor: pointer;
        outline: none;
        color: #525659;
        font-size: 15px;
      }

      .calendar-day-active {
        background-color: #ec7625;
        color: white;
        border-radius: 50%;
      }

      .calendar-day-holiday {
        color: #cc0000 !important;
      }

      .holiday-name {
        font-size: 10px;
        color: #ff0000;
        text-align: start !important;
        position: absolute;
        transform: translateX(-20%);
      }

      .holiday-style {
        background-color: #ffcccc !important;
        color: #cc0000 !important;
      }

      .holiday-name-style {
        font-size: 10px;
        color: #ff0000;
        text-align: start !important;
        position: absolute;
        transform: translateX(-20%);
      }

      .logo-1-icon10 {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 55px;
        height: 55px;
        object-fit: cover;
      }
    </style>
  </head>

  <body>
    <div class="empdashboard-mob" style="height: 100svh;">
      <div class="logo-1-parent7">
        <img class="logo-1-icon9" alt="" src="./public/logo-1@2x.png" />
        <a class="employee-management8" style="width: 300px;">Employee Management</a>
      </div>
      <a href="../logout.php"><img class="logo-1-icon10" alt="" src="./public/Logout-removebg-preview.png" /></a>
      <div class="empdashboard-mob-child"></div>
      <div class="fluentperson-clock-20-regular-parent3">
        <a class="fluentperson-clock-20-regular9" id="fluentpersonClock20Regular">
          <img class="vector-icon33" alt="" src="./public/vector1@2xleaves.png" />
        </a>
        <a class="uitcalender9" id="uitcalender">
          <img class="vector-icon34" alt="" src="./public/vector2@2xatten.png" />
        </a>
        <img class="arcticonsgoogle-pay9" alt="" src="./public/arcticonsgooglepay1@2x.png" id="arcticonsgooglePay" />

        <div class="frame-child74"></div>
        <a class="akar-iconsdashboard9">
          <img class="vector-icon35" alt="" src="./public/vector.svg" />
        </a>
      </div>
      <div class="empdashboard-mob-item"></div>
      <div class="frame-parent3" style="height: 60px;">
        <div class="rectangle-parent29">
          <a class="frame-child75" id="rectangleLink"> </a>
          <a class="gatepass-log1" id="gatepassLog">Gatepass Log</a>
        </div>
        <div class="rectangle-parent30" id="frameContainer3">
          <a class="frame-child76"> </a>
          <a class="personal-details5" id="personalDetails">Personal Details</a>
        </div>
        <div class="rectangle-parent31" id="frameContainer4">
          <a class="frame-child76"> </a>
          <a class="job4" id="job">Job</a>
        </div>
        <div class="rectangle-parent32" id="frameContainer5">
          <a class="frame-child76"> </a>
          <a class="salary4" id="salary">Salary</a>
        </div>
        <div class="rectangle-parent33" id="frameContainer6">
          <a class="frame-child76"> </a>
          <a class="documents4" id="documents">Documents</a>
        </div>
      </div>
      <?php
      $sql = "SELECT * FROM emp WHERE (empemail = '" . $_SESSION['user_name'] . "' && empstatus= 0 )";
      $que = mysqli_query($con, $sql);
      $cnt = 1;
      $row = mysqli_fetch_array($que);
      ?>
      <div class="frame-parent4" style="width: 450px; overflow-x: hidden;">
        <div class="rectangle-parent34">
          <div class="frame-child80"></div>
          <input class="input12" value="<?php $orgDate = $row['empdob'];
                                        $newDate = date("d-m-Y", strtotime($orgDate));
                                        echo $newDate;  ?>" type="text" readonly />

          <img style="border-radius:100px;" class="screenshot-2023-10-27-141446-1" alt="" src="../pics/<?php echo $row['pic']; ?>" />

          <img class="frame-child81" alt="" src="./public/frame-153@2x.png" />

          <h3 class="basic-info">Basic Info</h3>
          <p class="gender1">Gender:</p>
          <input class="male" value="<?php echo $row['empgen']; ?>" type="text" readonly />

          <p class="marital-status1">Marital Status:</p>
          <input class="single" value="<?php echo $row['empms']; ?>" type="text" readonly />

          <p class="date-of-birth1">Date of Birth:</p>
          <img class="solarsuitcase-outline-icon" alt="" src="./public/solarsuitcaseoutline.svg" />

          <h3 class="job-info">Job Info</h3>
          <p class="joining-date24112022">Joining Date: <?php echo $row['empdoj']; ?></p>
          <p class="department-it" style="margin-top:-5px">Designation: <?php echo $row['desg']; ?></p>
          <input class="aspl202211240019" value="<?php echo $row['emp_no']; ?>" type="text" readonly />
          <input class="aspl202211240019" style="margin-top: 22px; width: 250px;" value="<?php echo $row['empname']; ?>" type="text" readonly />
        </div>
        <div class="rectangle-parent35">
          <div class="frame-child82"></div>
          <input class="naradamohan1gmailcom" value="<?php echo $row['empemail']; ?>" style="width: 200px;" type="email" readonly />

          <input class="input13" value="<?php echo $row['empph']; ?>" type="tel" readonly />

          <div class="vector-wrapper">
            <img class="vector-icon36" alt="" src="./public/vector8contact.svg" />
          </div>
          <h3 class="contact-info">Contact Info</h3>
          <p class="phone">Phone:</p>
          <p class="email">
            <span class="email1">Email:</span>
          </p>
        </div>
        <div class="rectangle-parent36">
          <?php
          $sql = "SELECT * FROM leavebalance WHERE empemail = '{$_SESSION['user_name']}'";
          $que = mysqli_query($con, $sql);
          $cnt = 1;
          if (mysqli_num_rows($que) == 0) {
            echo '<tr><td colspan="5" style="text-align:center;">Stay tuned for upcoming updates on your leave balance! Keep an eye on this space for exciting developments.</td></tr>';
          } else {
            while ($result = mysqli_fetch_assoc($que)) {
          ?>
              <div class="frame-child83" style="height:250px">
              <div>
                <p style="font-size:9px; font-weight:400;margin-left:12px; margin-top:30px; color:#8a7561">(Updated as of <b><?php echo date('Y-m-d H:i:s', strtotime($result['lastupdate'] . ' +5 hours +30 minutes')); ?> </b>)</p>
                </div>
                <div style="position:absolute; z-index:9999; display:flex; scale:0.63; margin-left:-120px; margin-top:-60px">
                  <div style="background-color:#f6f5fb; width:250px; height:310px; border-radius:20px; margin-left:30px;"> <br />
                    <div style="border:2px solid #dadada; width:90%;margin-left:auto; margin-right:auto; border-radius:20px">
                      <img src="../public/Casualleavee.png" width="70px" style="margin-left:85px; margin-top:10px;" />
                      <p style="font-size:18px; font-weight:400;margin-left:15px;">Leave Balance(SL + CL)*</p>
                      <p style="font-size:16px; font-weight:400;margin-left:10px; margin-top:-10px; color:#8a7561">*Leave Balance Allocated (for the fiscal year April 2023 - March 2024)</p>
                      <p style="font-size:16px; font-weight:400;margin-left:15px; margin-top:-5px; color:#8a7561"></p>
                    </div>
                    <p style="font-size:16px; font-weight:400;margin-left:15px; margin-top: 10px;">Allocated Leave(s)* - <b><?php echo  $result['icl'] + $result['isl']; ?></b></p>
                    <p style="font-size:16px; font-weight:400;margin-left:15px; margin-top: 10px;">Remaining Leave balance - <b><?php echo  $result['cl'] + $result['sl']; ?></b></p>
                  </div>
                  <div style="background-color:#f6f5fb; width:250px; height:310px; border-radius:20px; margin-left:30px;"> <br />
                    <div style="border:2px solid #dadada; width:90%;margin-left:auto; margin-right:auto; border-radius:20px">
                      <img src="../public/Compoff.png" width="70px" style="margin-left:85px; margin-top:10px;" />
                      <p style="font-size:18px; font-weight:400;margin-left:15px;">Comp. Off's*</p>

                      <p style="font-size:16px; font-weight:400;margin-left:15px; margin-top:-10px; color:#8a7561">*Comp.Off(s) Earned (between the fiscal year April 2023 - March 2024)
                        <!-- <a style="margin-top:20px;">
                      <svg width="24" height="24" style="scale:0.6" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="M14.851 11.923c-.179-.641-.521-1.246-1.025-1.749-1.562-1.562-4.095-1.563-5.657 0l-4.998 4.998c-1.562 1.563-1.563 4.095 0 5.657 1.562 1.563 4.096 1.561 5.656 0l3.842-3.841.333.009c.404 0 .802-.04 1.189-.117l-4.657 4.656c-.975.976-2.255 1.464-3.535 1.464-1.28 0-2.56-.488-3.535-1.464-1.952-1.951-1.952-5.12 0-7.071l4.998-4.998c.975-.976 2.256-1.464 3.536-1.464 1.279 0 2.56.488 3.535 1.464.493.493.861 1.063 1.105 1.672l-.787.784zm-5.703.147c.178.643.521 1.25 1.026 1.756 1.562 1.563 4.096 1.561 5.656 0l4.999-4.998c1.563-1.562 1.563-4.095 0-5.657-1.562-1.562-4.095-1.563-5.657 0l-3.841 3.841-.333-.009c-.404 0-.802.04-1.189.117l4.656-4.656c.975-.976 2.256-1.464 3.536-1.464 1.279 0 2.56.488 3.535 1.464 1.951 1.951 1.951 5.119 0 7.071l-4.999 4.998c-.975.976-2.255 1.464-3.535 1.464-1.28 0-2.56-.488-3.535-1.464-.494-.495-.863-1.067-1.107-1.678l.788-.785z" />
                      </svg>
                    </a> -->
                      </p>
                      <p style="font-size:16px; font-weight:400;margin-left:15px; margin-top:-5px; color:#8a7561"></p>
                    </div>
                    <p style="font-size:16px; font-weight:400;margin-left:15px; margin-top: 10px;">Earned Comp.Off(s)* - <b><?php echo $result['ico']; ?></b></p>
                    <p style="font-size:16px; font-weight:400;margin-left:15px; margin-top: 10px;">Remaining - <b><?php echo $result['co']; ?></b></p>
                    
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>
          <!--<div class="casual-leaves">Coming Soon !!!</div>-->
          <!-- <div class="sick-leaves">Sick Leaves:</div>
          <div class="total-leaves1">Total Leaves:</div> -->
          <h3 class="leave-balance">Leave Balance</h3><a href="my-leaveemp-mob.php" class="leave-balance" style="margin-left:120px;margin-top:-5px"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="25" viewBox="0 0 24 24" fill="none" stroke="#F46214" stroke-width="2.5" stroke-linecap="butt" stroke-linejoin="bevel"><g fill="none" fill-rule="evenodd"><path d="M18 14v5a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h5M15 3h6v6M10 14L20.2 3.8"/></g></svg></a>
          <img class="frame-child84" alt="" src="./public/line-30@2x.png" />

          <!-- <input class="input14" value="12" type="text" readonly/>

          <input class="input15" value="12" type="text" readonly/>

          <input class="input16" value="24" type="text" readonly/> -->
        </div>
        <div class="rectangle-parent37">
          <div class="calendar-container" style="scale: 0.75; margin-left: -53px; margin-top: -22px;">
            <div class="calendar-month-arrow-container">
              <div class="calendar-month-year-container">
                <select class="calendar-years"></select>
                <select class="calendar-months">
                </select>
              </div>
              <div class="calendar-month-year">
              </div>
              <div class="calendar-arrow-container">
                <button class="calendar-today-button"></button>
                <button class="calendar-left-arrow">
                  ← </button>
                <button class="calendar-right-arrow"> →</button>
              </div>
            </div>
            <ul class="calendar-week">
            </ul>
            <ul class="calendar-days">
            </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script>
    const weekArray = ["Sun", "Mon", "Tue", "Wed", "Thr", "Fri", "Sat"];
    const monthArray = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];
    const current = new Date();
    const todaysDate = current.getDate();
    const currentYear = current.getFullYear();
    const currentMonth = current.getMonth();
    let holidaysData = [];

    // async function fetchHolidaysAndGenerateCalendar() {
    //   try {
    //     const response = await fetch('fetchHolidays.php');
    //     const holidays = await response.json();
    //     updateCalendarWithHolidays(holidays);
    //   } catch (error) {
    //     console.error('Error fetching holidays:', error);
    //   }
    // }
    async function fetchHolidaysAndGenerateCalendar() {
      try {
        const response = await fetch('../fetchHolidays.php');
        holidaysData = await response.json();
        updateCalendarWithHolidays(holidaysData);
        generateCalendarDays(new Date());
      } catch (error) {
        console.error('Error fetching holidays:', error);
      }
    }

    function updateCalendarWithHolidays(holidays) {
      console.log('Received holidays:', holidaysData);
      const holidayDates = holidaysData.map(holiday => holiday.date);
      console.log('Holiday dates:', holidayDates);
      const calendarDays = document.getElementsByClassName("calendar-day");

      Array.from(calendarDays).forEach((dayElement, index) => {
        const day = index + 1;
        const currentDate = new Date(currentYear, currentMonth, day);

        const matchingHoliday = holidays.find(holiday =>
          holiday.date === currentDate.toISOString().split('T')[0]
        );

        if (matchingHoliday) {
          console.log(`Adding holiday styles to day ${day}`);

          // Apply styles directly using inline styles
          dayElement.style.backgroundColor = "#ffcccc";
          dayElement.style.color = "#cc0000";

          const holidayName = document.createElement("div");
          holidayName.textContent = matchingHoliday.name;
          holidayName.classList.add("holiday-name");

          // Apply styles directly using inline styles
          holidayName.style.fontSize = "10px";
          holidayName.style.color = "#ff0000";
          holidayName.style.textAlign = "start";
          holidayName.style.position = "absolute";
          holidayName.style.transform = "translateX(-20%)";

          dayElement.appendChild(holidayName);
        }
      });
    }

    function applyHolidayStyles() {
      const holidayElements = document.querySelectorAll(".calendar-day-holiday");
      holidayElements.forEach(holidayElement => {
        holidayElement.classList.add("holiday-style");
      });

      const holidayNameElements = document.querySelectorAll(".holiday-name");
      holidayNameElements.forEach(nameElement => {
        nameElement.classList.add("holiday-name-style");
      });
    }



    window.onload = function() {
      const currentDate = new Date();
      generateCalendarDays(currentDate);

      let calendarWeek = document.getElementsByClassName("calendar-week")[0];
      let calendarTodayButton = document.getElementsByClassName("calendar-today-button")[0];
      calendarTodayButton.textContent = "Today";

      calendarTodayButton.addEventListener("click", () => {
        generateCalendarDays(currentDate);
      });

      weekArray.forEach((week) => {
        let li = document.createElement("li");
        li.textContent = week;
        li.classList.add("calendar-week-day");
        calendarWeek.appendChild(li);
      });

      const calendarMonths = document.getElementsByClassName("calendar-months")[0];
      const calendarYears = document.getElementsByClassName("calendar-years")[0];
      const monthYear = document.getElementsByClassName("calendar-month-year")[0];

      const selectedMonth = parseInt(monthYear.getAttribute("data-month") || 0);
      const selectedYear = parseInt(monthYear.getAttribute("data-year") || 0);

      monthArray.forEach((month, index) => {
        let option = document.createElement("option");
        option.textContent = month;
        option.value = index;
        option.selected = index === selectedMonth;
        calendarMonths.appendChild(option);
      });

      const startYear = currentYear - 60;
      const endYear = currentYear + 60;
      let newYear = startYear;
      while (newYear <= endYear) {
        let option = document.createElement("option");
        option.textContent = newYear;
        option.value = newYear;
        option.selected = newYear === selectedYear;
        calendarYears.appendChild(option);
        newYear++;
      }

      const leftArrow = document.getElementsByClassName("calendar-left-arrow")[0];

      leftArrow.addEventListener("click", () => {
        const monthYear = document.getElementsByClassName("calendar-month-year")[0];
        const month = parseInt(monthYear.getAttribute("data-month") || 0);
        const year = parseInt(monthYear.getAttribute("data-year") || 0);

        let newMonth = month === 0 ? 11 : month - 1;
        let newYear = month === 0 ? year - 1 : year;
        let newDate = new Date(newYear, newMonth, 1);
        generateCalendarDays(newDate);
      });

      const rightArrow = document.getElementsByClassName("calendar-right-arrow")[0];

      rightArrow.addEventListener("click", () => {
        const monthYear = document.getElementsByClassName("calendar-month-year")[0];
        const month = parseInt(monthYear.getAttribute("data-month") || 0);
        const year = parseInt(monthYear.getAttribute("data-year") || 0);
        let newMonth = month + 1;
        newMonth = newMonth === 12 ? 0 : newMonth;
        let newYear = newMonth === 0 ? year + 1 : year;
        let newDate = new Date(newYear, newMonth, 1);
        generateCalendarDays(newDate);
      });

      calendarMonths.addEventListener("change", function() {
        let newDate = new Date(calendarYears.value, calendarMonths.value, 1);
        generateCalendarDays(newDate);
      });

      calendarYears.addEventListener("change", function() {
        let newDate = new Date(calendarYears.value, calendarMonths.value, 1);
        generateCalendarDays(newDate);
      });

      fetchHolidaysAndGenerateCalendar();
    };

    function generateCalendarDays(currentDate) {
      const newDate = new Date(currentDate);
      const year = newDate.getFullYear();
      const month = newDate.getMonth();
      const totalDaysInMonth = getTotalDaysInAMonth(year, month);
      const firstDayOfWeek = getFirstDayOfWeek(year, month);
      let calendarDays = document.getElementsByClassName("calendar-days")[0];

      removeAllChildren(calendarDays);

      let firstDay = 1;
      while (firstDay <= firstDayOfWeek) {
        let li = document.createElement("li");
        li.classList.add("calendar-day");
        calendarDays.appendChild(li);
        firstDay++;
      }

      let day = 1;
      while (day <= totalDaysInMonth) {
        let li = document.createElement("li");
        li.textContent = day;
        li.classList.add("calendar-day");
        if (todaysDate === day && currentMonth === month && currentYear === year) {
          li.classList.add("calendar-day-active");
        }
        calendarDays.appendChild(li);

        const matchingHoliday = holidaysData.find(holiday =>
          holiday.date === new Date(Date.UTC(year, month, day)).toISOString().split('T')[0]
        );

        if (matchingHoliday) {
          li.classList.add("calendar-day-holiday");
          const holidayName = document.createElement("div");
          holidayName.textContent = matchingHoliday.name;
          holidayName.classList.add("holiday-name");
          li.appendChild(holidayName);
        }

        day++;
      }

      const monthYear = document.getElementsByClassName("calendar-month-year")[0];
      monthYear.setAttribute("data-month", month);
      monthYear.setAttribute("data-year", year);
      const calendarMonths = document.getElementsByClassName("calendar-months")[0];
      const calendarYears = document.getElementsByClassName("calendar-years")[0];
      calendarMonths.value = month;
      calendarYears.value = year;
    }



    function getTotalDaysInAMonth(year, month) {
      return new Date(year, month + 1, 0).getDate();
    }

    function getFirstDayOfWeek(year, month) {
      return new Date(year, month, 1).getDay();
    }

    function removeAllChildren(parent) {
      while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
      }
    }
  </script>
  <script>
    var fluentpersonClock20Regular = document.getElementById(
      "fluentpersonClock20Regular"
    );
    if (fluentpersonClock20Regular) {
      fluentpersonClock20Regular.addEventListener("click", function(e) {
        window.location.href = "./apply-leaveemp-mob.php";
      });
    }

    var uitcalender = document.getElementById("uitcalender");
    if (uitcalender) {
      uitcalender.addEventListener("click", function(e) {
        window.location.href = "./attendenceemp-mob.php";
      });
    }

    var arcticonsgooglePay = document.getElementById("arcticonsgooglePay");
    if (arcticonsgooglePay) {
      arcticonsgooglePay.addEventListener("click", function(e) {
        window.location.href = "./directoryemp-mob.php";
      });
    }

    var rectangleLink = document.getElementById("rectangleLink");
    if (rectangleLink) {
      rectangleLink.addEventListener("click", function(e) {
        window.location.href = "./gatepasslog-mob.php";
      });
    }

    var gatepassLog = document.getElementById("gatepassLog");
    if (gatepassLog) {
      gatepassLog.addEventListener("click", function(e) {
        window.location.href = "./gatepasslog-mob.php";
      });
    }

    var personalDetails = document.getElementById("personalDetails");
    if (personalDetails) {
      personalDetails.addEventListener("click", function(e) {
        window.location.href = "./emp-personal-details-mob.php";
      });
    }

    var frameContainer3 = document.getElementById("frameContainer3");
    if (frameContainer3) {
      frameContainer3.addEventListener("click", function(e) {
        window.location.href = "./emp-personal-details-mob.php";
      });
    }

    var job = document.getElementById("job");
    if (job) {
      job.addEventListener("click", function(e) {
        window.location.href = "./empjob-details-mob.php";
      });
    }

    var frameContainer4 = document.getElementById("frameContainer4");
    if (frameContainer4) {
      frameContainer4.addEventListener("click", function(e) {
        window.location.href = "./empjob-details-mob.php";
      });
    }

    var salary = document.getElementById("salary");
    if (salary) {
      salary.addEventListener("click", function(e) {
        window.location.href = "./emp-salary-details-mob1.php";
      });
    }

    var frameContainer5 = document.getElementById("frameContainer5");
    if (frameContainer5) {
      frameContainer5.addEventListener("click", function(e) {
        window.location.href = "./emp-salary-details-mob1.php";
      });
    }

    var documents = document.getElementById("documents");
    if (documents) {
      documents.addEventListener("click", function(e) {
        window.location.href = "./emp-salary-details-mob.php";
      });
    }

    var frameContainer6 = document.getElementById("frameContainer6");
    if (frameContainer6) {
      frameContainer6.addEventListener("click", function(e) {
        window.location.href = "./emp-salary-details-mob.php";
      });
    }
  </script>

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
              window.location.href = 'login-mob.php';
            });
          });
        </script>";
  exit();
}
?>