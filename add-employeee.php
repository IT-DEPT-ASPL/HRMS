<?php
session_start();
@include 'inc/config.php';

if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
    header('location:loginpage.php');
    exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
if ($user_name === '') {
    header('location:loginpage.php');
    exit();
}

$query = "SELECT user_type FROM user_form WHERE email = '$user_name'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    if ($row && isset($row['user_type'])) {
        $user_type = $row['user_type'];
        
        if ($user_type !== 'admin') {
            header('location:loginpage.php');
            exit();
        }
    } else {
        die("Error: Unable to fetch user details.");
    }
} else {
    die("Error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/global1.css" />
    <link rel="stylesheet" href="./css/frame-22.css" />
    <link rel="stylesheet" href="./css/frame-18.css" />
    <link rel="stylesheet" href="./css/frame-19.css" />
    <link rel="stylesheet" href="./css/frame-20.css" />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap"
    />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
      .section {
        display: none;
      }
      .active {
        display: block;
      }
      #pdfPreview {
      overflow-x: hidden;
      margin-left: 1200px;
      margin-top: 280px;
      
      width: 400px;
      height: 400px;
      z-index: 100;
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
        <script>
  $(document).ready(function (e) {
    function generateEmployeeID() {
        var prefix = 'ASPL';

        var lastEmployeeID = getLastEmployeeIDFromDB();

        var lastNumber = parseInt(lastEmployeeID.substring(8));

        if (!isNaN(lastNumber)) {
            var newNumber = lastNumber + 1;
        } else {
            var newNumber = 1;
        }

        var today = new Date();
        var date = today.getFullYear() + ('0' + (today.getMonth() + 1)).slice(-2) + ('0' + today.getDate()).slice(-2);

        var newEmployeeID = prefix + date + ('0000' + newNumber).slice(-4);

        return newEmployeeID;
    }
    function getLastEmployeeIDFromDB() {
        var lastEmployeeID = '';
        $.ajax({
            type: 'GET',  
            url: 'get_last_employee_id.php',  
            async: false,  
            success: function (response) {
                lastEmployeeID = response;
            }
        });

        return lastEmployeeID;
    }

    $('#empid').val(generateEmployeeID());

    function generateUniqueId() {
        var timestamp = new Date().getTime();
        return 'EMP' + timestamp;
    }

    
    $("#frm").on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        }
      });

      $.ajax({
        type: 'POST',
        url: 'upload.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $('.submitBtn').attr("disabled", "disabled");
          $('#frm').css("opacity", ".5");
        },
        success: function (msg) {
          // Hide loading spinner
          Swal.close();

          console.log(msg);
          $('.statusMsg').html('');
          if (msg == 'ok') {
            $('#frm')[0].reset();
            swal({
              type: "success",
              title: "Employee Added Successfully"
            }, function () {
              window.location = "employee-management.php";
            });
          } else {
            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
          }
          $('#frm').css("opacity", "");
          $(".submitBtn").removeAttr("disabled");
        }
      });
    });

      function generateUniqueId() {
        var timestamp = new Date().getTime();
        return 'EMP' + timestamp;
      }
    });
  </script>
  <style>
    .section {
      display: none;
    }

    .active {
      display: block;
    }

    #pdfPreview {
      overflow-x: hidden;
      margin-left: 1200px;
      margin-top: 280px;

      width: 400px;
      height: 400px;
      z-index: 100;
    }
    a:hover {
  text-decoration: none;
  color: inherit;
}
.employee-management:hover{
    color:white;
}
.employee-list2:hover{
    color:white;
}
  </style>
</head>

<body style="margin-left:-30px;">
  <div class="bg-parent">
    <div class="bg"></div>
    <img class="rectangle-icon" alt="" src="./public/rectangle-32@2x.png" />

    <img class="frame-child47" alt="" src="./public/rectangle-33@2x.png" />

    <img class="logo-2-icon" alt="" src="./public/logo-11@2x.png" />

    <a class="anikahrm1" href="./index.php">
      <span>Anika</span>
      <span class="hrm1">HRM</span>
    </a>
    <a class="employee-management" href="./index.php" id="employeeManagement">Employee Management</a>
   <a href="logout.php"> <button class="frame-child48" ></button>
    <div class="logout1" style="margin-top:-5px;">Logout</div></a>
    <a class="leaves1" style="z-index: 10;" href="./leave-management.php">Leaves</a>
    <a class="onboarding2" style="z-index: 10;" href="./onboarding.php">Onboarding</a>
    <a class="attendance1" style="z-index: 10;" href="./attendence.php">Attendance</a>
    <div class="payroll1">Payroll</div>
    <div class="reports1">Reports</div>
    <!--<img class="frame-child49" alt="" src="./public/ellipse-2@2x.png" />-->

    <!--<img class="material-symbolsperson-icon4" alt="" src="./public/materialsymbolsperson.svg" />-->

    <img class="frame-child50" alt="" style="margin-left:27px;" src="./public/rectangle-35@2x.png" />
    <img src="./public/vector3.svg" width="30px" style="position:absolute; margin-top: 300px; margin-left:70px;"/>
        <img src="./public/vector2.svg" width="30px" style="position:absolute; margin-top: 370px; margin-left:70px;"/>
                <img src="./public/vector1.svg" width="30px" style="position:absolute; margin-top: 430px; margin-left:70px;"/>
                     <img src="./public/vector.svg" width="30px" style="position:absolute; margin-top: 500px; margin-left:70px;"/>
                     <img src="./public/vector4.svg" width="30px" style="position:absolute; margin-top: 560px; margin-left:70px;"/>
                      <img src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg" width="30px" style="position:absolute; margin-top: 690px; margin-left:70px;"/>
                      <img src="./public/arcticonsgooglepay.svg" width="30px" style="position:absolute; margin-top: 630px; margin-left:70px;"/>
                        <img src="./public/tablerlogout.svg" width="30px" style="position:absolute; margin-top: 848px; margin-left:100px;"/>
    <a class="dashboard1" href="./index.php" style="z-index: 10;" id="dashboard">Dashboard</a>
    <a class="employee-list2" style="z-index: 10;" href="employee-management.php">Employee List</a>
    <div class="section active" id="section1">
      <div class="frame-wrapper">
        <div class="rectangle-parent1" style="z-index: 1;">
                  <div class="frame-child25" style="margin-left:-15px; width:1512px;"></div>
          <div class="rectangle-parent2">
            <div class="frame-child52"></div>
            <div class="frame-child53"></div>
            <div class="frame-child54"></div>
            <img class="frame-child55" alt="" src="./public/ellipse-4@2x.png" />

            <a class="a12">1</a>
            <img class="frame-child56" alt="" src="./public/ellipse-6@2x.png" />

            <img class="frame-child57" alt="" src="./public/ellipse-71@2x.png" />

            <img class="frame-child58" alt="" src="./public/ellipse-6@2x.png" />

            <a class="a13">2</a>
            <a class="a14">3</a>
            <a class="a15">4</a>
          </div>
        
          <form id='frm'>
          <div class="frame-child59">
          <div class="avatar-upload" style="margin-top: 450px; margin-left: 70px;">
              <div class="avatar-edit">
                  <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="file1"/>
                  <label for="imageUpload" style="margin-top:7px"></label>
              </div>
              <div class="avatar-preview">
                  <div id="imagePreview" style="background-image: url(./public/screenshot-20231027-141446-1@2x.png);">
                  </div>
              </div>
          </div>
          </div>
          <label class="employee-name">Employee Name*</label>
          <label class="phone-number">Phone Number</label>
          <label class="marital-status">Marital Status</label>
          <label class="date-of-birth">Date of Birth</label>
          <label class="email-id">Email ID</label>
          <label class="gender">Gender</label>
          <h3 class="personal-details">Personal Details</h3>
          <img class="frame-child60" alt="" src="./public/line-121@2x.png" />
         
            <input name="name" id='name' class="frame-child61" type="text" oninput="convertToUpperCase(this)"/>

            <input name="mobile" id='mobile' class="frame-child62" type="tel" maxlength="10"/>

            <select name="ms" class="frame-child63">
              <option value="">--select--</option>
              <option value="Married">Married</option>
              <option value="Single">Single</option>
            </select>

            <input name="dob" class="frame-child64" type="date" max="2005-12-31"/>

            <input name="email" id='email' class="frame-child65" type="text" />
            
            <select name="gen" class="frame-child66">
              <option value="">--select--</option>
              <option value="M">Male</option>
              <option value="F">Female</option>
            </select>
            <input type="hidden" class="form-control" name="uid" id='uid' required value='0' placeholder="">
        
            <span onclick="showSection(2)" class="frame-child67"></span>
            <a onclick="showSection(2)" class="next2" style="color:white; cursor:pointer;">Next</a>
           
        </div>
      </div>
    </div>
    <div class="section" id="section2">
      <div class="rectangle-top">
        <div class="frame-child25" style="margin-top: 80px;"></div>
        <div class="rectangle-container" style="margin-top: 80px; margin-left: 50px;">
          <div class="frame-child26"></div>
          <label class="employee-id">Employee ID*</label>
          <label class="reporting-manager">Reporting Manager</label>
          <label class="designation">Designation</label>
          <label class="employment-type">Salary (Fixed)</label>
          <label class="salary-base-pay">Deduction (EPF)</label>
          <label class="date-of-joining">Date of Joining</label>
          <label class="employment-status">Department</label>
          <label class="department" style="width: 250px;">Employment Type</label>
          <label class="salary-fixed">Salary (Base Pay)</label>
          <label class="salary-deductions">Deduction (ESI)</label>
          <h3 class="employment-details">Employment Details</h3>
          <img class="frame-child27" alt="" src="./public/line-121@2x.png" />

          <input name="empid" id="empid" class="frame-child28" type="text"  />

          <select name="rm" class="frame-child29">
            <option value="">--select--</option>
            <option value="PSM">Prabhdeep Singh Maan</option>
            <option value="Col.SSC">Col. Swadeep Singh Chauhan</option>
            <option value="Naga">Naga Bushanam</option>
          </select>

          <!-- <input name="desg" class="frame-child30" type="text" oninput="convertToUpperCase(this)"/> -->
          <select name="desg" class="frame-child30" onchange="convertToUpperCase(this)">
  <?php
    $servername = "localhost";
    $username = "Anika12";
    $password = "Anika12";
    $dbname = "ems";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT desg FROM dept";
    $result = $conn->query($sql);

    echo'<option>--select--</option>';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['desg'] . '">' . $row['desg'] . '</option>';
        }
    } else {
        echo '<option value="">No data available</option>';
    }
    $conn->close();
  ?>
</select>

          <select name="emptype" class="frame-child35">
            <option value="">--select--</option>
            <option value="Permanent">Permanent</option>
            <option value="Temporary">Temporary</option>
          </select>

          <input name="sald1" class="frame-child32" type="text" />

          <input name="doj" class="frame-child33" type="date" id="dojInput"/>

          <input name="dept" class="frame-child34" type="text" oninput="convertToUpperCase(this)"/>

          <input name="salbp" class="frame-child36" type="text" />

          <input name="salf" class="frame-child31" type="text" />

          <input name="sald" class="frame-child37" type="text" />

          <span class="frame-child38" onclick="showSection(3)"></span>
          <a class="next1" onclick="showSection(3)" style="color:white; cursor:pointer;">Next</a>
          <span class="frame-child39" onclick="showSection(1)"></span>
          <a class="prev2" onclick="showSection(1)" style="color:white; cursor:pointer;">Prev</a>
         
        </div>
        <div class="frame-div" style="margin-top: 80px;">
          <div class="frame-child40"></div>
          <div class="frame-child41"></div>
          <div class="frame-child42"></div>
          <img class="frame-child43" alt="" src="./public/ellipse-4@2x.png" />

          <a class="a8">1</a>
          <img class="frame-child44" alt="" src="./public/ellipse-5@2x.png" />

          <img class="frame-child45" alt="" src="./public/ellipse-71@2x.png" />

          <img class="frame-child46" alt="" src="./public/ellipse-6@2x.png" />

          <a class="a9">2</a>
          <a class="a10">3</a>
          <a class="a11">4</a>
        </div>
      </div>
    </div>
    <div class="section" id="section3">
      <div class="rectangle-root">
        <div class="frame-child9" style="margin-top: 80px;"></div>
        <a class="typcnplus1"> </a>

        <div class="frame-child10" style="margin-top: 80px;"></div>
        <div class="frame-child11" style="margin-top: 80px;"></div>
        <div class="frame-child12" style="margin-top: 80px;"></div>
        <img class="frame-child13" style="margin-top: 80px;" alt="" src="./public/ellipse-4@2x.png" />

        <a class="a4" style="margin-top: 80px;">1</a>
        <img class="frame-child14" style="margin-top: 80px;" alt="" src="./public/ellipse-5@2x.png" />

        <img class="frame-child15" style="margin-top: 80px;" alt="" src="./public/ellipse-7@2x.png" />

        <img class="frame-child16" style="margin-top: 80px;" alt="" src="./public/ellipse-6@2x.png" />

        <a class="a5" style="margin-top: 80px;">2</a>
        <a class="a6" style="margin-top: 80px;">3</a>
        <a class="a7" style="margin-top: 80px;">4</a>

        <div class="frame-child17" style="margin-top: 80px; margin-left: 80px;"></div>

        <label class="pan" style="margin-top: 80px; margin-left: 80px;">PAN</label>
        <label class="bank-account-number" style="margin-top: 80px; margin-left: 80px;">Bank Account Number</label>
        <label class="bank-name" style="margin-top: 80px; margin-left: 80px;">Bank Name</label>
        <label class="aadhaar-number" style="margin-top: 80px; margin-left: 80px;">Aadhaar Number</label>
        <label class="ifsc-code" style="margin-top: 80px; margin-left: 80px;">IFSC Code</label>
        <h3 class="identity-details" style="margin-top: 80px; margin-left: 80px;">Identity Details</h3>
        <img class="line-icon" style="margin-top: 80px; margin-left: 80px;" alt="" src="./public/line-12@2x.png" />

        <input name="pan" class="frame-child18" style="margin-top: 80px; margin-left: 80px;" type="text" maxlength="15" placeholder="ABCD-1234-E" oninput="formatPAN(this)"/>

        <input name="ban" class="frame-child19" style="margin-top: 80px; margin-left: 80px;" type="text" />
        <select name="bn" class="frame-child20" style="margin-top: 80px; margin-left: 80px;">
        <option value="">--select--</option>
          <option value="SBI">State Bank Of India (SBI)</option>
          <option value="PNB">Punjab National Bank (PNB)</option>
          <option value="IB">Indian Bank (IB)</option>
          <option value="BOI">Bank Of India (BOI)</option>
          <option value="UCO">UCO Bank</option>
          <option value="UBI">Union Bank Of India</option>
          <option value="CBI">Central Bank Of India</option>
          <option value="BOB">Bank Of Baroda</option>
          <option value="BOM">Bank Of Maharashtra</option>
          <option value="CB">Canara Bank</option>
          <option value="IOB">Indian Overseas Bank</option>
          <option value="ICICI">ICICI Bank</option>
          <option value="HDFC">HDFC Bank</option>
          <option value="AB">Axis Bank</option>
          <option value="KMB">Kotak Mahindra Bank</option>
          <option value="FB">Federal Bank</option>
          <option value="FB">Karur Vysya Bank</option>
          
        </select>
        <input name="adn" class="frame-child21" style="margin-top: 80px; margin-left: 80px;" type="text" oninput="formatAdn(this)" maxlength="14"/>

        <input name="ifsc" class="frame-child22" style="margin-top: 80px; margin-left: 80px;" type="text" oninput="convertToUpperCase(this)"/>


          

        <span class="frame-child23" style="margin-top: 80px; margin-left: 80px;" onclick="showSection(4)"></span>
        <span class="frame-child24" style="margin-top: 80px; margin-left: 80px;" onclick="showSection(2)"></span>
        <a class="next" style="margin-top: 80px; margin-left: 80px; color:white; cursor:pointer;" onclick="showSection(4)">Next</a>
        <a class="prev1" style="margin-top: 80px; margin-left: 80px; color:white; cursor:pointer;" onclick="showSection(2)">Prev</a>
       
      </div>
    </div>
    <div class="section" id="section4">

      <div class="rectangle-parent">
        <div class="frame-child" style="margin-top:80px;"></div>
        <a class="typcnplus"> </a>
        <img class="mdifolder-upload-icon" alt="" style="margin-top:80px;" src="./public/mdifolderupload.svg" />

        <div class="frame-item" style="margin-top:80px; margin-left: 80px;">
      </div>
        <p class="note-upload" style="margin-top:80px; margin-left: 80px;">Note* : Upload all the documents as single
          PDF.</p>
        <span class="or-" style="margin-top:80px; margin-left: 80px;">-OR-</span>
        <h3 class="drag-and-drop" style="margin-top:80px; margin-left: 100px;">Drag and Drop file here</h3>
        <h3 class="documents-upload" style="margin-top:80px; margin-left: 80px;">Documents Upload</h3>
        <div style="display: flex;">
          <div class="frame-inner" style="margin-top:80px; margin-left: 80px;"></div>
          <div id="pdfPreview"></div>
        </div>
        <img class="mdifolder-upload-icon1" alt="" style="margin-top:80px; margin-left: 80px;"
          src="./public/mdifolderupload1.svg" />
        <span class="rectangle-input" style="margin-top:80px; margin-left: 80px;cursor:pointer; color: white;"
          onclick="document.getElementById('pdfFile').click();">
          <p style="display: block; margin-left: 50px; margin-top: 15px; cursor:pointer;">Browse File</p>
          <p class="statusMsg"></p>
        </span>
          <input type="hidden" name="empstatus" value="0">
        <input type="hidden" name="purpose" id="purpose" value="for confirmation of employement details and creation of emp login."/>
        <input class="browse-file" style="margin-top:80px;  display: none;" id="pdfFile" type="file" name="file"
          value="cv" accept=".pdf">
          <span class="rectangle-button " style="margin-top:80px; margin-left: 80px;" data-toggle="modal" data-target="#demoModal"></span>
         
         <span class="frame-child2 " onclick="showSection(3)" style="margin-top:80px; margin-left: 80px;"></span>
         <a class="save submitBtn" style="margin-top:80px; margin-left: 80px; color: white; cursor:pointer;" data-toggle="modal" data-target="#demoModal">Add</a>
         <div class="modal" id="demoModal" style="  margin-top: 300px;">
           <div class="modal-dialog">
             <div class="modal-content">
             
               <div class="modal-header">
                 <h4 class="modal-title" style="color: #636363;">Employee Details </h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               
               <div class="modal-body" style="color: #636363;">
                 Are you sure saving the details..
               </div>
               
               <div class="modal-footer">
                 
                 <span type="button" class="btn btn-danger" data-dismiss="modal">Close</span>
                 <button type="submit" class="btn btn-success submitBtn" >Save</button>
               </div>
               
             </div>
           </div>
         </div>
        </form>

        <button class="frame-child2" onclick="showSection(3)" style="margin-top:80px; margin-left: 80px;"></button>
     
        
        <a class="prev" style="margin-top:80px; margin-left: 80px; color:white; cursor:pointer;" onclick="showSection(3)">Prev</a>
        <div class="material-symbolsinfo-outline" style="margin-top:80px; margin-left: 80px;"></div>
        <div class="rectangle-group" style="margin-top:80px;">
          <div class="frame-child3"></div>
          <div class="frame-child4"></div>
          <div class="frame-child5"></div>
          <img class="ellipse-icon" alt="" src="./public/ellipse-4@2x.png" />

          <a class="a">1</a>
          <img class="frame-child6" alt="" src="./public/ellipse-5@2x.png" />

          <img class="frame-child7" alt="" src="./public/ellipse-7@2x.png" />

          <img class="frame-child8" alt="" src="./public/ellipse-5@2x.png" />

          <a class="a1">2</a>
          <a class="a2">3</a>
          <a class="a3">4</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script>
        function formatAdn(input) {
            // Remove non-numeric characters from the input value
            var numericValue = input.value.replace(/\D/g, '');

            // Ensure the value is not longer than 12 digits
            numericValue = numericValue.substring(0, 12);

            // Format the value as "1234-5678-9101"
            var formattedValue = numericValue.replace(/(\d{4})(\d{4})(\d{4})/, '$1-$2-$3');

            // Update the input value
            input.value = formattedValue;
        }
    </script>
 <script>
    function convertToUpperCase(inputElement) {
        inputElement.value = inputElement.value.toUpperCase();
    }
</script>
<script>
        function formatPAN(input) {
            // Remove any non-alphanumeric characters
            let formattedValue = input.value.replace(/[^a-zA-Z0-9]/g, '');

            // Apply the PAN format (AAAAA-1111-A)
            if (formattedValue.length > 5) {
                formattedValue = formattedValue.substring(0, 5) + '-' +
                    formattedValue.substring(5, 9) + '-' +
                    formattedValue.substring(9, 10);
            }

            // Update the input value
            input.value = formattedValue.toUpperCase();
        }
    </script>
<script>
  // Get the current date
  const currentDate = new Date();

  // Calculate the last day of the next month
  const nextMonth = new Date(currentDate);
  nextMonth.setMonth(currentDate.getMonth() + 2);
  nextMonth.setDate(0); // Set to the last day of the current month

  // Format the date as "YYYY-MM-DD" for the max attribute
  const maxDate = nextMonth.toISOString().split('T')[0];

  // Set the max attribute of the input element
  document.getElementById('dojInput').setAttribute('max', maxDate);
</script>
<script>
  $('#demoModal').modal('show');
</script>
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


    var employeeManagement = document.getElementById("employeeManagement");
    if (employeeManagement) {
      employeeManagement.addEventListener("click", function (e) {
        window.location.href = "./index.php";
      });
    }

    var dashboard = document.getElementById("dashboard");
    if (dashboard) {
      dashboard.addEventListener("click", function (e) {
        window.location.href = "./index.php";
      });
    }
  </script>
</body>
<script>
  let currentSection = 1;

  function showSection(section) {
    document.getElementById('section' + currentSection).classList.remove('active');
    document.getElementById('section' + section).classList.add('active');
    currentSection = section;
  }
  document.getElementById('pdfFile').addEventListener('change', function(event) {
  const file = event.target.files[0];
  const pdfPreview = document.getElementById('pdfPreview');

  // Clear previous preview
  pdfPreview.innerHTML = '';

  if (file) {
    const fileReader = new FileReader();

    fileReader.onload = function() {
      const typedarray = new Uint8Array(this.result);
      displayPDF(typedarray);
    };

    fileReader.readAsArrayBuffer(file);
  }
});

function displayPDF(pdfData) {
  const loadingTask = pdfjsLib.getDocument({
    data: pdfData
  });

  loadingTask.promise.then(function(pdf) {
    const scale = 1;
    const canvas = document.createElement('canvas');
    const pdfPreview = document.getElementById('pdfPreview');

    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
      pdf.getPage(pageNum).then(function(page) {
        const viewport = page.getViewport({
          scale
        });
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        const renderContext = {
          canvasContext: canvas.getContext('2d'),
          viewport: viewport
        };

        page.render(renderContext).promise.then(function() {
          pdfPreview.appendChild(canvas);
        });
      });
    }
  }).catch(function(error) {
    console.error('Error occurred while rendering the PDF:', error);
  });
}

  
</script>
<script>
        $(document).ready(function(){
            $('#frm').submit(function(event){
                event.preventDefault();
                var recipientEmail = $('#email').val();
 var purpose = $('#purpose').val();
                $.ajax({
                    type: 'POST',
                    url: 'mail.php',
                    data: { recipientEmail: recipientEmail,purpose: purpose},
                    success: function(response){
                        $('#response').html(response);
                    }
                });
            });
        });
    </script>


</html>