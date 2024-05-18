<?php
session_start();

if (!isset($_SESSION['user_name']) && !isset($_SESSION['name'])) {
    header('location:loginpage.php');
}


    $con = mysqli_connect("localhost", "Anika12", "Anika12", "ems");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM payroll_loan WHERE empname = ?";


    $query = $con->prepare($sql);
    $empname = $_GET['empname'];
    $query->bind_param('s', $empname);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $disbursed = $row['disbursed'];
            $disbursedText = ($disbursed == "1") ? "Loan Disbursed" : "Pending Loan Disbursal";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details Pdf</title>
</head>
<?php
$currentDateTime = date("Y-m-d H:i:s", strtotime("+5 hours 30 mins"));
echo "<p style='font-family: monospace ;font-size:15px;'>Leave_balance sheet generated on: $currentDateTime</p>";
?>

<div style='display:block;margin-left:auto;margin-right:auto;width:110px;'>
  <img alt='logo' src='https://ik.imagekit.io/akkldfjrf/Anika_logo%20(1).jpg?updatedAt=1691746754121' width=100px height=80px>
</div><br>
<header style="text-align:center;color:black !important; ">
  <a class="header" href="" style="Font-size:30px;text-decoration:none !important;">Anika Sterilis Private Limited</a>

  <p style="text-align:center;">Anika ONE, AMTZ Campus,Pragati Maidan,VM Steel Project S.O,Visakhapatnam,Andhra Pradesh-530031</p>
  <p style="text-align:center;">Phone: 0891-5193101 | Email: info@anikasterilis.com</p>
</header>
<hr>

<body>
  <h3 style="text-align: center;"><u>Loan Summary</u></h3>
  <div style=" position: relative;">

  </div>
  <form method="post" action="">

<div class="p-4 md:p-1 space-y-2">
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Name</span> <span style="margin-left: 120px;"><?php echo $row['empname']; ?></span></p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Loan Number</span> <span style="margin-left: 60px;"><?php echo $row['loanno']; ?></span></p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Loan Amount</span> <span style="margin-left: 60px;">₹ <?php echo $row['loamt']; ?>/-</span></p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Tenure</span> <span style="margin-left: 115px;"><?php echo $row['loterm']; ?></span></p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Mode of Transfer</span>
                    <select id="mot" class="inputselect" name="mop" style="margin-left: 20px;">
                        <option value="" disabled selected><?php echo $row['mop']; ?></option>
                        <option value="UPI">UPI</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Card Payment">Card Payment</option>
                    </select>
                </p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Transfer Date</span> <input type="date" class="inputselect" id="pad" value="<?php echo $row['pdate']; ?>" style="margin-left: 45px;"></p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Transaction No</span> <input type="text" name="tno" id="tno" class="inputselect" value="<?php echo $row['tno']; ?>" style="margin-left: 35px;"></p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Tenure Start Date</span><span id="datepicker" style="margin-left: 33px;"><?php echo $row['stmonth']; ?></span></p>
                <hr>
                <p style="font-size: 18px;"><span style="color: rgb(145, 145, 145);">Disbursal Status</span><span style="margin-left: 45px;"><?php echo $disbursedText; ?></span>
                    <hr>
                    <?php if ($row['disbursed'] == "1") : ?>
                <h1 style="font-size: 25px; font-weight: 700;">Transaction History</h1>
                <div style="overflow-y: auto; height: 200px;">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead style="text-align: center;" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Transaction
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">

                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4"><?php echo $row['pdate']; ?></td>
                                <td class="px-6 py-4  whitespace-nowrap">Loan disbursed</td>
                                <td class="px-6 py-4"><?php echo $row['notes']; ?></td>
                            </tr>
                            <?php
                            $sql_emi = "SELECT * FROM payroll_emi WHERE empname = ?";
                            $query_emi = $con->prepare($sql_emi);
                            $query_emi->bind_param('s', $row['empname']); 
                            $query_emi->execute();
                            $result_emi = $query_emi->get_result();

                            if ($result_emi->num_rows > 0) {
                                while ($row_emi = $result_emi->fetch_assoc()) {
                            ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4"><?php echo $row_emi['created']; ?></td>
                                        <td class="px-6 py-4">EMI deducted</td>
                                        <td class="px-6 py-4  whitespace-nowrap">EMI:₹<?php echo $row_emi['emi']; ?>/- Month:<?php echo $row_emi['emimonth']; ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            </div>
  </form>
</body>

</html>
<?php
        }
    } else {
        echo "No data found";
    }
?>