<?php
$con = mysqli_connect("localhost", "root", "", "ems");

if(isset($_GET['empname'])) {
    $empname = $_GET['empname'];
    $currentMonth = date('F Y');
    $nextMonth = date('F Y', strtotime('+1 month'));
    $query = "SELECT emp.empname, emp.desg,emp.empdoj, p.*, 
    COALESCE(e.emi, 0) AS emi,
    COALESCE(e.emimonth, '$nextMonth') AS emimonth,
    b.*
FROM payroll_msalarystruc AS p
LEFT JOIN emp ON emp.empname = p.empname
LEFT JOIN payroll_emi AS e ON p.empname = e.empname AND e.emimonth = '$nextMonth'
LEFT JOIN payroll_ban AS b ON p.empname = b.empname
WHERE p.empname = '$empname'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $empname = $row['empname'];
        $desg = $row['desg'];
        $doj = $row['empdoj'];
        $bp = $row['abp'] + $row['epf1'];
        $pay = $row['netpay'] - $row['emi'];
        $ge = $row['netpay'] + $row['epf1'];
        $deductions = $row['emi'] + $row['epf1'];
    } else {
        $empname = "Employee Not Found";
    }
} else {
    $empname = "Employee Not Specified";
}

$num = $pay;
$formatted_number = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $num);
$bp1 = $bp;
$hra = $row['hra'];
$oa = $row['oa'];
$epf1 = $row['epf1'];
$esi1 = $row['esi1'];
$emi = $row['emi'];
$ge1 = $ge;
$deductions1 = $deductions;

$formatted_number = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $num);
$bp_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $bp1);
$hra_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $hra);
$oa_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $oa);
$epf1_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $epf1);
$esi1_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $esi1);
$emi_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $emi);
$ge_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $ge1);
$deductions_formatted = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $deductions1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    .rupee {
        font-family: 'Noto Sans', sans-serif;
    }
    @page { 
        margin: 0in; 
        position: fixed;
      inset: -1in;
    }
</style>
</head>
<?php
function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
$amount = $pay;
$inWords = getIndianCurrency($amount);

?>
<body style="margin:0;">
    <div style="background-color: rgb(252, 242, 242); height:100svh;">
        <img src='https://ik.imagekit.io/xrwtssnxo/logo.jpg?updatedAt=1709032970434' style="position: absolute; left: 10%; top: 25%; opacity: 0.1;">
        <div>
            <img alt='logo' src='https://ik.imagekit.io/xrwtssnxo/logo.jpg?updatedAt=1709032970434' style="position: absolute; right: 30px; top: 30px; width: 90px;">
        <p style="position: absolute; font-size: 22px; font-weight: 600; left: 30px; top:20; color: rgb(61, 61, 61);">ANIKA STERILIS PRIVATE LIMITED</p>
        <p style="position: absolute; font-size: 14px; font-weight: 500; left: 30px; top: 70px; color: rgb(104, 104, 104);">AMTZ Campus, VM Steel Project S.O, Visakhapatnam, Andhra Pradesh, PIN-530031</p>
        <hr style="width: 91%; border: 1px solid #d8d8d8; position: absolute; top: 110px; left: 30px;">
        <p style="position: absolute; left: 30px; font-size: 18px; font-weight: 600; top: 120px; color: rgb(61, 61, 61);">Payslip for the month of <?php echo $currentMonth; ?></p>
        <p style="position: absolute; left: 30px; font-size: 20px; font-weight: 600; top: 163px; color: rgb(61, 61, 61);"><?php echo $empname; ?></p>
        <p style="position: absolute; left: 30px; font-size: 14px; top: 210px; color: #666666;"><?php echo $desg; ?> | DOJ : <?php echo $doj; ?></p>
        <p style="position: absolute; right: 30px; font-size: 18px; top: 125px; color: rgb(61, 61, 61);">Employee Net Pay</p>
        <p style="position: absolute; right: 30px; font-size: 35px;top: 120px; color: rgb(61, 61, 61);"><span class="rupee">₹</span> <b><?php echo $formatted_number; ?>.00</b></p>
        <p style="position: absolute; right: 30px; font-size: 14px; top: 207px; color: #666666;">Paid Days : 28 | Loss of Pay : 0</p>
        <hr style="width: 91%; border: 1.5px dashed #d8d8d8; position: absolute; top: 255px; left: 30px;">
        <p style="position: absolute; left: 30px; top: 280px; color: #666666;">PF A/C Number</p>
        <p style="position: absolute; left: 150px; top: 280px; color: #000000;"><?php echo $row['epfn']; ?></p>
        <p style="position: absolute; right: 220px; top: 280px; color: #666666;">UAN Number</p>
        <p style="position: absolute; right: 30px; top: 280px; color: #000000;"><?php echo $row['uan']; ?></p>
        <p style="position: absolute; left: 30px; top: 330px; color: #666666;">ESI Number</p>
        <p style="position: absolute; left: 150px; top: 330px; color: #000000;"><?php echo $row['esin']; ?></p>
        <p style="position: absolute; right: 220px; top: 330px; color: #666666;">Bank Account Number</p>
        <p style="position: absolute; right: 30px; top: 330px; color: #000000;"><?php echo $row['ban']; ?></p>
        <hr style="width: 91%; border: 1px solid #d8d8d8; position: absolute; top: 390px; left: 30px;">
        <p style="position: absolute; left: 50px; font-weight: 600; font-size: 15px; top: 410px; color: rgb(109, 33, 33);">EARNINGS</p>
        <p style="position: absolute; left: 230px; font-weight: 600; font-size: 15px; top: 410px; color: rgb(109, 33, 33);">AMOUNT</p>
        <p style="position: absolute; right: 220px; font-weight: 600; font-size: 15px; top: 410px; color: rgb(109, 33, 33);">DEDUCTIONS</p>
        <p style="position: absolute; right: 80px; font-weight: 600; font-size: 15px; top: 410px; color: rgb(109, 33, 33);">AMOUNT</p>
        <hr style="width: 44%; border: 1px solid #d8d8d8; position: absolute; top: 460px; left: 30px;">
        <hr style="width: 47%; border: 1px solid #d8d8d8; position: absolute; top: 460px; right: 30px;">
        <p style="position: absolute; left: 50px; font-size: 17px; top: 470px;">Basic Pay</p>
        <p style="position: absolute; left: 230px; font-size: 17px; top: 460px;"><span class="rupee">₹</span> <?php echo $bp_formatted; ?></p>
        <p style="position: absolute; left: 50px; font-size: 17px; top: 520px;">House Rent Allowance</p>
        <p style="position: absolute; left: 230px; font-size: 17px; top: 510px;"><span class="rupee">₹</span> <?php echo $hra_formatted; ?></p>
        <p style="position: absolute; left: 50px; font-size: 17px; top: 570px;">Other Allowance</p>
        <p style="position: absolute; left: 230px; font-size: 17px; top: 560px;"><span class="rupee">₹</span> <?php echo $oa_formatted; ?></p>
        <p style="position: absolute; left: 50px; font-size: 17px; top: 620px;">Bonus</p>
        <p style="position: absolute; left: 230px; font-size: 17px; top: 610px;"><span class="rupee">₹</span> 0</p>
        <p style="position: absolute; right: 220px; font-size: 17px; top: 470px;">Provident Fund</p>
        <p style="position: absolute; right: 80px; font-size: 17px; top: 460px;"><span class="rupee">₹</span> <?php echo $epf1_formatted; ?></p>
        <p style="position: absolute; right: 140px; font-size: 17px; top: 520px;">Employee's State Insurance</p>
        <p style="position: absolute; right: 80px; font-size: 17px; top: 510px;"><span class="rupee">₹</span> <?php echo $esi1_formatted; ?></p>
        <p style="position: absolute; right: 257px; font-size: 17px; top: 570px;">Loan EMI</p>
        <p style="position: absolute; right: 80px; font-size: 17px; top: 560px;"><span class="rupee">₹</span> <?php echo $emi_formatted; ?></p>
        <hr style="width: 44%; border: 1px solid #d8d8d8; position: absolute; top: 680px; left: 30px;">
        <hr style="width: 47%; border: 1px solid #d8d8d8; position: absolute; top: 680px; right: 30px;">
        <p style="position: absolute; left: 50px; font-size: 17px; top: 690px; font-weight: 600; color: #666666;">GROSS EARNINGS</p>
        <p style="position: absolute; left: 230px; font-size: 17px; top: 680px;color: #666666;"><span class="rupee">₹</span> <b><?php echo $ge_formatted; ?></b></p>
        <p style="position: absolute; right: 220px; font-size: 17px; top: 690px; font-weight: 600; color: #666666;">DEDUCTIONS</p>
        <p style="position: absolute; right: 80px; font-size: 17px; top: 680px;  color: #666666;"><span class="rupee">₹</span> <b><?php echo $deductions_formatted; ?></b></p>
        <p style="text-align: center; font-size: 20px; margin-top: 800px; color: #666666;">Total Net Payable <span class="rupee">₹</span> <b><?php echo $formatted_number; ?></b> <span style="font-size: 14px;text-transform: capitalize;">( <?php echo $inWords; ?> only)</span> </p>
        <p style="text-align: center; font-size: 17px; color: #666666;">**Total Net Payable = (Gross Earnings - Deductions)</p>
        <p style="text-align: center; font-size: 13px; margin-top: 90px; padding-bottom:65px; color: #666666;">--This is a system generated payslip, hence the signature is not required.--</p>
        </div>
    </div>



</body>
</html>