<?php
include('inc/config.php');

// Retrieve selected values from the AJAX request
$selectedMonth = $_POST['selectedMonth'];
$selectedDay = $_POST['selectedDay'];

// Construct the SQL query based on the selected filters
$query = "SELECT pic, empname, empdob FROM emp WHERE 1";

if ($selectedMonth != 'all') {
    $query .= " AND MONTH(empdob) = '$selectedMonth'";
}

if ($selectedDay != 'all') {
    $query .= " AND DAY(empdob) = '$selectedDay'";
}

$query .= " ORDER BY MONTH(empdob), DAY(empdob)";

$result = mysqli_query($con, $query);

if ($result) {
    $output = '';

    while ($row = mysqli_fetch_assoc($result)) {
        $limitedEmpName = substr($row['empname'], 0, 13);
        $formattedEmpDob = date('M, d', strtotime($row['empdob']));

        $output .= '<table>
                        <tr>
                            <td></td>
                            <td> <img class="hovpic1" src="pics/' . $row['pic'] . '" width="30px" style="border-radius: 50px;" alt=""> </td>
                            <td style="font-size: 14px;">' . $limitedEmpName . '</td>
                            <td style="font-size: 14px; margin-top:12px; float:right;">' . $formattedEmpDob . '</td>
                        </tr>
                    </table>';
    }

    echo $output;
    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
