<?php
require_once("dbConfig.php");

function generateDates($year)
{
  $dates = array();
  $startDate = new DateTime("$year-01-01");
  $endDate = new DateTime("$year-12-31");

  while ($startDate <= $endDate) {
    $dates[] = $startDate->format('d-m-Y');
    $startDate->add(new DateInterval('P1D'));
  }

  return $dates;
}

$currentYear = date('Y');
$dates = generateDates($currentYear);
$valuesFromDatabase = array();
$sql = "SELECT date, value FROM holiday";
$result = $db->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $valuesFromDatabase[$row['date']] = $row['value'];
  }
}
$db->close();
?>
<?php
@include 'inc/config.php';
session_start();


if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              icon: 'error',
              title: 'Account Terminated',
              text: 'Contact HR, also check your mail for more info.',
            }).then(function() {
              window.location.href = 'loginpage.php';
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

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./employee-dashboard.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11"/>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap"
    />
    <style>
        .calendar-container {
  height: auto;
  width: 400px;
  background-color: white;
  border-radius: 20px;
  box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.4);
  padding: 0px 10px;
}

.calendar-week {
  display: flex;
  list-style: none;
  align-items: center;
  padding-inline-start: 0px;
}

.calendar-week-day {
  max-width: 90.1px;
  width: 100%;
  text-align: center;
  color: #525659;
}

.calendar-days {
  margin-top: 30px;
  list-style: none;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
  gap: 30px;
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
    </style>
  </head>
  <body>
    <section class="employeedashboard">
      <div class="bg4"></div>
      <img
        class="employeedashboard-child"
        alt=""
        src="./public1/rectangle-1@2x.png"
      />

      <img
        class="employeedashboard-item"
        alt=""
        src="./public1/rectangle-2@2x.png"
      />

      <a class="anikahrm4">
        <span>Anika</span>
        <span class="hrm4">HRM</span>
      </a>
      <a href="./employee-dashboard.php" class="employee-management4" id="employeeManagement"
        >Employee Management</a
      >
      <a style="display: block; left: 90%; margin-top: 5px; font-size: 27px;" href="./employee-dashboard.php" class="employee-management4" id="employeeManagement"></a>
      <button class="employeedashboard-inner"></button>
      <a href="logout.php" > <div class="logout4">Logout</div></a>
      <a href="apply-leave-emp.php" class="leaves4">Leaves</a>
       <a href="attendenceemp2.php" class="attendance4">Attendance</a>
      <a href="card.php" style="text-decoration: none; color: #222222;" class="payroll4">Directory</a>
      <a class="fluentperson-clock-20-regular4">
        <img class="vector-icon13" alt="" src="./public1/vector.svg" />
      </a>
      <img class="uitcalender-icon4" alt="" src="./public1/uitcalender.svg" />

      <img
        class="arcticonsgoogle-pay4"
        alt=""
        src="./public1/arcticonsgooglepay.svg"
      />
      <?php
         $sql = "SELECT * FROM emp WHERE (empemail = '".$_SESSION['user_name']."' && empstatus= 0 )";
         $que = mysqli_query($con,$sql);
         $cnt = 1;
         $row=mysqli_fetch_array($que);
         ?>
      <!--<img-->
      <!--  class="employeedashboard-child1"-->
      <!--  alt=""-->
      <!--  src="pics/<?php  echo $row['pic'];?>"-->
      <!--/>-->

      <img
        class="employeedashboard-child2"
        alt=""
        src="./public1/rectangle-4@2x.png"
      />

      <img class="tablerlogout-icon4" alt="" src="./public1/tablerlogout.svg" />

      <a class="uitcalender4">
        <img class="vector-icon14" alt="" src="./public1/vector1.svg" />
      </a>
      <div class="rectangle-parent5" style="margin-top:-20px;">
        <img class="frame-child52" alt="" style="width:753px" src="./public1/rectangle-22@2x.png" />

        

        <h3 class="mohan-reddy" style="margin-left:-30px; margin-top:30px;"><?php echo $row['empname']; ?> </h3>
        <!--<p class="web-developer"><?php echo $row['desg']; ?> </p>-->
        <img style="border-radius: 50%; margin-top:25px;"
          class="screenshot-2023-10-27-141446-1"
          alt=""
          src="pics/<?php  echo $row['pic'];?>">

        <img class="frame-icon" alt="" src="./public1/frame-34.svg" />

        <h3 class="basic-info">Basic Info</h3>
        <h3 class="job-info">Job Info</h3>
        <p class="full-name-mohan" style="margin-top:260px">Employee ID: <?php echo $row['emp_no']; ?></p>
        <p class="full-name-mohan">Gender: <?php echo $row['empgen']; ?></p>
        <p class="join-date-24112022">Joining Date: <?php echo $row['empdoj']; ?> </p>
        <p class="employee-id-1920">Marital Status: <?php echo $row['empms']; ?> </p>
        <p class="department-it">Designation: <?php echo $row['desg']; ?></p>
        <p class="birthday-17062002">Date of Birth: <?php  $orgDate = $row['empdob']; $newDate = date("d-m-Y", strtotime($orgDate));   echo $newDate;  ?></p>
        <!--<p class="status-active">Status: Active</p>-->
        <img class="frame-child53" alt="" src="./public1/rectangle-23@2x.png" />

        <img
          class="solarsuitcase-outline-icon"
          alt=""
          src="./public1/solarsuitcaseoutline.svg"
        />

        <h3 class="contact-info">Contact Info</h3>
        <p class="phone-9885852424">Phone: <?php echo $row['empph']; ?></p>
        <p class="email-naradamohan1gmailcom">
          <span class="email">Email:</span>
          <span  class="email"><?php echo $row['empemail']; ?></span>
        </p>
        <!--<p class="company-email-itanikasterili-container">-->
        <!--  <span class="email">Company Email:</span>-->
        <!--  <span class="email"><?php echo $row['empemail']; ?></span>-->
        <!--</p>-->

        <?php 
           $cnt++;
          ?>
        <div class="vector-wrapper">
          <img class="vector-icon15" alt="" src="./public1/vector4.svg" />
        </div>
        <img class="frame-child54" alt="" style="margin-top:-14px; width:590px; height:420px;" src="./public1/rectangle-24@2x.png" />

        <h3 class="leave-balance" style="margin-top:-14px">Leave Balance</h3>
           <p class="leave-requests-from" style="margin-left:-560px !important; margin-top:-14px">Coming Soon !!!</p>
           <div class="calendar-container" style="margin-left:570px; width:500px; scale:0.8; margin-top:360px;">
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
        <!--<img class="frame-child55" alt="" src="./public1/rectangle-24@2x.png" />-->

        <!--<p class="leave-requests-from">Coming Soon !!!</p>-->
        <!--<h3 class="leaves-list">Leaves List</h3>-->
        <!--<img class="frame-child56" alt="" src="./public1/line-30@2x.png" />-->

        <!--<img class="frame-child57" alt="" src="./public1/line-30@2x.png" />-->

        <!--<img class="frame-child58" alt="" src="./public1/line-30@2x.png" />-->

        <!--<img class="frame-child59" alt="" src="./public1/line-30@2x.png" />-->

        <!--<img class="frame-child60" alt="" src="./public1/line-30@2x.png" />-->

        <!--<img class="frame-child61" alt="" src="./public1/line-30@2x.png" />-->

        <!--<img class="frame-child62" alt="" src="./public1/line-30@2x.png" />-->

        <!--<button class="frame-child63"></button>-->
        <!--<a class="view-leave-list">View Leave List</a>-->
        <!--<p class="november-2022">November 2022</p>-->
        <!--<p class="december-2022">December 2022</p>-->
        <!--<p class="january-2023">January 2023</p>-->
        <!--<p class="february-2023">February 2023</p>-->
        <!--<p class="march-2023">March 2023</p>-->
      </div>
      <div class="rectangle-parent6" style="margin-left:80px;">
        <div class="frame-child64" style="margin-left:-80px;"></div>
        <img class="frame-child65" alt="" src="./public1/line-39.svg" />
        <a href="./gatepasslog.php" style="margin-left: -210px;" class="frame-child66" id="rectangleLink"> </a>
        <a href="./gatepasslog.php" style="margin-left: -200px;" class="personal-details5" id="personalDetails">Gatepass Log</a>
        <a href="./personal-details.php" class="frame-child66" id="rectangleLink"> </a>
        <a href="./job.php" class="frame-child67" id="rectangleLink1"> </a>
        <a href="./directory.php" class="frame-child68" id="rectangleLink2"> </a>
        <a href="./salary.php" class="frame-child69" id="rectangleLink3"> </a>
        <a href="./personal-details.php" class="personal-details5" id="personalDetails">Personal Details</a>
        <a href="./job.php" class="job5" id="job">Job</a>
        <a href="./directory.php" class="document4" id="document">Document</a>
        <a href="./salary.php" class="salary5" id="salary">Salary</a>
      </div>
      <a class="dashboard4" href="./employee-dashboard.php" id="dashboard">Dashboard</a>
      <a href="./employee-dashboard.php" class="akar-iconsdashboard4" id="akarIconsdashboard">
        <img class="vector-icon16" alt="" src="./public1/vector2.svg" />
      </a>
      <img class="logo-1-icon4" alt="" src="./public1/logo-1@2x.png" />
    </section>
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
        const response = await fetch('fetchHolidays.php');
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
      function addValue(date) {
        var inputField = document.querySelector('input[name="input_value_' + date + '"]');
        var inputValue = inputField.value;

        // Make an AJAX request to the server-side PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "insert_holiday.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4) {
            if (xhr.status == 200) {
              console.log('Input value for ' + date + ': ' + inputValue);

              // Update the input field with the added value
              inputField.value = xhr.responseText;

              // Change action buttons to update and delete
              var actionButtons = document.querySelector('td button');
              actionButtons.innerHTML = '<button onclick="updateValue(\'' + date + '\')">Update</button>' +
                '<button onclick="deleteValue(\'' + date + '\')">Delete</button>';

              // Show SweetAlert for success
              Swal.fire({
                title: 'Success!',
                text: 'Holiday  added successfully.',
                icon: 'success',
                timer: 2000, // Close after 2 seconds
                showConfirmButton: false
              }).then(() => {
                window.location.href = 'holiday.php';
              });
            } else {
              // Show SweetAlert for error
              Swal.fire({
                title: 'Error!',
                text: 'Failed to add value.',
                icon: 'error'
              });
            }
          }
        };

        // Send the input value and date to the server-side script
        xhr.send("date=" + date + "&value=" + inputValue);
      }

      function updateValue(date) {
        var inputField = document.querySelector('input[name="input_value_' + date + '"]');
        var updatedValue = inputField.value;

        // Make an AJAX request to the server-side PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_holiday.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4) {
            if (xhr.status == 200) {
              console.log('Update value for ' + date + ': ' + updatedValue);

              // Show SweetAlert for success
              Swal.fire({
                title: 'Success!',
                text: 'Holiday updated successfully.',
                icon: 'success',
                timer: 2000, // Close after 2 seconds
                showConfirmButton: false
              }).then(() => {
                window.location.href = 'holiday.php';
              });
            } else {
              // Show SweetAlert for error
              Swal.fire({
                title: 'Error!',
                text: 'Failed to update value.',
                icon: 'error'
              });
            }
          }
        };

        // Send the updated value and date to the server-side script
        xhr.send("date=" + date + "&value=" + updatedValue);
      }

      function deleteValue(date) {
        // Make an AJAX request to the server-side PHP script
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_holiday.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4) {
            if (xhr.status == 200) {
              console.log('Delete value for ' + date);

              // Update the input field with an empty value
              var inputField = document.querySelector('input[name="input_value_' + date + '"]');
              inputField.value = '';

              // Change action buttons back to add
              var actionButtons = document.querySelector('td button');
              actionButtons.innerHTML = '<button onclick="addValue(\'' + date + '\')">Add</button>';

              // Show SweetAlert for success
              Swal.fire({
                title: 'Success!',
                text: 'Holiday deleted successfully.',
                icon: 'success',
                timer: 2000, // Close after 2 seconds
                showConfirmButton: false
              }).then(() => {
                window.location.href = 'holiday.php';
              });

            } else {
              // Show SweetAlert for error
              Swal.fire({
                title: 'Error!',
                text: 'Failed to delete value.',
                icon: 'error'
              });
            }
          }
        };

        // Send the date to the server-side script for deletion
        xhr.send("date=" + date);
      }

      function autocomplete(inp, arr) {
        var currentFocus;

        inp.addEventListener("input", function(e) {
          closeAllLists();
          if (!this.value) {
            return false;
          }

          currentFocus = -1;

          var a = document.createElement("DIV");
          a.setAttribute("id", this.id + "autocomplete-list");
          a.setAttribute("class", "autocomplete-items");

          this.parentNode.appendChild(a);

          for (var i = 0; i < arr.length; i++) {
            if (arr[i].substr(0, this.value.length).toUpperCase() == this.value.toUpperCase()) {
              var b = document.createElement("DIV");
              b.innerHTML = "<strong>" + arr[i].substr(0, this.value.length) + "</strong>";
              b.innerHTML += arr[i].substr(this.value.length);
              b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
              b.addEventListener("click", function(e) {
                inp.value = this.getElementsByTagName("input")[0].value;
                closeAllLists();
              });
              a.appendChild(b);
            }
          }
        });

        inp.addEventListener("keydown", function(e) {
          var x = document.getElementById(this.id + "autocomplete-list");
          if (x) x = x.getElementsByTagName("div");
          if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
          } else if (e.keyCode == 38) {
            currentFocus--;
            addActive(x);
          } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
              if (x) x[currentFocus].click();
            }
          }
        });

        function addActive(x) {
          if (!x) return false;
          removeActive(x);
          if (currentFocus >= x.length) currentFocus = 0;
          if (currentFocus < 0) currentFocus = (x.length - 1);
          x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
          for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
          }
        }

        function closeAllLists(elmnt) {
          var x = document.getElementsByClassName("autocomplete-items");
          for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
              x[i].parentNode.removeChild(x[i]);
            }
          }
        }

        document.addEventListener("click", function(e) {
          closeAllLists(e.target);
        });
      }

      var holidays = ["Sankranti", "Bhogi", "Holiday", "YSS", "OKOK"];

      <?php foreach ($dates as $date) : ?>
        autocomplete(document.getElementById("input_<?php echo $date; ?>"), holidays);
      <?php endforeach; ?>
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
              window.location.href = 'loginpage.php';
            });
          });
        </script>";
  exit();
}
?>