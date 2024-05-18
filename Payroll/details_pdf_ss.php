<?php
$con = mysqli_connect("localhost", "Anika12", "Anika12", "ems");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Statement PDF[1]</title>
    <style>
        .report-no {
            position: absolute;
            right: 10;
            top: -15;
            height: 10px;
        }

        .wrapper {
            display: flex;
            justify-content: space-around !important;
        }

        .missing-wrapper {
            margin-top: -60px;
        }

        table {
            font-size: 15px !important;
        }
        td{
            text-align: center;
        }
        td,th{
            border: 1px solid goldenrod; 
        }
    </style>
</head>
<?php
$currentDateTime = date("Y-m-d H:i:s", strtotime("+5 hours 30 mins"));
echo "<p style='font-family: monospace ;font-size:15px;'>Employees Salary Statement generated on: $currentDateTime</p>";
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
    <h3 style="text-align: center;"><u>Employee's Salary Statement</u></h3>
    <div style=" position: relative;">

    </div>
    <form method="post" action="">
        <table border="1" style="border-color: rgb(170, 170, 170);width:100%" cellspacing="0">
            <thead style="text-align: center;" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th></th>
                    <th colspan="7" style="background:lightyellow;">**Net Payable = (Earnings - Salary Deductibles - Loan Deductions) </th>
                    <th colspan="4" style="background:linen;">***CTC = (Earnings + Employer Contributions - Salary Deductibles - Loan Deductions)</th>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="3" style="background:lightyellow;">Earnings</th>
                    <th colspan="2" style="background:lightyellow;">Salary Deductibles</th>
                    <th style="background:lightyellow;">Loan Deductions</th>
                    <th style="background:lightyellow;">Net Payable</th>
                    <th colspan="3" style="background:linen;">Employer Contribution</th>
                    <th style="background:linen;"></th>
                </tr>
                <tr style="background:lemonchiffon;">
                    <th scope="col" class="px-6 py-3">
                        Employee Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        HRA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        OA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Basic Pay
                    </th>
                    <th scope="col" class="px-6 py-3">
                        EPF
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ESI
                    </th>
                    <th scope="col" class="px-6 py-3">
                        EMI
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Net Salary
                    </th>
                    <th scope="col" class="px-6 py-3">
                        EPF
                    </th>
                    <th scope="col" class="px-6 py-3">
                        EPF Pension
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ESI
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CTC
                    </th>
                </tr>
            </thead>
            <?php
          $sql = "SELECT * FROM payroll_ss  ORDER BY ID ASC";
          $que = mysqli_query($con, $sql);

          if (mysqli_num_rows($que) > 0) {
            while ($result = mysqli_fetch_assoc($que)) {
          ?>
                    <tbody style="text-align: center;">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4"><?php echo $result['empname']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['hra']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['oa']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['bp']; ?></td>

                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['epf1']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['esi1']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['emi']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['payout']; ?></td>
                            <td style="background: rgba(250, 240, 230, 0.4);" class="px-6 py-4"><?php echo $result['epf2']; ?></td>
                            <td style="background: rgba(250, 240, 230, 0.4);" class="px-6 py-4"><?php echo $result['pension']; ?></td>
                            <td style="background: rgba(250, 240, 230, 0.4);" class="px-6 py-4"><?php echo $result['esi2']; ?></td>
                            <td style="background: rgba(250, 240, 230, 0.4);" class="px-6 py-4"><?php echo $result['gross']; ?></td>
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

        </table>
    </form>
</body>

</html>