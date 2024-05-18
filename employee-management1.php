<?php
@include 'inc/config.php';
session_start();
$hrmsHost = "localhost";
$hrmsUser = "root";
$hrmsPassword = "";
$hrmsDatabase = "ems";

$leaveManagementHost = "localhost";
$leaveManagementUser = "root";
$leaveManagementPassword = "";
$leaveManagementDatabase = "simpleave";
// Establish connection to the HRMS database
$hrmsCon = mysqli_connect($hrmsHost, $hrmsUser, $hrmsPassword, $hrmsDatabase);

// Check connection
if (!$hrmsCon) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
    // Handle session not set, redirect to login
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
    // Fetch user details from HRMS
    $sqlHRMS = "SELECT * FROM emp WHERE empemail = '{$_SESSION['user_name']}'";
    $resultHRMS = mysqli_query($con, $sqlHRMS);
    $rowHRMS = mysqli_fetch_assoc($resultHRMS);

    if ($resultHRMS) {
        // Establish connection to the Leave Management System database
        $leaveManagementCon = mysqli_connect($leaveManagementHost, $leaveManagementUser, $leaveManagementPassword, $leaveManagementDatabase);

        // Check connection
        if (!$leaveManagementCon) {
            die("Connection failed: " . mysqli_connect_error());
        }
?>
        <div class='relative overflow-x-auto shadow-md sm:rounded-lg'>
        <table class='w-full text-sm text-left rtl:text-right text-blue-100 dark:text-blue-100'>
            <thead class='text-xs text-white uppercase bg-blue-600 dark:text-white'>
                <tr>
                <th scope='col' class='px-6 py-3'>
                        Employee IN
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        Gatepass ID
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        Gatepass Type
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        Issued By
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        Approved/Rejected By
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        Approval Status
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        Issued OUT Time
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        IN Time
                    </th>
                    <th scope='col' class='px-6 py-3'>
                        OUT Duration
                    </th>
                </tr>
            </thead>
           
            
            <tbody>
            <?php
        $sqlLeaveManagement = "SELECT * FROM leaves WHERE mobile = '{$rowHRMS['empph']}' ORDER BY id DESC";
        $resultLeaveManagement = mysqli_query($leaveManagementCon, $sqlLeaveManagement);

        if ($resultLeaveManagement) {
            while ($rowLeaveManagement = mysqli_fetch_assoc($resultLeaveManagement)) {
                ?>
      
                        <tr class='bg-blue-500 border-b border-blue-400'>
                        <th scope='row' class='flex items-center px-6 py-4 text-gray-900 whitespace-nowrap text-white'>
                        <?php 
                                     if(($rowLeaveManagement['status'] == 0 || $rowLeaveManagement['status'] == 2 || $rowLeaveManagement['way'] == '1 WAY')){
                                        echo "-";
                                     }
                                     elseif ($rowLeaveManagement['status'] == 1 & $rowLeaveManagement['way'] == '2 WAY' & $rowLeaveManagement['mark'] == '0'){
                                        echo "<div class='flex items-center'>
                                        <img src='./public/cross.png'  width='65px' style='margin-top: 20px;'>
                                    </div>";
                                     }
                                     else{
                                        echo " <div class='flex items-center'>
                                        <img src='./public/tick.png' width='55px' style='margin-top: 20px;'>
                                    </div>";
                                     }
                         
                                  ?>
                    
                            </th>
                            <td class='px-6 py-4'>
                            <div class='ps-3'>
                                    <div class='text-base font-semibold'><?php echo date('Ymd',strtotime($rowLeaveManagement['leavedate']));?>-000<?php echo $rowLeaveManagement['id'];?></div>
                                    <div class='font-normal '></div>
                                </div>  
                            </td>
                            <td class='px-6 py-4'>
                            <?php echo $rowLeaveManagement['way']?>
                            </td>
                            <td class='px-6 py-4'>
                            <?php echo $rowLeaveManagement['email']?>
                            </td>
                            <td class='px-6 py-4'>
                            <?php echo $rowLeaveManagement['email1']?>
                            </td>
                            <td class='px-6 py-4'>
                            <?php 
                                     if ($rowLeaveManagement['status'] == 0) {
                                        echo "<span class='badge badge-warning'>Pending </span>";
                                     }
                                     elseif ($rowLeaveManagement['status'] == 1){
                                        echo "<span class='badge badge-success'>Approved</span>";
                                     }
									 elseif ($rowLeaveManagement['status'] == 2){
                                        echo "<span class='badge badge-danger'>Rejected</span>";
                                     }
                         
                                  ?>
                            </td>
                            <td class='px-6 py-4'>
                                <a href='#' class='font-medium text-white hover:underline'><?php 
								 if( $rowLeaveManagement['status'] == 2){
									echo "<span class='badge badge-danger'>Gatepass<br>Rejected</span>";
								 }
								 else {
									echo $rowLeaveManagement['leavedate'];
								 }
								 ?></a>
                            </td>
                            <td class='px-6 py-4'>
                                <a href='#' class='font-medium text-white hover:underline'><?php 
                                    if( $rowLeaveManagement['status'] == 2){
                                        echo "<span class='badge badge-danger'>Gatepass<br>Rejected</span>";
									 }
									 elseif($rowLeaveManagement['mark'] == 0 & $rowLeaveManagement['way'] == '2 WAY') {
                                        echo "<span class='badge badge-danger'>to be marked</span>";
                                     }
									 elseif( $rowLeaveManagement['mark'] == 0 & $rowLeaveManagement['way'] == '1 WAY'){
                                        echo "<span style='font-size:15px !important;' class='badge badge-default'>N/A</span>";
									 }
									
						
                                     else{
										echo date('Y-m-d H:i:s',strtotime('+12 hours +30 minutes',strtotime($rowLeaveManagement['marktime'])));
                                     }
                              
                                  ?></a>
                            </td>
                            <td class='px-6 py-4'>
                                <a href='#' class='font-medium text-white hover:underline'>  <?php if ($rowLeaveManagement['status'] == 2 ){
									echo "<span class='badge badge-danger'>Not Available<br>as Gatepass Rejected</span>";
								 }
								 elseif ($rowLeaveManagement['way'] == '1 WAY'){
									echo "<span style='font-size:15px !important;' class='badge badge-default'>N/A</span>";
								 }
                                 elseif($rowLeaveManagement['mark'] == 0 & $rowLeaveManagement['way'] == '2 WAY') {
                                    echo "<span class='badge badge-danger'>to be marked</span>";
                                 }
								 elseif($rowLeaveManagement['status'] == 0) {
									echo "<span class='badge badge-warning'>Pending <br>for Approval </span>";
								 }
								 
								 else{
								 $date1 = new DateTime(date('Y-m-d H:i:s',strtotime('+12 hours +30 minutes',strtotime($rowLeaveManagement['marktime']))));
								 $date2 = new DateTime($rowLeaveManagement['leavedate']);
								 $interval = $date1->diff($date2);
								 echo $interval->format('%Hhrs:%imins:%ssecs');
								 } ?></a>
                            </td>
                        </tr>
                        <?php
            }
            ?>
        </tbody>
                    </tbody>
                </table>
            </div>

            

<?php
            
        } else {
            echo "Error in Leave Management System query: " . mysqli_error($leaveManagementCon);
        }

        // Close connection to Leave Management System
        mysqli_close($leaveManagementCon);
    } else {
        echo "Error in HRMS query: " . mysqli_error($con);
    }

    // Close connection to HRMS
    mysqli_close($hrmsCon);
} else {
    // Handle account termination, redirect to login
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

<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>