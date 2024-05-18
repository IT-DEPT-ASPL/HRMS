<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./css/global6.css" />
    <link rel="stylesheet" href="./css/email-form.css" />
    <link rel="stylesheet" href="./css/email-form2.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400&display=swap" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <style>
        table {
            z-index: 100;
            border-collapse: collapse;
            /* border-radius: 200px; */
            background-color: white;
            /*   overflow: hidden; */
        }

        th,
        td {
            font-size: 20px;
            padding: 1em;
            background: white;
            color: rgb(52, 52, 52);
            border-bottom: 2px solid rgb(193, 193, 193);
            text-align: center;
        }
        th{
            font-weight: 600;
        }
        .container {
    padding-bottom: 20px;
    margin-right: -30px;
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
</head>

<body>
    <div class="emailform">
        <div class="bg1"></div>
        <img class="emailform-child" alt="" src="./public/rectangle-1@2x.png" />

        <img class="logo-1-icon1" alt="" src="./public/logo-1@2x.png" />

        <a class="anikahrm1">
            <span>Anika</span>
            <span class="hrm1">HRM</span>
        </a>
        <a class="employee-management1" id="employeeManagement">Attendance Management</a>
        <!-- <img class="uitcalender-icon1" alt="" src="./public/uitcalemnder.svg" /> -->
              <div class="container" style=" margin-top:110px; margin-left:730px ">
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
        <div class="rectangle-parent" style="overflow: auto;">

        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$targetDate = date("Y-m-d");
$sql = "SELECT empname
        FROM emp
        WHERE empstatus = 0
          AND NOT EXISTS (
              SELECT 1
              FROM CamsBiometricAttendance
              WHERE CamsBiometricAttendance.UserID = emp.UserID
                AND CamsBiometricAttendance.AttendanceType = 'CheckIn'
                AND DATE(CamsBiometricAttendance.AttendanceTime) = '$targetDate'
          )
          AND NOT EXISTS (
              SELECT 1
              FROM absent
              WHERE absent.empname = emp.empname
                AND DATE(absent.AttendanceTime) = '$targetDate'
          )";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<form>';
    echo '<table class="data" id="attendanceTable" style="margin-left: auto; margin-right: auto;">';
    echo '<tr><th>S.No</th><th>Employee Name</th><th><input type="checkbox" id="checkAll" onclick="toggleCheckboxes(this)"> Mark Absent</th></tr>';

    $cnt = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $cnt . '</td>';
        echo '<td>' . $row['empname'] . '</td>';
        echo '<td><input type="checkbox" class="absentCheckbox" name="absentCheckbox[]" value="'.$row['empname'].' required"></td>';
        echo '</tr>';
        $cnt++;
    }

    echo '</table>';
    echo '<button type="submit" name="markAbsent" class="btn btn-outline-primary" style="display: block; margin-left: auto; margin-right: auto; margin-top: 10px;">Mark Absent</button>';
    echo '</form>';
} else {
    echo "";
}
  echo "<br>"  ;
$conn->close();
?>
            
           <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT empname, AttendanceTime FROM absent";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Marked time</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        $markedTime = new DateTime($row['AttendanceTime']);
        $markedTime->modify('+5 hours 30 minutes');

        echo '<tr>
                <td>' . $row['empname'] . '</td>
             <td>' . $markedTime->format('Y-m-d H:i:s') . '</td>
                <td></td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "No records found";
}

$conn->close();
?>

     </div>

    </div>

</body>
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
    function toggleCheckboxes(checkbox) {
        const checkboxes = document.querySelectorAll('.absentCheckbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = !checkbox.checked;
        });
    }

    $(document).ready(function () {
        $("form").submit(function (event) {
            // Prevent the default form submission
            event.preventDefault();

            const selectedEmployees = [];
            $('.absentCheckbox:checked').each(function () {
                selectedEmployees.push($(this).closest('tr').find('td:nth-child(2)').text());
            });

            // Show SweetAlert confirmation box
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to mark selected employees as absent. Continue?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Mark Absent'
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, proceed with the form submission
                    Swal.fire({
                        title: 'Loading...',
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    // Use AJAX to submit the form data
                    $.ajax({
                        type: "POST",
                        url: "mark_absent.php",
                        data: { selectedEmployees: selectedEmployees },
                        success: function (response) {
                            Swal.close();
                            window.location.href = 'markabsent.php';
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.close();
                        }
                    });
                }
            });
        });
    });
</script>


</html>