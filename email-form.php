<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
    $prefilledEmail = $_GET['email'];
    $servername = "localhost";
    $username = "Anika12";
    $password = "Anika12";
    $dbname = "ems";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    $query = "SELECT COUNT(*) AS count FROM onb WHERE empemail = '$prefilledEmail' UNION SELECT COUNT(*) FROM emp WHERE empemail = '$prefilledEmail'";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            header("Location: filled.html");
            exit();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/global6.css" />
    <link rel="stylesheet" href="./css/email-form.css" />
    <link rel="stylesheet" href="./css/email-form2.css" />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
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

        .avatar-upload .avatar-edit input+label {
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

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input+label:after {
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

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .rectangle-input {
      text-transform: uppercase;
    }
    </style>
    <script>
		$(document).ready(function(e){
            $("#form").on('submit', function(e) {
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
        url: 'mailupload.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
          $('.submitBtn').attr("disabled", "disabled");
          $('#form').css("opacity", ".5");
        },
        success: function (msg) {
          // Hide loading spinner
          Swal.close();

          console.log(msg);
          $('.statusMsg').html('');
          if (msg == 'ok') {
            $('#form')[0].reset();
            swal({
              type: "success",
              title: "Success! We have your details now!"
            }, function () {
              window.location = "thankyou.html";
            });
          } else {
            $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Some problem occurred, please try again.</span>');
          }
          $('#form').css("opacity", "");
          $(".submitBtn").removeAttr("disabled");
        }
      });
    });
            $("#pdfFile").change(function() {
				var file = this.files[0];
				var imagefile = file.type;
				var match= ["image/jpeg","image/png","image/jpg"];
				if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
					alert('Please select a valid pdf file .');
					$("#pdfFile").val('');
					return false;
				}
			});
		});
	</script>
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

</head>

<body>
    <div class="emailform">
        <div class="bg1"></div>
        <img class="emailform-child" alt="" src="./public/rectangle-1@2x.png" />

        <img class="logo-1-icon1"  alt="" src="./public/logo-1@2x.png" />

        <a class="anikahrm1">
            <span>Anika</span>
            <span class="hrm1">HRM</span>
        </a>
        <a class="employee-management1" id="employeeManagement">Employee Management</a>
        <img class="uitcalender-icon1" alt="" src="./public/uitcalender.svg" />

        <div class="section active" id="section1">
            
            <form id='form'>

            
            <div class="bxhome1" id="bxhome"></div>
            <div class="rectangle-group">
                
                <div class="rectangle-div">
                    <div class="avatar-upload" style="margin-top: 570px; margin-left: 70px;">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" name="file1" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                            
                        </div>
                        
                        <div class="avatar-preview">
                            <div id="imagePreview"
                                style="background-image: url(./public/screenshot-20231027-141446-1@2x.png);">
                            </div>
                        </div>
                    </div>
                </div>
                <label class="employee-name">Employee Name*</label>
                <label class="phone-number">Phone Number</label>
                <label class="marital-status">Marital Status</label>
                <label class="date-of-birth">Date of Birth</label>
                <label class="email-id1">Email ID</label>
                <label class="gender">Gender</label>
                <h3 class="personal-details">Personal Details</h3>
                <img class="frame-child6" alt="" src="./public/line-121@2x.png" />

                <input class="frame-child7" name="name" type="text" oninput="convertToUpperCase(this)"/>

                <input class="frame-child8" name="mobile" type="tel"  maxlength="10"/>

                <select name="ms" class="frame-child9">
                    <option value="">--select--</option>
                    <option value="Married">Married</option>
                    <option value="Single">Single</option>
                  </select>
        

                <input name="dob" class="frame-child10" type="date"  max="2005-12-31"/>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) { 
     
                $prefilledEmail = $_GET['email'];
                ?>
  
             <?php
              echo"<input class='frame-child11' name='email' type='text' value='$prefilledEmail' readonly />";
                  }
               ?>

                <select name="gen" class="frame-child12">
                    <option value="">--select--</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                  

                <span class="frame-child13" id="rectangleButton" onclick="showSection(2)"></span>

                
                <a class="next1" id="next" style="color: white;" onclick="showSection(2)">Next</a>
                
            </div>
        </div>
        
        <div class="section" id="section2">

            <div class="bxhome" id="bxhome"></div>
            <div class="rectangle-parent">
                <div class="frame-inner"></div>
                <label class="pan">PAN</label>
                <label class="bank-account-number">Bank Account Number</label>
                <label class="bank-name">Bank Name</label>
                <label class="aadhaar-number">Aadhaar Number</label>
                <label class="ifsc-code">IFSC Code</label>
                <h3 class="identity-details">Identity Details</h3>
                <img class="line-icon" alt="" src="./public/line-12@2x.png" />

                <input class="rectangle-input" name="pan" type="text" maxlength="15" placeholder="ABCD-1234-E" oninput="formatPAN(this)" />


                <input class="frame-child1" name="ban" type="text" />

                <select name="bn" class="frame-child2">
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
                  </select>
                  <input class="frame-child3" name="adn" type="text" oninput="formatAdn(this)" maxlength="14" />

                <input class="frame-child4" name="ifsc" type="text" />
                <input type="hidden" name="empstatus" value="0">
                <span type="submit" class="rectangle-button" data-toggle="modal" data-target="#demoModal"
                    id="rectangleButton"></span>
                <span onclick="showSection(1)" class="frame-child5" id="rectangleButton1"></span>
                <a class="next" id="next" style="color: white;" data-toggle="modal" data-target="#demoModal">Save</a>
                <a class="prev" onclick="showSection(1)" style="color: white;" id="prev">Prev</a>
                <div class="modal" id="demoModal" style="  margin-top: 300px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="color: #636363;">Employee Details </h4>
                                <span type="button" class="close" data-dismiss="modal">&times;</span>
                            </div>
                            <div class="modal-body" style="color: #636363;">
                                Are you sure sending the details?

                            </div>
                            <div class="modal-footer">

                                <span type="button" class="btn btn-danger" data-dismiss="modal">No</span>
                                <button type="submit" class="btn btn-success submitButn" >Yes</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
    <script>
    function convertToUpperCase(inputElement) {
        inputElement.value = inputElement.value.toUpperCase();
    }
</script>




    <script>
        $('#demoModal').modal('show')
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function () {
            readURL(this);
        });
        let currentSection = 1;

        function showSection(section) {
            document.getElementById('section' + currentSection).classList.remove('active');
            document.getElementById('section' + section).classList.add('active');
            currentSection = section;
        }
        var employeeManagement = document.getElementById("employeeManagement");
        if (employeeManagement) {
            employeeManagement.addEventListener("click", function (e) {
                // Please sync "EmployeeDashboard" to the project
            });
        }

        var bxhome = document.getElementById("bxhome");
        if (bxhome) {
            bxhome.addEventListener("click", function (e) {
                // Please sync "EmployeeDashboard" to the project
            });
        }

        var rectangleButton = document.getElementById("rectangleButton");
        if (rectangleButton) {
            rectangleButton.addEventListener("click", function (e) {
                // Please sync "AddEmployee2" to the project
            });
        }

        var next = document.getElementById("next");
        if (next) {
            next.addEventListener("click", function (e) {
            });
        }
    </script>
</body>

</html>