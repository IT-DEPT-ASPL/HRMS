<?php
$con = mysqli_connect("localhost", "root", "", "ems");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details Pdf</title>
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
  </style>
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
  <h3 style="text-align: center;"><u>Leave Balance Sheet</u></h3>
  <div style=" position: relative;">

  </div>
  <form method="post" action="">
    <?php
    $sqlStatusCheck = "SELECT empname, emp_no FROM emp WHERE empemail = ?";
    $stmtStatusCheck = mysqli_prepare($con, $sqlStatusCheck);

    if ($stmtStatusCheck) {
      mysqli_stmt_bind_param($stmtStatusCheck, "s", $user_name);

      mysqli_stmt_execute($stmtStatusCheck);

      $resultStatusCheck = mysqli_stmt_get_result($stmtStatusCheck);

      $row = mysqli_fetch_assoc($resultStatusCheck);

      mysqli_stmt_close($stmtStatusCheck);
    } else {
      echo "Error in preparing SQL statement for status check.";
    }
    ?>
    <table border="1" style="border-color: rgb(170, 170, 170);width:100%" cellspacing="0">
      <tr class='header-row'>
        <th colspan="10" style="font-size:12px;background:#FFF7F1;">*Total Leave Balance Allocated (for the fiscal year April 2023 - March 2024)</th>
      </tr>
      <tr class='header-row' style="background:#FFF7F1;">
        <th class='static-cell'>Employee Name</th>
        <th class='static-cell' style="border-right:2px solid black;">Total Leave Bal. Allocated*</th>
        <th class='static-cell'>Intial CL</th>
        <th class='static-cell' style="border-right:2px solid black;">Current CL</th>
        <th class='static-cell'>Intial SL</th>
        <th class='static-cell' style="border-right:2px solid black;">Current SL</th>
        <th class='static-cell'>Intial Comp. Off</th>
        <th class='static-cell' style="border-right:1px solid black;">Current Comp. Off</th>
        <th class='static-cell' style="border-right:1px solid black;">Current Total Leave Balance</th>
        <th class='static-cell'>Updated as of</th>
      </tr>
      <?php
      $sql = "SELECT lb.*, emp.pic FROM leavebalance lb
          JOIN emp ON lb.empname = emp.empname ORDER BY lastupdate DESC";

      $que = mysqli_query($con, $sql);
      $cnt = 1;
      while ($result = mysqli_fetch_assoc($que)) {
      ?>
        <tr>
          <td><?php echo $result['empname']; ?></td>
          <td style="text-align:center;border-right:2px solid black;background:#91C8E4;"><?php echo $result['icl'] + $result['isl'] + $result['ico']; ?></td>
          <td style="text-align:center;background:#AEDEFC;"><?php echo $result['icl']; ?></td>
          <td style="text-align:center;border-right:2px solid black;background:#B4D4FF;"><span <?php echo ($result['cl'] >= 0) ? 'style="font-weight:normal;"' : 'style="font-weight:bold;color:red;"'; ?>><?php echo $result['cl']; ?></span></td>
          <td style="text-align:center;background:#AEDEFC;"><?php echo $result['isl']; ?></td>
          <td style="text-align:center;border-right:2px solid black;background:#B4D4FF;"><span <?php echo ($result['sl'] >= 0) ? 'style="font-weight:normal;"' : 'style="font-weight:bold;color:red;"'; ?>><?php echo $result['sl']; ?></span></td>
          <td style="text-align:center;background:#AEDEFC;"><?php echo $result['ico']; ?></td>
          <td style="text-align:center;background:#B4D4FF;"><?php echo $result['co']; ?></td>
          <td style="text-align:center;background:#91C8E4;"><span <?php echo (($result['cl'] + $result['sl'] + $result['co']) >= 0) ? 'style="font-weight:normal;"' : 'style="font-weight:bold;color:red;"'; ?>><?php echo $result['cl'] + $result['sl'] + $result['co']; ?></span></td>
          <td style="text-align:center;background:#EEF5FF;"><?php echo date('Y-m-d H:i:s', strtotime($result['lastupdate'] . ' +5 hours +30 minutes')); ?></td>

        </tr>
      <?php $cnt++;
      } ?>
    </table>
  </form>
</body>

</html>