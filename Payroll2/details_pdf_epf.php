<?php
$con = mysqli_connect("localhost", "root", "", "ems");

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
echo "<p style='font-family: monospace ;font-size:15px;'>EPF Statement generated on: $currentDateTime</p>";
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
    <h3 style="text-align: center;"><u>EPF Statement</u></h3>
    <div style=" position: relative;">

    </div>
    <form method="post" action="">
        <table border="1" style="border-color: rgb(170, 170, 170);width:100%" cellspacing="0">
            <thead style="text-align: center;" class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr style="background:lemonchiffon;">
                <th scope="col" class="px-6 py-3">
                Employee Name
              </th>
              <th scope="col" class="px-6 py-3">
                EPF A/C Number
              </th>
              <th scope="col" class="px-6 py-3">
                UAN
              </th>
              <th scope="col" class="px-6 py-3">
                Salary Month
              </th>
              <th scope="col" class="px-6 py-3">
                Basic Salary
              </th>
              <th scope="col" class="px-9 py-3">
                Employee Share <br>
                ( 12% )
              </th>
              <th scope="col" class="px-9 py-3">
                Employer Share
                <br>
                ( 3.67% )
              </th>
              <th scope="col" class="px-9 py-3">
                Pension Share
                <br>
                ( 8.33% )
              </th>
                </tr>
            </thead>
            <?php
            $currentMonth = date('F Y');
            $nextMonth = date('F Y', strtotime('+1 month'));
            $sql = "SELECT payroll_ss.*, emp.*, emp.pic
            FROM payroll_ss
            JOIN emp ON payroll_ss.empname = emp.empname
            WHERE emp.uan IS NOT NULL AND emp.uan <> ''";
    

            $que = mysqli_query($con, $sql);

            if (mysqli_num_rows($que) > 0) {
                while ($result = mysqli_fetch_assoc($que)) {
            ?>
                    <tbody style="text-align: center;">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4"><?php echo $result['empname']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"> <?php echo $result['epfn']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['uan']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['salarymonth']; ?></td>

                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['bp']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['epf1']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['epf2']; ?></td>
                            <td class="px-6 py-4" style="background: rgba(250, 250, 210, 0.5);"><?php echo $result['pension']; ?></td>
                       
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
 <tfoot class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <?php
            $sql = "SELECT 
            SUM(epf1) AS sum_epf1,
            SUM(epf2) AS sum_epf2,
            SUM(pension) AS sum_pension
            FROM 
            payroll_ss";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            $sum_epf1 = $row['sum_epf1'];
            $sum_epf2 = $row['sum_epf2'];
            $sum_pension = $row['sum_pension'];
            ?>
            <tr>
                <th></th>
              <th style="text-align:right;border-right:1px solid transparent;" colspan="4">Total</th>
              <th scope="col" class="px-6 py-3" style="text-align: center; font-size: 18px;"><?php echo $sum_epf1; ?></th>
              <th scope="col" class="px-6 py-3" style="text-align: center; font-size: 18px;"><?php echo $sum_epf2; ?></th>
              <th scope="col" class="px-6 py-3" style="text-align: center; font-size: 18px;"><?php echo $sum_pension; ?></th>
            </tr>
          </tfoot>
        </table>
    </form>
</body>

</html>