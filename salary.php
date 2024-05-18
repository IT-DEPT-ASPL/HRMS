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
    <link rel="stylesheet" href="./salary.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap"
    />
  </head>
  <body>
    <div class="salary1">
      <div class="bg1"></div>
      <img class="salary-child" alt="" src="./public1/rectangle-1@2x.png" />

      <img class="salary-item" alt="" src="./public1/rectangle-2@2x.png" />

      <a class="anikahrm1">
        <span>Anika</span>
        <span class="hrm1">HRM</span>
      </a>
      <a class="employee-management1" id="employeeManagement"
        >Employee Management</a
      >
      <a style="display: block; left: 90%; margin-top: 5px; font-size: 27px;" href="./employee-dashboard.html" class="employee-management1" id="employeeManagement">Hi <?php echo $_SESSION['name'] ?></a>
      <button class="salary-inner"></button>
      <a href="logout.php" > <div class="logout1">Logout</div></a>
      <a class="leaves1">Leaves</a>
      <a class="attendance1">Attendance</a>
      <div class="payroll1">Payroll</div>
      <a class="fluentperson-clock-20-regular1">
        <img class="vector-icon4" alt="" src="./public1/vector.svg" />
      </a>
      <img class="uitcalender-icon1" alt="" src="./public1/uitcalender.svg" />

      <img
        class="arcticonsgoogle-pay1"
        alt=""
        src="./public1/arcticonsgooglepay.svg"
      />
      <?php
         $sql = "SELECT * FROM emp WHERE empemail = '".$_SESSION['user_name']."' ";
         $que = mysqli_query($con,$sql);
         $cnt = 1;
         $row=mysqli_fetch_array($que);
         ?>
      <img class="salary-child1" alt="" src="pics/<?php  echo $row['pic'];?>" />
<!-- 
      <img
        class="material-symbolsperson-icon1"
        alt=""
        src="./public1/materialsymbolsperson.svg"
      /> -->

      <img class="salary-child2" alt="" src="./public1/rectangle-4@2x.png" />

      <img class="tablerlogout-icon1" alt="" src="./public1/tablerlogout.svg" />

      <a class="uitcalender1">
        <img class="vector-icon5" alt="" src="./public1/vector1.svg" />
      </a>
      <a class="dashboard1" id="dashboard">Dashboard</a>
      <a class="akar-iconsdashboard1" id="akarIconsdashboard">
        <img class="vector-icon6" alt="" src="./public1/vector2.svg" />
      </a>
      <div class="rectangle-container">
        <div class="frame-child4"></div>
        <img class="frame-child5" alt="" src="./public1/line-39.svg" />

        <a href="./personal-details.html" class="frame-child6" id="rectangleLink"> </a>
        <a href="./personal-details.html" class="personal-details1" id="personalDetails">Personal Details</a>
        <a href="./job.php" class="frame-child7" id="rectangleLink1"> </a>
        <a href="./directory.php" class="frame-child8" id="rectangleLink2"> </a>
        <a class="frame-child9"> </a>
        <a href="./job.php" class="job1" id="job">Job</a>
        <a href="./directory.php" class="document1" id="document">Document</a>
        <a class="salary2">Salary</a>
       <a href="./employee-dashboard.html"> <img
          class="bxhome-icon1"
          alt=""
          src="./public1/bxhome.svg"
          id="bxhomeIcon"
        /></a>
      </div>
      <div class="frame-div">
        <div class="frame-child10"></div>
        <!-- <a class="next1">Next</a> -->
        <h3 class="salary-details">Salary Details</h3>
        <img class="frame-child11" alt="" src="./public1/line-12@2x.png" />
        <?php
         $sql = "SELECT * FROM emp WHERE empemail = '".$_SESSION['user_name']."' ";
         $que = mysqli_query($con,$sql);
         $cnt = 1;
         $row=mysqli_fetch_array($que);
         ?>

        <div class="frame-child12"></div>
        <input
          class="input"
          value="<?php echo $row['salf']; ?>"
          type="text"
          defaultvalue="3,00,000"
        />

        <div class="cost-to-the">Cost to the company</div>
        <div class="frame-child13"></div>
        <div class="frame-child14"></div>
        <div class="pf">PF</div>
        <input
          class="input1"
          value="<?php echo $row['sald1']; ?>"
          type="text"
          defaultvalue="1500/-"
        />

        <input class="input2" value="<?php echo $row['sald']; ?>" type="text" defaultvalue="100/-" />
<?php
        
        $sum = $row['sald'] + $row['sald1'];
?>

        <input
          class="input3"
          value="<?php echo $sum ?>" 
          type="text"
          defaultvalue="1600/-"
        />

        <div class="esi">ESI</div>
        <div class="frame-child15"></div>
        <img class="mdirupee-icon" alt="" src="./public1/mdirupee.svg" />

        <input
          class="input4"
          value="<?php echo $row['salbp']; ?>"
          type="text"
          defaultvalue="2,80,000"
        />

        <div class="total-payable">Total Payable</div>
        <img class="mdirupee-icon1" alt="" src="./public1/mdirupee.svg" />

        <input
          class="input5"
          value="<?php echo $sum ?>" 
          type="text"
          defaultvalue="20,000"
        />

        <div class="deductions">Deductions</div>
        <img class="mdirupee-icon2" alt="" src="./public1/mdirupee.svg" />

        <h3 class="deductions-breakdown">Deductions Breakdown</h3>
        <img class="frame-child16" alt="" src="./public1/line-40@2x.png" />

        <img class="frame-child17" alt="" src="./public1/line-41@2x.png" />
      </div>
      <img class="logo-1-icon1" alt="" src="./public1/logo-1@2x.png" />
    </div>

  </body>
</html>
