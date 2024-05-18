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

    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/records.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <style>
        .content {
            display: none;
        }

        .show {
            display: block;
        }

       ::-webkit-scrollbar {
    width: 8px;
}
 
::-webkit-scrollbar-track {
    background-color: #ebebeb;
    -webkit-border-radius: 10px;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #cacaca; 
}
        .mult-select-tag {
            display: flex;
            width: 100%;
            flex-direction: column;
            align-items: center;
            position: relative;
            --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --tw-shadow-color: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
            --border-color: rgb(218, 221, 224);
            font-family: Verdana, sans-serif;
        }

        .mult-select-tag .wrapper {
            width: 100%;
        }

        .mult-select-tag .body {
            display: flex;
            border: 1px solid var(--border-color);
            background: white;
            min-height: 2.15rem;
            width: 100%;
            min-width: 14rem;

        }

        .mult-select-tag .input-container {
            display: flex;
            flex-wrap: wrap;
            flex: 1 1 auto;
            padding: 0.1rem;
            align-items: center;
        }

        .mult-select-tag .input-body {
            display: flex;
            width: 100%;
        }

        .mult-select-tag .input {
            flex: 1;
            background: transparent;
            border-radius: 0.25rem;
            padding: 0.45rem;
            margin: 10px;
            color: #2d3748;
            outline: 0;
            border: 1px solid var(--border-color);
        }

        .mult-select-tag .btn-container {
            color: #e2eBf0;
            padding: 0.5rem;
            display: flex;
            border-left: 1px solid var(--border-color);
        }

        .mult-select-tag button {
            cursor: pointer;
            width: 100%;
            color: #718096;
            outline: 0;
            height: 100%;
            border: none;
            padding: 0;
            background: transparent;
            background-image: none;
            text-transform: none;
            margin: 0;
        }

        .mult-select-tag button:first-child {
            width: 1rem;
            height: 90%;
        }


        .mult-select-tag .drawer {
            position: absolute;
            background: white;
            max-height: 15rem;
            z-index: 40;
            top: 98%;
            width: 100%;
            overflow-y: scroll;
            border: 1px solid var(--border-color);
            border-radius: 0.25rem;
        }

        .mult-select-tag ul {
            list-style-type: none;
            padding: 0.5rem;
            margin: 0;
        }

        .mult-select-tag ul li {
            padding: 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .mult-select-tag ul li:hover {
            background: rgb(243 244 246);
        }

        .mult-select-tag .item-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.2rem 0.4rem;
            margin: 0.2rem;
            font-weight: 500;
            border: 1px solid;
            border-radius: 9999px;
        }

        .mult-select-tag .item-label {
            max-width: 100%;
            line-height: 1;
            font-size: 0.75rem;
            font-weight: 400;
            flex: 0 1 auto;
        }

        .mult-select-tag .item-close-container {
            display: flex;
            flex: 1 1 auto;
            flex-direction: row-reverse;
        }

        .mult-select-tag .item-close-svg {
            width: 1rem;
            margin-left: 0.5rem;
            height: 1rem;
            cursor: pointer;
            border-radius: 9999px;
            display: block;
        }

        .mult-select-tag .shadow {
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }

        .mult-select-tag .rounded {
            border-radius: .375rem;
        }
    </style>
</head>

<body>
    <div class="records3">
        <div class="bg13"></div>
        <img class="records-child" alt="" src="./public/rectangle-1@2x.png" />

        <img class="records-item" alt="" src="./public/rectangle-2@2x.png" />

        <img class="logo-1-icon13" alt="" src="./public/logo-1@2x.png" />

        <a class="anikahrm13" href="./index.php" id="anikaHRM">
            <span>Anika</span>
            <span class="hrm13">HRM</span>
        </a>
        <a class="attendence-management3" href="./index.php" id="attendenceManagement">Manager-Designations</a>
        <button class="records-inner"></button>
        <div class="logout13">Logout</div>
        <div class="payroll13">Payroll</div>
        <div class="reports13">Reports</div>
        <img class="uitcalender-icon13" alt="" src="./public/uitcalender.svg" />

        <img class="arcticonsgoogle-pay13" alt="" src="./public/arcticonsgooglepay.svg" />

        <img class="streamlineinterface-content-c-icon13" alt="" src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg" />

        <img class="records-child2" style="margin-top: -262px;" alt="" src="./public/rectangle-4@2x.png" />

        <a class="dashboard13" href="./index.php" style="color: white;" id="dashboard">Dashboard</a>
        <a class="fluentpeople-32-regular13" id="fluentpeople32Regular">
            <img class="vector-icon67" alt="" src="./public/vector7.svg" />
        </a>
        <a class="employee-list13" id="employeeList">Employee List</a>
        <a class="akar-iconsdashboard13" href="./index.php" id="akarIconsdashboard">
            <img class="vector-icon68" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" alt="" src="./public/vector3.svg" />
        </a>
        <img class="tablerlogout-icon13" alt="" src="./public/tablerlogout.svg" />

        <a class="leaves13" id="leaves">Leaves</a>
        <a class="fluentperson-clock-20-regular13" id="fluentpersonClock20Regular">
            <img class="vector-icon69" alt="" src="./public/vector1.svg" />
        </a>
        <a class="onboarding15" id="onboarding">Onboarding</a>
        <a class="fluent-mdl2leave-user13" id="fluentMdl2leaveUser">
            <img class="vector-icon70" alt="" src="./public/vector.svg" />
        </a>
        <a class="attendance13" style="color: black;">Attendance</a>
        <a class="uitcalender13">
            <img class="vector-icon71" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1);" alt="" src="./public/vector11.svg" />
        </a>
        <div class="oouinext-ltr1"></div>
        <div class="rectangle-parent21" style="margin-top: -70px;">
            <div class="frame-child176" style="height:300px;"></div>
            <div class="oouinext-ltr2"></div>
            <div class="employee-records">Assign Designation(s) to Manager</div>
            <div class="frame-child178"></div>
            <div class="employee-name7">Manager Name</div>
            <div class="designation4">Designation</div>
            <form id="updateForm">
            <div class="frame-child183" style="margin-left:-550px;">
            <button id="dropdownDefaultButton" style="width:90%;" class="text-gray-900 dark:text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  <span class="text-white">Select Empname</span>  
                <select  onchange="updateFields()" class="employeeSelect" style="width:90%;" >
                      <option value=""></option>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ems";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT empname, empemail,emp_no FROM emp WHERE empstatus=0 ORDER BY emp_no asc";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["empname"] . "|" . $row["empemail"] . "'>" . $row["empname"] . "</option>";
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                    ?>
                </select>
                </button>
                </div>
                <input type='hidden' name='empname' id='employeeNameField' value=''>
                <input type='hidden' name='email' id='employeeEmailField' value=''>

                <div class="frame-child183">
                <button id="dropdownDefaultButton" class="text-gray-900 dark:text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  <span class="text-white">Select Designations</span>  
               <select name="desgs[]" multiple="multiple" style="height:100px;" id="desgSelect">
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "ems";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT desg FROM dept";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['desg'] . '">' . $row['desg'] . '</option>';
                            }
                        } else {
                            echo '<option value="">No data available</option>';
                        }

                        $conn->close();
                        ?>
                    </select>

                       </button>
                
                </div>

                <button class="frame-child185" style="margin-top:-100px; color:white; font-size:25px;">Save</button>
                <!--<a class="search" style="margin-left: 10px;margin-top:-100px;">Save</a>-->
            </form>
            
            <div style="overflow-y:auto; height:500px; margin-top:350px; width:1120px;">
                <table class="data w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                  <tr>
                      <th scope="col" class="px-6 py-3">
                          Manager
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Desg(s)
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Status
                      </th>
                      <th scope="col" class="px-6 py-3">
                          Action
                      </th>
                  </tr>
              </thead>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                PRABHDEEP SINGH MAAN
                </td>
                <td class="px-6 py-4 text-xs" colspan="3">
                WEB DEVELOPER, MAINTENANCE SUPERVISOR, MAINTENANCE HELPER, ASST MAINTENANCE, MAINTENANCE MANAGER, CNC OPERATOR, PRESS BRAKE OPERATOR, FACILITY MANAGER, FACILITY ASST, PSO, FLOOR SUPERVISOR, QC ENGINEER, DESIGN ENGINEER, STORE MANAGER, ASST STORE INCHARGE
                </td>
              </tr>
                    <?php
                    $sql = "SELECT * FROM manager where status = 1 ORDER BY id ASC";
                    $que = mysqli_query($con, $sql);
                    while ($result = mysqli_fetch_assoc($que)) {
                    ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4"><?php echo $result['empname']; ?></td>
                            <td class="px-6 py-4"><?php echo $result['desg']; ?></td>
                            <td class="px-6 py-4">
                                <?php
                                if ($result['status'] == 1) {
                                    echo "Active";
                                } elseif ($result['status'] == 0) {
                                    echo "Inactive";
                                }
                                ?>
                            </td>
                            <td name="manager" class="px-6 py-4">
                                <form class="managerForm" data-id="<?php echo $result['id']; ?>" data-status="<?php echo $result['status']; ?>">
                                    <button type="button" style="margin-bottom:-10px;" class="actionBtn px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <?php
                                        if ($result['status'] == 1) {
                                            echo 'Remove as Manager';
                                        } else {
                                            echo '<span >Removed</span>';
                                        }
                                        ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>


            </div>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script> -->
            <script>
                $(document).ready(function() {
                    $(".actionBtn").click(function() {
                        var form = $(this).closest(".managerForm");
                        var id = form.data("id");
                        var status = form.data("status");

                        var actionText = (status == 1) ? 'no more a Manager' : 'as Manager';
                        var confirmText = (status == 1) ? 'Remove as Manager' : 'Make as Manager';

                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'This action will make this employee ' + actionText + '!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: confirmText,
                            cancelButtonText: 'Cancel',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                toggleManagerStatus(id, status);
                            }
                        });
                    });

                    function toggleManagerStatus(id, status) {
                        $.ajax({
                            type: "POST",
                            url: "updatemanager.php",
                            data: {
                                toggleStatus: true,
                                id: id,
                                status: status
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.status === "success") {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        window.location.href = 'manager.php';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: response.message,
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An unexpected error occurred.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            </script>
            <script>
                $(document).ready(function() {
                    $("#updateForm").submit(function(e) {
                        e.preventDefault();
                        var empname = $("input[name='empname']").val();
                        var email = $("input[name='email']").val();
                        var desgs = $("select[name='desgs[]']").val();
                        var status = 1;

                        $.ajax({
                            type: "POST",
                            url: "mgr.php",
                            data: {
                                empname: empname,
                                email: email,
                                desgs: desgs,
                                status: status
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Manager added!',
                                    text: response,
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'manager.php';
                                    }
                                });
                                $("#updateForm")[0].reset();
                            }
                        });
                    });
                });
            </script>

            <script>
                function updateFields() {
                    var selectedEmployee = document.getElementsByClassName("employeeSelect")[0];
                    var nameField = document.getElementById("employeeNameField");
                    var emailField = document.getElementById("employeeEmailField");

                    var selectedValue = selectedEmployee.options[selectedEmployee.selectedIndex].value;
                    var values = selectedValue.split("|");

                    nameField.value = values[0];
                    emailField.value = values[1];
                }
            </script>
<script>
                new MultiSelectTag('desgSelect') 
                new MultiSelectTag('employeeSelect') 
            </script>
<script>
               
            </script>

            <script>
                var rectangleLink = document.getElementById("rectangleLink");
                if (rectangleLink) {
                    rectangleLink.addEventListener("click", function(e) {
                        window.location.href = "./attendence.php";
                    });
                }

                var rectangleLink2 = document.getElementById("rectangleLink2");
                if (rectangleLink2) {
                    rectangleLink2.addEventListener("click", function(e) {
                        window.location.href = "./punch-i-n.php";
                    });
                }

                var rectangleLink3 = document.getElementById("rectangleLink3");
                if (rectangleLink3) {
                    rectangleLink3.addEventListener("click", function(e) {
                        window.location.href = "./my-attendence.php";
                    });
                }

                var attendence = document.getElementById("attendence");
                if (attendence) {
                    attendence.addEventListener("click", function(e) {
                        window.location.href = "./attendence.php";
                    });
                }

                var punchINOUT = document.getElementById("punchINOUT");
                if (punchINOUT) {
                    punchINOUT.addEventListener("click", function(e) {
                        window.location.href = "./punch-i-n.php";
                    });
                }

                var myAttendence = document.getElementById("myAttendence");
                if (myAttendence) {
                    myAttendence.addEventListener("click", function(e) {
                        window.location.href = "./my-attendence.php";
                    });
                }

                var anikaHRM = document.getElementById("anikaHRM");
                if (anikaHRM) {
                    anikaHRM.addEventListener("click", function(e) {
                        window.location.href = "./index.php";
                    });
                }

                var attendenceManagement = document.getElementById("attendenceManagement");
                if (attendenceManagement) {
                    attendenceManagement.addEventListener("click", function(e) {
                        window.location.href = "./index.php";
                    });
                }

                var dashboard = document.getElementById("dashboard");
                if (dashboard) {
                    dashboard.addEventListener("click", function(e) {
                        window.location.href = "./index.php";
                    });
                }

                var fluentpeople32Regular = document.getElementById("fluentpeople32Regular");
                if (fluentpeople32Regular) {
                    fluentpeople32Regular.addEventListener("click", function(e) {
                        window.location.href = "./employee-management.php";
                    });
                }

                var employeeList = document.getElementById("employeeList");
                if (employeeList) {
                    employeeList.addEventListener("click", function(e) {
                        window.location.href = "./employee-management.php";
                    });
                }

                var akarIconsdashboard = document.getElementById("akarIconsdashboard");
                if (akarIconsdashboard) {
                    akarIconsdashboard.addEventListener("click", function(e) {
                        window.location.href = "./index.php";
                    });
                }

                var leaves = document.getElementById("leaves");
                if (leaves) {
                    leaves.addEventListener("click", function(e) {
                        window.location.href = "./leave-management.php";
                    });
                }

                var fluentpersonClock20Regular = document.getElementById(
                    "fluentpersonClock20Regular"
                );
                if (fluentpersonClock20Regular) {
                    fluentpersonClock20Regular.addEventListener("click", function(e) {
                        window.location.href = "./leave-management.php";
                    });
                }

                var onboarding = document.getElementById("onboarding");
                if (onboarding) {
                    onboarding.addEventListener("click", function(e) {
                        window.location.href = "./onboarding.php";
                    });
                }

                var fluentMdl2leaveUser = document.getElementById("fluentMdl2leaveUser");
                if (fluentMdl2leaveUser) {
                    fluentMdl2leaveUser.addEventListener("click", function(e) {
                        window.location.href = "./onboarding.php";
                    });
                }
            </script>
</body>

</html>