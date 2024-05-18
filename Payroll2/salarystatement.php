<?php

$con = mysqli_connect("localhost", "root", "", "ems");

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

  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/attendence.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .rectangle-div {
      position: absolute;
      border-radius: 10px;
      background-color: #ffffff;
      width: 250px;
      height: 40px;
      border: 1px solid rgb(185, 185, 185);
      box-shadow: 0 4px 4px rgba(0, 0, 0, 0.5);
    }
    .hidden111{
      display: none;
    }
  </style>
  <script>
    function toggleCheckboxes() {
      var masterCheckbox = document.getElementById("masterCheckbox");
      var checkboxes = document.querySelectorAll("#payrollTable tbody input[type='checkbox']");
      checkboxes.forEach(function(checkbox) {
        checkbox.checked = masterCheckbox.checked;
      });
    }
  </script>
</head>

<body>
  <div class="attendence4">
    <div class="bg14"></div>
    <div class="rectangle-parent22" style="margin-left: 60px;">
      <div class="frame-child187" style="margin-left: 80px;"></div>
      <a class="frame-child188" href="salarystatement.php"> </a>
      <a class="frame-child189" id="rectangleLink1" href="epf.html"> </a>
      <a class="frame-child190" id="rectangleLink2" href="esi.html"> </a>
      <!-- <a class="frame-child191" id="rectangleLink3" href="advances.html"> </a> -->
      <!-- <a class="frame-child191" id="rectangleLink3" href="loans.html" style="margin-left: 220px; "> </a> -->
      <a class="attendence5" style="margin-left: 7px; width: 140px; margin-top: -4px;" href="salarystatement.php">Statement</a>
      <a class="records5" id="records" style="margin-left: 20px; width: 110px; margin-top: -4px;" href="epf.html">EPF</a>
      <a class="punch-inout4" id="punchINOUT" style="margin-left: 60px; margin-top: -4px;" href="esi.html">ESI</a>
      <!-- <a class="my-attendence4" href="advances.html" id="myAttendence" style="margin-left: 30px; margin-top: -4px;  ">Advances</a> -->
      <!-- <a class="my-attendence4" href="loans.html" id="myAttendence" style="margin-left: 270px; margin-top: -4px;">Loans</a> -->
    </div>
    <div class="rectangle-parent23">
      <div style="display: flex; position: absolute; top: 0px; right: 60px;">
        <a href="exportCSV.php" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
          <div style="display: flex; gap: 10px;"><img src="./public/csv.png" width="25px" alt="">
            <span style="margin-top: 4px;">Export as CSV</span>
          </div>
        </a>
        <a href="print-details_ss.php" target="_blank" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
          <div style="display: flex; gap: 10px;"><img src="./public/pdf.png" width="25px" alt="">
            <span style="margin-top: 4px;">Export as PDF[1]</span>
          </div>
        </a>
        <a href="print-details_ssa.php" target="_blank" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
          <div style="display: flex; gap: 10px;"><img src="./public/pdf.png" width="25px" alt="">
            <span style="margin-top: 4px;">Export as PDF[2]</span>
          </div>
        </a>
      </div>
      <button onclick="openCard()" data-modal-target="default-modal" data-modal-toggle="default-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Open Card</button>
<br>
      <form id="payrollForm">
        <table id="payrollTable" style="margin-top: -40px;" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead style="text-align: center;" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
              </th>
              <th scope="col" class="px-6 py-3">
                Emp Name
              </th>
              <th scope="col" class="px-6 py-3">
                Gross salary
              </th>
              <th scope="col" class="px-6 py-3 hidden111">
                HRA
              </th>
              <th scope="col" class="px-6 py-3 hidden111">
                OA
              </th>
              <th scope="col" class="px-6 py-3 hidden111">
                BASIC PAY
              </th>
              <th scope="col" class="px-6 py-3">
                Loan Deductables
              </th>
              <th scope="col" class="px-6 py-3">
                Lop
              </th>
              <th scope="col" class="px-6 py-3">
                EPF
              </th>
              <th scope="col" class="px-6 py-3 hidden111">
                ESI
              </th>
              <th scope="col" class="px-6 py-3">
                Net Salary
              </th>
              <th scope="col" class="px-6 py-3">
                Confirmation 
                <!-- <input type="checkbox" id="masterCheckbox" onchange="toggleCheckboxes()"> -->
              </th>
              <th scope="col" class="px-6 py-3">
                Pay Slip
              </th>
            </tr>
          </thead>
          <?php
          $currentMonth = date('F Y');
$nextMonth = date('F Y', strtotime('+1 month'));

$sql = "SELECT emp.pic, p.*, 
           COALESCE(e.emi, 0) AS emi,
           COALESCE(e.emimonth, '$nextMonth') AS emimonth
    FROM payroll_msalarystruc AS p
    LEFT JOIN emp ON emp.empname = p.empname
    LEFT JOIN (SELECT empname, emi, emimonth
               FROM payroll_emi
               WHERE emimonth = '$nextMonth') AS e 
               ON p.empname = e.empname";

$que = mysqli_query($con, $sql);

if (mysqli_num_rows($que) > 0) {
    while ($result = mysqli_fetch_assoc($que)) {
        $pay = $result['netpay'] - $result['emi'];
        ?>
              <tbody style="text-align: center;">
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="px-6 py-4">
                    <img src="../pics/<?php echo $result['pic']; ?>" width="50px" style="border-radius: 50%;">
                  </td>
                  <td class="px-6 py-4"><?php echo $result['empname']; ?></td>
                  <td class="px-6 py-4"><?php echo $result['ctc']; ?></td>
                  <td class="px-6 py-4 hidden111">6250</td>
                  <td class="px-6 py-4 hidden111">6250</td>
                  <td class="px-6 py-4 hidden111">12500</td>
                  <td class="px-6 py-4"><?php echo $result['emi']; ?></td>
                  <td class="px-6 py-4">0</td>
                  <td class="px-6 py-4"><?php echo $result['epf1']; ?></td>
                  <td class="px-6 py-4 hidden111"><?php echo $result['esi1']; ?></td>
                  <td class="px-6 py-4"><?php echo $pay; ?></td>
                  <td class="px-6 py-4">
                    <!-- <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                      View More
                    </button> -->
                    <!-- <input type="checkbox" name="confirm[]" value="<?php echo $result['empname']; ?>"> -->
                  </td>
                  <td class="px-6 py-4">
                    <a href="print-details_pslip.php?empname=<?php echo urlencode($result['empname']); ?>" target="_blank" class="inline-flex self-center items-center p-2 text-sm font-medium text-center text-gray-900 bg-blue-600 rounded-lg hover:bg-blue-200 focus:ring-4 focus:outline-none dark:text-white focus:ring-blue-50 dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-600">
                      <svg class="w-4 h-4 text-white dark:text-white hover:text-blue-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                      </svg>
                    </a>
                  </td>
                </tr>

              </tbody>
            <?php
    }
} else {
    ?>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td colspan="8" class="px-6 py-4 text-center">No data</td>
            </tr>
          <?php
}
?>
          <br />
          <tr>
            <td>
              <button type="button" onclick="submitFormData()" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Confirm
              </button>
            </td>
          </tr>
        </table>
      </form>
      <?php
// Assuming you have already established a connection to your MySQL database
$con = mysqli_connect("localhost", "root", "", "ems");

// Checking the connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Function to fetch data from the payroll_ss table
function fetchDataFromPayroll($con)
{
    // Assuming your table structure has fields like employee_name, gross_salary, HRA, OA, etc.
    $query = "SELECT * FROM payroll_ss WHERE status = 0 LIMIT 1"; // Fetch only records with status 0
    $result = mysqli_query($con, $query);
    return mysqli_fetch_assoc($result); // Fetch one row of data
}

// Update status function
function updateStatus($con, $id)
{
    // Assuming you have an ID field in your table
    $query = "UPDATE payroll_ss SET status = 1 WHERE id = $id";
    mysqli_query($con, $query);
}

// Fetch data from payroll table
$data = fetchDataFromPayroll($con);

// Check if data exists
if ($data) {
    // Display modal card with fetched data
    echo '<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <!--<img src="./public/Bank.png" width="80px;" style="border-radius: 50%; margin-left:30px;" alt="">-->
                        <p style="display:flex; justify-content:center; color: #666666;">'.$data["empname"].'</p><hr/>
                    <p style="display:flex; margin-left:20px; margin-top:0px;">Fixed Salary Components:</p>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Gross Salary (CTC):</label>
                      <div style="display: flex; margin-left: 16px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="25000" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">HRA:</label>
                    <div style="display: flex; margin-left: 40px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="6250" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">OA:</label>
                      <div style="display: flex; margin-left: 140px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="6250" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Basic Pay:</label>
                    <div style="display: flex; margin-left: 0px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="11000" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <p style="display:flex; margin-left:20px;">Days Calculation:</p>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Total Days:</label>
                      <div style="display: flex; margin-left: 30px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><img src="./public/calendar3d.png" width="25px" /></div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="29" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Present Days:</label>
                    <div style="display: flex; margin-left: 25px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><img src="./public/calendar3d.png" width="25px" /></div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="23" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Leaves:</label>
                      <div style="display: flex; margin-left: 55px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><img src="./public/calendar3d.png" width="25px" /></div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="2" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Week Offs:</label>
                    <div style="display: flex; margin-left: 50px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><img src="./public/calendar3d.png" width="25px" /></div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="4" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">LOP:</label>
                      <div style="display: flex; margin-left: 80px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><img src="./public/calendar3d.png" width="25px" /></div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="0" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Pay Days:</label>
                    <div style="display: flex; margin-left: 53px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;"><img src="./public/calendar3d.png" width="25px" /></div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="29" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                       <p style="display:flex; margin-left:20px;">Salary as per number of days:</p>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Gross Salary (CTC):</label>
                      <div style="display: flex; margin-left: 16px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="25000" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">HRA:</label>
                    <div style="display: flex; margin-left: 40px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="6250" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">OA:</label>
                      <div style="display: flex; margin-left: 140px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="6250" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Basic Pay:</label>
                    <div style="display: flex; margin-left: 0px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="11000" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <p style="display:flex; margin-left:20px;">Deductions:</p>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">EPF:</label>
                      <div style="display: flex; margin-left: 130px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="29" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">ESIC:</label>
                    <div style="display: flex; margin-left: 42px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="23" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">TDS:</label>
                      <div style="display: flex; margin-left: 130px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="2" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Loan EMI:</label>
                    <div style="display: flex; margin-left: 5px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="4" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div>
                   <div style="display: flex;">
                    <div style="display: flex;">
                      <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">LOP:</label>
                      <div style="display: flex; margin-left: 130px;">
                          <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                          <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="0" readonly />
                          <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                      </div>
                  </div>
                  
                  <div style="display: flex;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Total Ded.:</label>
                    <div style="display: flex; margin-left: px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="29" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                   </div><hr/>
                   <div style="display: flex; justify-content:center;">
                    <label for="" style="font-weight: lighter; margin-top: 10px; font-size: 18px; margin-left: 20px;">Net Payout:</label>
                    <div style="display: flex; margin-left:10px;">
                        <div style="display: flex; border: 1px solid rgb(185,185,185); width: 30px; align-items: center; justify-content: center; background-color: rgb(240, 240, 240); border-top-left-radius: 10px; border-bottom-left-radius: 10px;">₹</div>
                        <input name="ags" id="ags" type="text" style="font-size: 18px; width: 90px; height: 40px; border: 1px solid rgb(185,185,185);" value="23500" readonly />
                        <div style="display: flex; width: 30px; align-items: center; border: 1px solid rgb(185,185,185); justify-content: center; background-color: rgb(240, 240, 240); border-top-right-radius: 10px; border-bottom-right-radius: 10px;">/-</div>
                    </div>
                </div>
                </div> 
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button onclick="updateStatus(\''.$data['id'].'\'); updateModal();" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Confirm</button>
                        <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Close</button>
                    </div>
                </div>
            </div>
        </div>';
} else {
    echo '<p>No more data available.</p>';
}
?>

    </div>
    <img class="attendence-child" alt="" src="./public/rectangle-1@2x.png" />

    <img class="attendence-item" alt="" src="./public/rectangle-2@2x.png" />

    <img class="logo-1-icon14" alt="" src="../public/logo-1@2x.png" />
    <a class="anikahrm14" href="./index.html" id="anikaHRM">
      <span>Anika</span>
      <span class="hrm14">HRM</span>
    </a>
    <a class="attendence-management4" href="./index.html" id="attendenceManagement">Payroll Management</a>
    <button class="attendence-inner"></button>
    <div class="logout14">Logout</div>
    <a class="payroll14" href="payroll.html" style="color: white; z-index:9999;">Payroll</a>
    <div class="reports14">Reports</div>
    <img class="uitcalender-icon14" alt="" src="./public/uitcalender.svg" />

    <img style="-webkit-filter: grayscale(1) invert(1);
      filter: grayscale(1) invert(1); z-index:9999;" class="arcticonsgoogle-pay14" alt="" src="./public/arcticonsgooglepay.svg" />

    <img class="streamlineinterface-content-c-icon14" alt="" src="./public/streamlineinterfacecontentchartproductdataanalysisanalyticsgraphlinebusinessboardchart.svg" />

    <img class="attendence-child1" alt="" src="./public/ellipse-1@2x.png" />

    <img class="material-symbolsperson-icon14" alt="" src="./public/materialsymbolsperson.svg" />

    <img class="attendence-child2" alt="" style="margin-top: 66px;" src="./public/rectangle-4@2x.png" />

    <a class="dashboard14" href="./index.php" style="z-index: 99999;" id="dashboard">Dashboard</a>
    <a class="fluentpeople-32-regular14" style="z-index: 99999;" id="fluentpeople32Regular">
      <img class="vector-icon73" alt="" src="./public/vector7.svg" />
    </a>
    <a class="employee-list14" href="employee-management.php" style="z-index: 99999;" id="employeeList">Employee List</a>
    <a class="akar-iconsdashboard14" style="z-index: 99999;" href="./index.php" id="akarIconsdashboard">
      <img class="vector-icon74" alt="" src="./public/vector3.svg" />
    </a>
    <img class="tablerlogout-icon14" style="z-index: 99999;" alt="" src="./public/tablerlogout.svg" />

    <a class="leaves14" id="leaves" style="z-index: 99999;" href="leave-management.php">Leaves</a>
    <a class="fluentperson-clock-20-regular14" id="fluentpersonClock20Regular">
      <img class="vector-icon75" style="z-index: 99999;" alt="" src="./public/vector1.svg" />
    </a>
    <a class="onboarding16" style="z-index: 99999;" id="onboarding" href="onboarding.php">Onboarding</a>
    <a class="fluent-mdl2leave-user14" style="z-index: 99999;" id="fluentMdl2leaveUser">
      <img class="vector-icon76" alt="" src="./public/vector.svg" />
    </a>
    <a class="attendance14" href="attendence.php" style="color: black; z-index: 99999;">Attendance</a>
    <a class="uitcalender14">
      <img class="vector-icon77" style="-webkit-filter: grayscale(1) invert(1);
        filter: grayscale(1) invert(1); z-index: 99999;" alt="" src="./public/vector11.svg" />
    </a>
    <div class="oouinext-ltr3"></div>
  </div>
  <script>
function openCard() {
    var modal = document.getElementById('default-modal');
    modal.classList.remove('hidden');
}
</script>

<script>
function updateStatus(id) {
    // AJAX request
    console.log('Sending AJAX request...');
    $.ajax({
        url: 'update_ss.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            // Handle success response
            console.log('Status updated successfully');
            console.log('Response:', response); // Log the response
            if(response.error) {
                console.error('Error updating status:', response.error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error updating status: ' + response.error,
                });
            } else {
                // Update modal with next dataset
                updateAndReload(id);
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error updating status:', error);
            console.log('XHR:', xhr); // Log the XMLHttpRequest object
            console.log('Status:', status); // Log the status
            console.log('Error:', error); // Log the error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error updating status',
            });
        }
    });
}

function updateAndReload(id) {
    console.log('Reloading page with next dataset...');
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var responseData = JSON.parse(xhr.responseText);
            console.log('Response:', responseData); // Log the response data
            if (responseData.next_id === 'no_data') {
                console.log('No more data available');
                alert('No more data available');
            } else {
                console.log('Next dataset ID:', responseData.next_id);
                // Update the modal with the next dataset
                updateModal(responseData.next_id);
            }
        }
    };
    xhr.send("confirm=true&id=" + id);
}

function updateModal(nextId) {
    console.log('Updating modal with next dataset...');
    // AJAX request to fetch data for the next dataset
    $.ajax({
        url: 'fetch_data.php',
        type: 'POST',
        data: { id: nextId },
        success: function(response) {
            // Update the modal content with the fetched data
            $('#modal-content').html(response);
            // Open the modal
            openCard();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data for modal:', error);
            alert('Error fetching data for modal');
        }
    });
}
</script>


  <script>
    function submitFormData() {
      var formData = new FormData();
      // Iterate through each table row
      $("#payrollTable tbody tr").each(function() {
        // Get the input elements within the current row
        var inputs = $(this).find('input[name^="confirm"]:checked');
        // Check if at least one checkbox is checked in the row
        if (inputs.length > 0) {
          // Get the data attributes from the row
          var empName = $(this).find('td:eq(1)').text().trim();
          var grossSalary = $(this).find('td:eq(2)').text().trim();
          var loanDeductables = $(this).find('td:eq(3)').text().trim();
          var lop = $(this).find('td:eq(4)').text().trim();
          var epf = $(this).find('td:eq(5)').text().trim();
          var esi = $(this).find('td:eq(6)').text().trim();
          var netSalary = $(this).find('td:eq(7)').text().trim();
          // Append the data to the formData object
          formData.append('confirm[]', empName);
          formData.append('gross_salary[' + empName + ']', grossSalary);
          formData.append('loan_deductables[' + empName + ']', loanDeductables);
          formData.append('lop[' + empName + ']', lop);
          formData.append('epf[' + empName + ']', epf);
          formData.append('esi[' + empName + ']', esi);
          formData.append('net_salary[' + empName + ']', netSalary);
        }
      });

      // Check if at least one checkbox is checked
      if ($('input[name="confirm[]"]:checked').length > 0) {
        Swal.fire({
          title: 'Are you sure?',
          text: 'Do you want to confirm payroll statements?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Yes, confirm',
          cancelButtonText: 'No, cancel',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: 'insert_statement.php',
              data: formData,
              processData: false,
              contentType: false,
              success: function(response) {
                console.log('Success:', response);
                Swal.fire({
                  icon: 'success',
                  title: 'Success!',
                  text: response,
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = 'salarystatement.php';
                    $('#payrollForm')[0].reset();
                  }
                });
              },
              error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
                Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: 'An error occurred while processing your request.',
                  confirmButtonText: 'OK'
                });
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'The submission of payroll statements was cancelled',
              icon: 'info',
              confirmButtonText: 'OK'
            });
          }
        });
      } else {
        Swal.fire({
          title: 'Error!',
          text: 'Please select at least one employee to confirm payroll statements.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }
  </script>

</body>

</html>