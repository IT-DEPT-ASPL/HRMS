<?php

@include 'inc/config.php';

session_start();

if(!isset($_SESSION['user_name']) && !isset($_SESSION['name'])){
   header('location:main.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./directory.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap"
    />
  </head>
  <body>
    <div class="directory">
    <?php
         $sql = "SELECT * FROM emp WHERE empemail = '".$_SESSION['user_name']."' ";
         $que = mysqli_query($con,$sql);
         $cnt = 1;
         $row=mysqli_fetch_array($que);
         ?>

      <div class="bg"></div>
      <img class="directory-child" alt="" src="./public1/rectangle-1@2x.png" />

      <img class="directory-item" alt="" src="./public1/rectangle-2@2x.png" />

      <a class="anikahrm">
        <span>Anika</span>
        <span class="hrm">HRM</span>
      </a>
      <a class="employee-management" id="employeeManagement"
        >Employee Management</a
      >
      <a style="display: block; left: 90%; margin-top: 5px; font-size: 27px;" href="./employee-dashboard.html" class="employee-management" id="employeeManagement">Hi <?php echo $_SESSION['name'] ?></a>
      <button class="directory-inner"></button>
      <a href="logout.php" > <div class="logout">Logout</div></a>
      <a class="leaves">Leaves</a>
      <a class="attendance">Attendance</a>
      <div class="payroll">Payroll</div>
      <a class="fluentperson-clock-20-regular">
        <img class="vector-icon" alt="" src="./public1/vector.svg" />
      </a>
      <img class="uitcalender-icon" alt="" src="./public1/uitcalender.svg" />

      <img
        class="arcticonsgoogle-pay"
        alt=""
        src="./public1/arcticonsgooglepay.svg"
      />
      <img class="ellipse-icon" alt="" src="pics/<?php  echo $row['pic'];?>" />

      <!-- <img
        class="material-symbolsperson-icon"
        alt=""
        src="./public1/materialsymbolsperson.svg"
      /> -->

      <img class="rectangle-icon" alt="" src="./public1/rectangle-4@2x.png" />

      <img class="tablerlogout-icon" alt="" src="./public1/tablerlogout.svg" />

      <a class="uitcalender">
        <img class="vector-icon1" alt="" src="./public1/vector1.svg" />
      </a>
      <a class="dashboard" id="dashboard">Dashboard</a>
      <a class="akar-iconsdashboard" id="akarIconsdashboard">
        <img class="vector-icon2" alt="" src="./public1/vector2.svg" />
      </a>
      <div class="rectangle-parent">
        <div class="frame-child"></div>
        <img class="frame-item" alt="" src="./public1/line-39.svg" />

        <a href="./personal-details.html" class="frame-inner"> </a>
        <a href="./personal-details.html" class="personal-details" id="personalDetails">Personal Details</a>
        <a href="./job.html" class="rectangle-a" id="rectangleLink1"> </a>
        <a class="frame-child1"> </a>
        <a href="./salary.php" class="frame-child2" id="rectangleLink3"> </a>
        <a href="./job.html" class="job" id="job">Job</a>
        <a class="document">Document</a>
        <a href="./salary.php" class="salary" id="salary">Salary</a>
       <a href="./employee-dashboard.html"><img
          class="bxhome-icon"
          alt=""
          src="./public1/bxhome.svg"
          id="bxhomeIcon"
        /></a> 
      </div>
      
      <!-- <a class="next">Next</a> -->
      <div class="rectangle-group">
        <div class="rectangle-div"></div>
        <h3 class="uploaded-docs">Uploaded Docs</h3>
        <img class="line-icon" alt="" src="./public1/line-12@2x.png" />

        <h3 class="document-view">Document View</h3>
        <a class="documentspdf"><?php echo $row['pdf']; ?></a>
        <div class="frame-child3"></div>
        <img class="vector-icon3" alt="" src="./public1/vector3.svg" />

        <button class="rectangle-button"></button>
        <a class="view-file" href="pdfs/<?php echo $row['pdf']; ?>" target="_blank">View File</a>
      </div>
      <img class="logo-1-icon" alt="" src="./public1/logo-1@2x.png" />
    </div>
<!-- 
    <script>
      var employeeManagement = document.getElementById("employeeManagement");
      if (employeeManagement) {
        employeeManagement.addEventListener("click", function (e) {
          window.location.href = "./employee-dashboard.html";
        });
      }
      
      var dashboard = document.getElementById("dashboard");
      if (dashboard) {
        dashboard.addEventListener("click", function (e) {
          window.location.href = "./employee-dashboard.html";
        });
      }
      
      var akarIconsdashboard = document.getElementById("akarIconsdashboard");
      if (akarIconsdashboard) {
        akarIconsdashboard.addEventListener("click", function (e) {
          window.location.href = "./employee-dashboard.html";
        });
      }
      
      var personalDetails = document.getElementById("personalDetails");
      if (personalDetails) {
        personalDetails.addEventListener("click", function (e) {
          window.location.href = "./personal-details.html";
        });
      }
      
      var rectangleLink1 = document.getElementById("rectangleLink1");
      if (rectangleLink1) {
        rectangleLink1.addEventListener("click", function (e) {
          window.location.href = "./job.html";
        });
      }
      
      var rectangleLink3 = document.getElementById("rectangleLink3");
      if (rectangleLink3) {
        rectangleLink3.addEventListener("click", function (e) {
          window.location.href = "./salary.html";
        });
      }
      
      var job = document.getElementById("job");
      if (job) {
        job.addEventListener("click", function (e) {
          window.location.href = "./job.html";
        });
      }
      
      var salary = document.getElementById("salary");
      if (salary) {
        salary.addEventListener("click", function (e) {
          window.location.href = "./salary.html";
        });
      }
      
      var bxhomeIcon = document.getElementById("bxhomeIcon");
      if (bxhomeIcon) {
        bxhomeIcon.addEventListener("click", function (e) {
          window.location.href = "./employee-dashboard.html";
        });
      }
      </script> -->
  </body>
</html>
