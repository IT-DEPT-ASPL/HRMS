<?php
$con = mysqli_connect("localhost", "Anika12", "Anika12", "ems");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lop Statement PDF</title>
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
echo "<p style='font-family: monospace ;font-size:15px;'>Employees lop Statement generated on: $currentDateTime</p>";
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
    <h3 style="text-align: center;"><u>Employee(s) lop Statement</u></h3>
    <div style=" position: relative;">

    </div>
    <form method="post" action="">
        <table border="1" style="border-color: rgb(170, 170, 170);width:100%" cellspacing="0">
            <thead>
                </tr>
                <tr style="background:lemonchiffon;">
                    <th>Employee Name</th>
                    <th>Lop Month</th>
                    <th>Worked Days</th>
                    <th>Leave Bal.</th>
                    <th>Lop</th>
                    <th>Lop Adj.</th>
                    <th>Final Lop</th>
                    <th>Comments</th>
                    <th>Lop created</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT * from payroll_lop";
            $que = mysqli_query($con, $sql);

            if (mysqli_num_rows($que) > 0) {
                while ($result = mysqli_fetch_assoc($que)) {
                    // $balance = $result['loamt'] - $result['total_emi'];
                    // $disbursed = $result['disbursed'];
                    // $disbursedText = ($disbursed == "1") ? "lop Disbursed" : "Pending lop Disbursal";
            ?>
                    <tbody>
                        <tr>
                            <td><?php echo $result['empname']; ?></td>
                            <td style="background:LightGoldenrodYellow;">
                                <?php echo $result['lopmonth']; ?>
                            </td>

                            <td style="background:Bisque;">
                                <?php echo $result['worked']; ?>
                            </td>
                            <td style="background:wheat;">
                            <?php echo $result['leavebal']; ?>
                            <td style="background:cornsilk;">  
                                <?php echo $result['lop']; ?>
                            </td>
                            <td style="background:LightGoldenrodYellow;">
                                <?php echo $result['lopadj']; ?>
                            </td>
                            <td style="background:seashell;">
                                <?php echo $result['flop']; ?>
                            </td>
                            <td style="background:Bisque;">
                                <?php echo $result['comment']; ?>
                            </td>
                            <td style="background:antiquewhite;">  
                                <?php echo $result['created']; ?>
                            </td>
                        </tr>
                    </tbody>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center">No lop history</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</body>

</html>