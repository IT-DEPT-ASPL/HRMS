<?php

@include 'inc/config.php';

session_start();

if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
  header('location:loginpage.php');
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/map.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <style>
        table {
        z-index: 100;
  border-collapse: collapse;
  background-color: white;
}

th, td {
  padding: 1em;
  background: white;
  color: rgb(52, 52, 52);
  border-bottom: 2px solid rgb(193, 193, 193); 
}
input,select{
    font-size:20px;
}
.container {
    padding-bottom: 20px;
    margin-right: -60px;
}

.input-text:focus{
    box-shadow: 0px 0px 0px;
    border-color:#fd7e14;
    outline: 0px;
}
.form-control {
    border: 1px solid #fd7e14;
}
    </style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>
  <body>
    <div class="biometricmap">
      <div class="bg"></div>
      <img
        class="biometricmap-child"
        alt=""
        src="./public/rectangle-1@2x.png"
      />

      <div class="biometric-mapping">/Biometric Mapping</div>
      <img class="biometricmap-item" alt="" src="./public/rectangle-2@2x.png" />

      <img class="logo-1-icon" alt="" src="./public/logo-1@2x.png" />

      <a class="anikahrm">
        <span>Anika</span>
        <span class="hrm">HRM</span>
      </a>
      <h5 class="hr-management">HR Management</h5>
      <button class="biometricmap-inner" autofocus="{true}"></button>
      <div class="logout">Logout</div>
      <a class="employee-list" href="./employee-management.php">Employee List</a>
      <a class="leaves" href="./leave-management.php">Leaves</a>
      <a class="onboarding" href="./onboarding.php">Onboarding</a>
      <a class="attendance" href="./attendence.php">Attendance</a>
      <div class="payroll">Payroll</div>
      <div class="reports">Reports</div>
      <a class="fluentpeople-32-regular" style="margin-top:130px;">
        <img class="vector-icon" alt="" src="./public/vector.svg" />
      </a>
      <a class="fluent-mdl2leave-user" style="margin-top:-65px;">
        <img class="vector-icon1" alt="" src="./public/vector1.svg" />
      </a>
      <a class="fluentperson-clock-20-regular" style="margin-top:-65px;">
        <img class="vector-icon2" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" alt="" src="./public/vector2.svg" />
      </a>
      <a class="uitcalender" style="margin-top:-260px; z-index:9999;-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);">
        <img class="vector-icon3" alt="" src="./public/vector3.svg" />
      </a>
      <img
        class="arcticonsgoogle-pay"
        alt=""
        src="./public/arcticonsgooglepay.svg"
      />

      <img
        class="streamlineinterface-content-c-icon"
        alt=""
        src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg"
      />

      <!--<img class="ellipse-icon" alt="" src="./public/ellipse-1@2x.png" />-->

      <!--<img-->
      <!--  class="material-symbolsperson-icon"-->
      <!--  alt=""-->
      <!--  src="./public/materialsymbolsperson.svg"-->
      <!--/>-->

    <a href="./index.php">  <img class="rectangle-icon" alt="" src="./public/rectangle-4@2x.png" /></a>

      <a href="./index.php" class="dashboard">Dashboard</a>
      <a class="akar-iconsdashboard" style="margin-top:263px;" >
        <img class="vector-icon4" alt="" src="./public/vector4.svg" />
      </a>
      <img class="tablerlogout-icon" alt="" src="./public/tablerlogout.svg" />

      <div class="frame-div"></div>
      <div class="rectangle-div"></div>
      <div class="container" style="margin-top:500px; ">
    <div class="row">
       <div class="col-md-8">
           <div class="input-group mb-3" style="width:400px">
  <input type="text" class="form-control input-text"id="filterInput" onkeyup="filterTable()" placeholder="Search for employee name...">
  <div class="input-group-append" style="background:white;">
    <span style="border-radius:0px;pointer-events: none; border-color: #fd7e14;" class="btn btn-outline-warning btn-lg" type="button"><i class="fa fa-search"></i></span>
  </div>
</div>
       </div>        
    </div>
</div>
      <div style="position: absolute; margin-top: -20px; width:1950px; overflow-y:auto; height:950px;">
          <table class="data"  id="attendanceTable" style="margin-left:auto; margin-right:auto;"> 
        <tr class='header-row'>
          <th class='static-cell'></th>
          <th class='static-cell'>Employee Id</th>
          <th class='static-cell'>Employee Name</th>
          <th class='static-cell'>CAMS UserID</th>
        </tr>
        <?php
           $sql = "SELECT * FROM emp WHERE empstatus = 0 AND UserID != 0 ORDER BY UserID ASC";

        $que = mysqli_query($con, $sql);
        $cnt = 1;
        while ($result = mysqli_fetch_assoc($que)) {
        ?>
        <tr>
        <td><img class="hovpic" src="pics/<?php echo $result['pic']; ?>" width="40px" height="40px" style="border-radius: 50px; border: 0.5px solid rgb(161, 161, 161);"></td>
          <td><?php echo $result['emp_no']; ?></td>
          <td><?php echo $result['empname']; ?></td>
          <td><?php echo $result['UserID']; ?></td>
        </tr>
        <?php $cnt++;
        } ?>
      </table>
      </div>




   <h3 class="userid-mapping" style="width:300px;">CAMS UserID Mapping</h3>
      <img class="line-icon" alt="" src="./public/line-12@2x.png" />

      <label class="employee-name">Employee Name*</label>
      <label class="user-id">UserID</label>
      <form id="updateForm">
        <select name="employee" class="rectangle-input" id="employeeSelect">
            <option value="">--select--</option>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ems";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT empname FROM emp where empstatus=0";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["empname"] . "'>" . $row["empname"] . "</option>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();
            ?>
        </select>
        <input class="biometricmap-child1" type="text" placeholder="Enter CAMS UserID" name="UserID" />

      <button class="rectangle-button" id="rectangleButton1" style="color:white; font-size:25px;">Map</button>
      </form>
    </div>
    <script>
function filterTable() {
    var input = document.getElementById('filterInput');
    var filter = input.value.toUpperCase();

    var table = document.getElementById('attendanceTable');

    var rows = table.getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var shouldShow = false;

        if (i === 0) {
            shouldShow = true;
        } else {
            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];

                var isHeaderCell = cell.classList.contains('static-cell');

                if (!isHeaderCell) {
                    var txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        shouldShow = true;
                        break;
                    }
                }
            }
        }

        if (shouldShow) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

</script>
    <script>
      var rectangleButton1 = document.getElementById("rectangleButton1");
      if (rectangleButton1) {
        rectangleButton1.addEventListener("click", function (e) {
        });
      }
      
      var map = document.getElementById("map");
      if (map) {
        map.addEventListener("click", function (e) {
        });
      }
      </script>
<script>
    $(document).ready(function(){
      
        $("#updateForm").submit(function(e){
            e.preventDefault();

            var selectedEmployee = $("#employeeSelect").val();
            var userId = $("input[name='UserID']").val();
            
            $.ajax({
                type: "POST",
                url: "update_userid.php", 
                data: { employee: selectedEmployee, userId: userId },
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'UserID Mapped!',
                        text: response,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'map.php';
                        }
                    });

                    $("#employeeSelect").val('');
                    $("input[name='UserID']").val('');
                }
            });
        });
    });
</script>
  </body>
</html>
