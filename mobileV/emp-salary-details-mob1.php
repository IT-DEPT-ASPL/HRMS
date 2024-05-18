<?php
@include '../inc/config.php';
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

    <link rel="stylesheet" href="./empmobcss/globalqw.css" />
    <link rel="stylesheet" href="./empmobcss/emp-salary-details-mob1.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap"
    />
  </head>
  <body>
    <div class="empsalarydetails-mob1" style="height: 100svh;">
      <div class="logo-1-parent4">
        <img class="logo-1-icon6" alt="" src="./public/logo-1@2x.png" />

        <a class="employee-management2" style="width: 300px;">Employee Management</a>
      </div>
      <div class="empsalarydetails-mob-inner"></div>
      <div class="fluentperson-clock-20-regular-container">
        <a
          class="fluentperson-clock-20-regular6"
          id="fluentpersonClock20Regular"
        >
          <img
            class="vector-icon21"
            alt=""
            src="./public/vector1@2xleaves.png"
          />
        </a>
        <a class="uitcalender6" id="uitcalender">
          <img
            class="vector-icon22"
            alt=""
            src="./public/vector2@2xatten.png"
          />
        </a>
        <img
          class="arcticonsgoogle-pay6"
          alt=""
          src="./public/arcticonsgooglepay1@2x.png"
          id="arcticonsgooglePay"
        />

        <div class="frame-child27"></div>
        <a class="akar-iconsdashboard6">
          <img
            class="vector-icon23"
            alt=""
            src="./public/vector@2xdashblack.png"
          />
        </a>
      </div>
      <div class="empsalarydetails-mob-child1"></div>
      <div class="frame-container" style="height: 60px;">
        <div class="rectangle-parent10" id="frameContainer2">
          <a class="frame-child28"> </a>
          <a class="personal-details1" id="personalDetails">Personal Details</a>
        </div>
        <div class="rectangle-parent11" id="frameContainer3">
          <a class="frame-child28"> </a>
          <a class="job1" id="job">Job</a>
        </div>
        <div class="rectangle-parent12">
          <a class="frame-child30"> </a>
          <a class="salary1">Salary</a>
        </div>
        <div class="rectangle-parent13" id="frameContainer5">
          <a class="frame-child31"> </a>
          <a class="documents1" id="documents">Documents</a>
        </div>
        <div class="line-group" id="frameContainer6">
          <div class="frame-child32"></div>
          <img
            class="bxhome-icon1"
            alt=""
            src="./public/bxhome@2x.png"
            id="bxhomeIcon"
          />
        </div>
      </div>
      <!-- <img class="vector-icon24" alt="" src="./public/vector7@2xarrow.png" /> -->

      <div class="rectangle-parent14" style="overflow-x: hidden;">
        <div class="frame-child33"></div>
        <a class="employee-management3">Employee Management</a>
        <h3 class="salary-details">Salary Details</h3>
        <img class="frame-child34" alt="" src="./public/line-12@2x.png" />
        <?php
         $sql = "SELECT * FROM emp WHERE empemail = '".$_SESSION['user_name']."' ";
         $que = mysqli_query($con,$sql);
         $cnt = 1;
         $row=mysqli_fetch_array($que);
         ?>
        <div class="rectangle-parent15">
          <div class="frame-child35"></div>
          <div class="cost-of-company">Cost to Company</div>
          <img class="mdirupee-icon" alt="" src="./public/mdirupee@2x.png" />

          <input class="input6" value="<?php echo $row['salf']; ?>" type="text" readonly/>
        </div>
       
        <div class="rectangle-parent16">
          <div class="frame-child35"></div>
          <div class="cost-of-company">Total Payable</div>
          <img class="mdirupee-icon" alt="" src="./public/mdirupee@2x.png" />

          <?php $sum = $row['sald'] + $row['sald1'];?>

          <input class="input6" value="<?php echo $row['salbp']; ?>" type="text" readonly/>
        </div>
        <div class="rectangle-parent17">
          <div class="frame-child35"></div>
          <div class="cost-of-company">Deductions</div>
          <img class="mdirupee-icon" alt="" src="./public/mdirupee@2x.png" />

          <input class="input6" value="<?php echo $sum ?>" type="text" readonly/>
        </div>
        <div class="rectangle-parent18">
          <div class="frame-child38"></div>
          <h3 class="deductions-breakdown">Deductions Breakdown</h3>
          <h3 class="pf">PF</h3>
          <input class="input9" value="<?php echo $row['sald1']; ?>" type="text" readonly/>
          <input class="input11" value="<?php echo $row['sald']; ?>" type="text" readonly/>
          <input class="input10" value="<?php echo $sum ?>" type="text" readonly/>

          <h3 class="esi">ESI</h3>
          <img class="frame-child39" alt="" src="./public/line-13@2x.png" />

          <img class="frame-child40" alt="" src="./public/line-14@2x.png" />
        </div>
      </div>
    </div>

    <script>
      var fluentpersonClock20Regular = document.getElementById(
        "fluentpersonClock20Regular"
      );
      if (fluentpersonClock20Regular) {
        fluentpersonClock20Regular.addEventListener("click", function (e) {
          window.location.href = "./apply-leaveemp-mob.html";
        });
      }
      
      var uitcalender = document.getElementById("uitcalender");
      if (uitcalender) {
        uitcalender.addEventListener("click", function (e) {
          window.location.href = "./attendenceemp-mob.html";
        });
      }
      
      var arcticonsgooglePay = document.getElementById("arcticonsgooglePay");
      if (arcticonsgooglePay) {
        arcticonsgooglePay.addEventListener("click", function (e) {
          window.location.href = "./directoryemp-mob.html";
        });
      }
      
      var personalDetails = document.getElementById("personalDetails");
      if (personalDetails) {
        personalDetails.addEventListener("click", function (e) {
          window.location.href = "./emp-personal-details-mob.html";
        });
      }
      
      var frameContainer2 = document.getElementById("frameContainer2");
      if (frameContainer2) {
        frameContainer2.addEventListener("click", function (e) {
          window.location.href = "./emp-personal-details-mob.html";
        });
      }
      
      var job = document.getElementById("job");
      if (job) {
        job.addEventListener("click", function (e) {
          window.location.href = "./empjob-details-mob.html";
        });
      }
      
      var frameContainer3 = document.getElementById("frameContainer3");
      if (frameContainer3) {
        frameContainer3.addEventListener("click", function (e) {
          window.location.href = "./empjob-details-mob.html";
        });
      }
      
      var documents = document.getElementById("documents");
      if (documents) {
        documents.addEventListener("click", function (e) {
          window.location.href = "./emp-salary-details-mob.html";
        });
      }
      
      var frameContainer5 = document.getElementById("frameContainer5");
      if (frameContainer5) {
        frameContainer5.addEventListener("click", function (e) {
          window.location.href = "./emp-salary-details-mob.html";
        });
      }
      
      var bxhomeIcon = document.getElementById("bxhomeIcon");
      if (bxhomeIcon) {
        bxhomeIcon.addEventListener("click", function (e) {
          window.location.href = "./emp-dashboard-mob.html";
        });
      }
      
      var frameContainer6 = document.getElementById("frameContainer6");
      if (frameContainer6) {
        frameContainer6.addEventListener("click", function (e) {
          window.location.href = "./emp-dashboard-mob.html";
        });
      }
      </script>
  </body>
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