<?php
include('smtp/PHPMailerAutoload.php');
$currentTimestamp = date("Y-m-d");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function generateRandomString($length = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    $uniqueLink = generateRandomString();

    $ID = isset($_GET['id']) ? $_GET['id'] : null;

    $empstatus = $_POST['empstatus'];
    $reason = $_POST['reason'];

    if ($empstatus == 1) {
        $html = "Click the following link to <u>Terminate</u>: <a href='http://localhost/ems/email-form.php?email={$_POST['email']}&token={$uniqueLink}'>Click here</a>";
    } elseif ($empstatus == 2) {
        $html = "Click the following link to <u>Complete your resignation</u>: <a href='http://localhost/ems/email-form.php?email={$_POST['email']}&token={$uniqueLink}'>Click here</a>";
    } elseif ($empstatus == 0) {
        $html = "Click the following link to <u>Complete</u>: <a href='http://localhost/ems/email-form.php?email={$_POST['email']}&token={$uniqueLink}'>Click here</a>";
    }

    try {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth = true;
        $mail->Username = "hrms.ems.acc.creation@gmail.com";
        $mail->Password = "brbnnshtcvfnuupu";
        $mail->SetFrom("hrms.ems.acc.creation@gmail.com", "ASPL HRMS");
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Update on employment status';
        $mail->Body = $html;

        if ($mail->send()) {
            $empQuery = "UPDATE `emp` SET empstatus='$empstatus', reason='$reason', exit_dt = '$currentTimestamp' WHERE id='$ID' ";
            if ($conn->query($empQuery) === TRUE) {
                $userFormQuery = "UPDATE `user_form` SET empstatus='$empstatus' WHERE email='{$_POST['email']}'";
                if ($conn->query($userFormQuery) === TRUE) {
                    // Insert into mail_log after successful email and database updates
                    $emailLogQuery = "INSERT INTO mail_log (email, purpose) VALUES ('{$_POST['email']}', 'for an update on employment status')";
                    if ($conn->query($emailLogQuery) === TRUE) {
                        echo "Email sent and records updated successfully.";
                    } else {
                        echo "Error updating mail_log table: " . $conn->error;
                    }
                } else {
                    echo "Error updating user_form table: " . $conn->error;
                }
            } else {
                echo "Error updating emp table: " . $conn->error;
            }
        } else {
            echo "Error sending email.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}
?>
