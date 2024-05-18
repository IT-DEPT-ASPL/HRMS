<?php
	include('inc/config.php'); 
	$ID=$_GET['id'];
	$query=mysqli_query($con,"select * from `emp` where id='$ID'");
	$row=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/global4.css" />
    <link rel="stylesheet" href="./css/employee-approval.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap"
    />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <style>
      .remove{
        display: none;
      }
      .instyle{
        border: 2px solid rgb(177, 177, 177);
        border-radius: 20px;
      }
      .avatar-upload {
  position: relative;
  max-width: 205px;
  margin: 50px auto;
}
.avatar-upload .avatar-edit {
  position: absolute;
  right: 12px;
  z-index: 1;
  top: 10px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  content: "\f040";
  font-family: 'FontAwesome';
  color: #757575;
  position: absolute;
  top: 10px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}
.avatar-upload .avatar-preview {
  width: 192px;
  height: 192px;
  position: relative;
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
    </style>
  </head>
  <body>
    <div class="employeeapproval">
      <section class="bg1"></section>
  
      <section class="employeeapproval-item"></section>
      <img
        class="employeeapproval-inner"
        alt=""
        src="./public/rectangle-2@2x.png"
      />

      <img class="logo-1-icon1" alt="" src="./public/logo-1@2x.png" />

      <a class="anikahrm1" href="./index.html" id="anikaHRM">
        <span>Anika</span>
        <span class="hrm1">HRM</span>
      </a>
      <a class="onboarding1" href="./index.html" id="onboarding">Employee Management</a>
      <a class="onboarding1 remove" href="./index.html" style="margin-left: 415px;" id="onboarding123">/Edit Info</a>
      <button class="employeeapproval-child1"></button>
      <div class="logout1">Logout</div>
      <a class="attendance1" href="./attendence.html" id="attendance">Attendance</a>
      <div class="payroll1">Payroll</div>
      <div class="reports1">Reports</div>
      <img class="uitcalender-icon1" alt="" src="./public/uitcalender.svg" />
     
      <img
        class="arcticonsgoogle-pay1"
        alt=""
        src="./public/arcticonsgooglepay.svg"
      />
 
      <img
        class="streamlineinterface-content-c-icon1"
        alt=""
        src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg"
      />

      <img
        class="employeeapproval-child2"
        alt=""
        src="./public/ellipse-1@2x.png"
      />

      <img
        class="material-symbolsperson-icon1"
        alt=""
        src="./public/materialsymbolsperson.svg"
      />

      <img
      style="margin-top: -135px;"
        class="employeeapproval-child3"
        alt=""
        src="./public/rectangle-4@2x.png"
      />

      <a class="dashboard1" href="./index.html" id="dashboard">Dashboard</a>
      <a class="fluentpeople-32-regular1" id="fluentpeople32Regular">
        <img class="vector-icon7" alt="" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" src="./public/vector7.svg" />
      </a>
      <a class="employee-list1" href="./employee-management.php" style="color: white;" id="employeeList">Employee List</a>
      <a
        class="akar-iconsdashboard1"
        href="./index.html"
        id="akarIconsdashboard"
      >
        <img class="vector-icon8" alt="" src="./public/vector3.svg" />
      </a>
      <img class="tablerlogout-icon1" alt="" src="./public/tablerlogout.svg" />

      <a class="uitcalender1" id="uitcalender">
        <img class="vector-icon9" alt="" src="./public/vector4.svg" />
      </a>
      <a class="leaves1" href="./leave-management.html" id="leaves">Leaves</a>
      <a class="fluentperson-clock-20-regular1" id="fluentpersonClock20Regular">
        <img class="vector-icon10" alt="" src="./public/vector1.svg" />
      </a>
      <a class="onboarding2" href="./onboarding.html" style="color: black;" id="onboarding1">Onboarding</a>
      <a class="fluent-mdl2leave-user1" id="fluentMdl2leaveUser">
        <img class="vector-icon11" alt="" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" src="./public/vector8.svg" />
      </a>
        <div>
          <img style="margin-top:-20px;"
          class="employeeapproval-child"
          alt=""
          src="./public/rectangle-22@2x.png"
        />
    
        <input style="margin-top:-20px;" class="single" name="ms" value="<?php echo $row['empms']; ?>" type="text" defaultvalue="Single" />
    
        <input style="margin-top:-20px;"
          class="naradamohan1gmailcom1"
          name="email"
          value="<?php echo $row['empemail']; ?>"
          type="text"
        />
    
        <input style="margin-top:-20px;"
          class="input"
          name="mobile"
          value="<?php echo $row['empph']; ?>"
          type="text"
        />
    
        <input style="margin-top:-20px;"
          class="input1"
          value="<?php  $orgDate = $row['empdob']; $newDate = date("d-m-Y", strtotime($orgDate));   echo $newDate;  ?>"
          type="text"
          readonly="readonly"
        />
        <input style="margin-top:-20px; display:none;"
          class="input1"
          name="dob"
          value="<?php echo $row['empdob']; ?>"
          type="date"
          readonly="readonly"
        />
        <p style="margin-top:-20px;" class="date-of-birth">Date of Birth:</p>
        <p style="margin-top:-20px;" class="phone-number">Phone Number:</p>
        <p style="margin-top:-20px;" class="email-id">Email id:</p>
        <p style="margin-top:-20px;" class="marital-status">Marital Status:</p>
        <p style="margin-top:-20px;" class="gender">Gender:</p>
        <input style="margin-top:-20px;" class="male" name="gen" value="<?php echo $row['empgen']; ?>" type="text" defaultvalue="Male" />
    
        <input style="margin-top:-20px;"
          class="mohan-reddy1"
          name="name"
          value="<?php echo htmlspecialchars($row['empname'] ?? ''); ?>"
          type="text"
        />
    
        <input style="margin-top:-20px;"
          class="web-developer1"
          value="<?php echo $row['desg']; ?>"
          type="text"
          name="desg"
        />

        <div class="avatar-upload" style="margin-top: 130px; margin-left: 456px;">
          <div class="avatar-edit remove" id="avatarEdit">
              <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
              <label for="imageUpload"></label>
          </div>
          <div class="avatar-preview">
              <div id="imagePreview" style="background-image: url(pics/<?php  echo $row['pic'];?>);">
              </div>
          </div>
      </div>
    
        <h3 style="margin-top:-20px;" class="personal-info">Personal info</h3>
          <img style="margin-top:-20px;"
            class="employeeapproval-child4"
            alt=""
            src="./public/rectangle-53@2x.png"
          />
    
          <input style="margin-top:-20px;" class="input2" name="empid" value="<?php echo $row['emp_no']; ?>" type="text" defaultvalue="1902" />
    
          <img 
            class="employeeapproval-child5"
            alt="" style="margin-left: 12px; margin-top: -34px;"
            src="./public/rectangle-54@2x.png"
          />
    
          <input style="margin-top:-20px;"
            class="union-bank-of"
            name="bn"
            value="<?php echo $row['bn']; ?>"
            type="text"
          />
    
          <input style="margin-top:-20px;"
            class="ubin39723"
            name="ifsc"
            value="<?php echo $row['ifsc']; ?>"
            type="text"
          />
    
          <input style="margin-top:-20px;"
            class="input3"
            value="<?php echo $row['ban']; ?>"
            type="text"
          />
    
          <input style="margin-top:-20px;"
            class="input4"
            value="<?php echo $row['adn']; ?>"
            type="text"
          />
    
          <input style="margin-top:-20px;"
            class="kdiry3947h"
            value="<?php echo $row['pan']; ?>"
            type="text"
          />
    
          <img style="margin-top:-20px;"
            class="employeeapproval-child6"
            alt="" 
            src="./public/rectangle-54@2x.png"
          />
    
          <h3 style="margin-top:-20px;" class="document-view">Document View</h3>
          <p style="margin-top:-20px;" class="employee-id">Employee ID:</p>
          <p style="margin-top:-20px;" class="pan">PAN:</p>
          <p style="margin-top:-20px;" class="date-of-joining">Date of Joining:</p>
          <input style="margin-top:-20px;"
            class="input5"
            name="doj"
            value="<?php echo $row['empdoj']; ?>"
            type="text"
          />
    
          <p style="margin-top:-20px;" class="aadhaar">Aadhaar:</p>
          <p style="margin-top:-20px;" class="reporting-manager">Reporting Manager:</p>
          <input style="margin-top:-20px;"
            class="prabhdeep-singh-maan"
            name="rm"
            value="<?php echo $row['rm']; ?>"
            type="text"
          />
    
          <p style="margin-top:-20px;" class="account-number">Account Number:</p>
          <p style="margin-top:-20px;" class="employment-status">Employment Status:</p>
          <input style="margin-top:-20px;" class="active" value="Active" type="text" defaultvalue="Active" />
    
          <p style="margin-top:-20px;" class="ifsc-code">IFSC Code:</p>
          <p style="margin-top:-20px;" class="department">Department:</p>
          <input style="margin-top:-20px;" class="it" name="dept" value="<?php echo $row['dept']; ?>" type="text" defaultvalue="IT" />
    
          <p style="margin-top:-20px;" class="bank-name">Bank Name:</p>
          <p style="margin-top:-20px;" class="employment-type">Employment Type:</p>
          <input style="margin-top:-20px;"
            class="permanent"
            name="emptype"
            value="<?php echo $row['empty']; ?>"
            type="text"
            defaultvalue="Permanent"
          />
    
          <p style="margin-top:-20px;" class="salary">Salary:</p>
          <input style="margin-top:-20px;" class="input6" name="salf" value="<?php echo $row['salf']; ?>" type="text" defaultvalue="25000" />
    
          <h3 style="margin-top:-20px;" class="employment-info">Employment Info</h3>
          <h3 style="margin-top:-20px;" class="identity-info">Identity Info</h3>
          <a style="margin-top:-20px; word-wrap:break-word;" class="documentspdf"><?php echo $row['pdf']; ?></a>
          <div style="margin-top:-20px;" class="rectangle-div"></div>
          <img style="margin-top:-20px;"
            class="mdifolder-upload-icon"
            alt=""
            src="./public/mdifolderupload.svg"
          />
    
          <span style="margin-top:-20px;" id="viewbtn" class="employeeapproval-child7"></span>
          <a style="margin-top:-20px;" id="viewtxt" class="view-file" href="pdfs/<?php echo $row['pdf']; ?>" target="_blank">View File</a>
          <input type="file" style="display: none;" id="fileInput">
          <!-- <span class="akar-iconsedit" id="akarIconsedit"> -->
            <img style="margin-top:-20px;" class="group-icon akar-iconsedit"  onclick="editFunction();" alt="" src="./public/group.svg" />
            <!-- <img style="margin-top:10px; margin-left: -620px; " class="group-icon akar-iconsedit remove"  onclick="document.getElementById('infile').click();"  id="editImage" alt="" src="./public/group.svg" /> -->
            <input type="file" style="display: none;" id="infile">
          <!-- </span> --> 
        </div>
      <button type="submit" style="margin-top: 130px; margin-left: 150px;" class="employeeapproval-child7 remove" id="updatebtn"></button>
      <a style="margin-top: 130px; margin-left: 155px; cursor: pointer;" class="view-file remove" id="updatetxt">Update</a>
      <span type="submit" onclick="location.reload();" style="margin-top: 130px; background: rgb(255, 92, 92); margin-left: -20px;" class="employeeapproval-child7 remove" id="cancelbtn"></span>
      <a onclick="location.reload();" style="margin-top: 130px; margin-left: -15px; cursor: pointer;" class="view-file remove" id="canceltxt">Cancel</a>
    </div>
   
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
<script>
 function readURL(input) {
if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
}
}
$("#imageUpload").change(function() {
readURL(this);
});

</script>
  
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
            window.location.href = "./attendence.html";
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
            window.location.href = "./attendence.html";
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
        
        var onboarding1 = document.getElementById("onboarding1");
        if (onboarding1) {
          onboarding1.addEventListener("click", function (e) {
            window.location.href = "./onboarding.html";
          });
        }
        
        var fluentMdl2leaveUser = document.getElementById("fluentMdl2leaveUser");
        if (fluentMdl2leaveUser) {
          fluentMdl2leaveUser.addEventListener("click", function (e) {
            window.location.href = "./onboarding.html";
          });
        }
        
        var akarIconsedit = document.getElementById("akarIconsedit");
        if (akarIconsedit) {
          akarIconsedit.addEventListener("click", function (e) {
            window.location.href = "./employee-approval.html";
          });
        }
        function editFunction(){
          document.getElementById('onboarding123').classList.remove('remove');
          document.getElementById('updatebtn').classList.remove('remove');
          document.getElementById('updatetxt').classList.remove('remove');
          document.getElementById('cancelbtn').classList.remove('remove');
          document.getElementById('canceltxt').classList.remove('remove');
          document.getElementById('avatarEdit').classList.remove('remove');
          document.getElementById('viewbtn').setAttribute('onclick','document.getElementById("fileInput").click();') 
          var inputs = document.getElementsByTagName('input');
  
  // Loop through the input elements and add a border
  for (var i = 0; i < inputs.length; i++) {
      inputs[i].style.border = '1px solid grey';
      inputs[i].style.borderRadius = '7px';
  }
        }
        </script>
</html>