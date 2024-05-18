<?php
$servername = "localhost";
$username = "Anika12";
$password = "Anika12";
$dbname = "ems";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipientEmail = $_POST['recipientEmail'];
    $purpose = $_POST['purpose'];

    function generateRandomString($length = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

   
    $uniqueLink = generateRandomString();
    $message = "Click the following link to <u>Create Emp login acc</u>: <a href='https://hrms.anikasterilis.com/createpage.php?email={$recipientEmail}&token={$uniqueLink}'>Click here</a>";
   
    $subject = 'Successful Onboarding - Next Steps: Employee Login Creation';
    $from_email = 'hrms@anikasterilis.in';
    $from_name = 'ASPL HRMS';
    $headers = "From: $from_name <$from_email>\r\n" .
               "Reply-To: $from_email\r\n" .
               "Content-type: text/html\r\n" . 
               'X-Mailer: PHP/' . phpversion();

    $sql = "INSERT INTO mail_log (email, purpose) VALUES ('$recipientEmail', '$purpose')";
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully. Email has been sent successfully";
        mail($recipientEmail, $subject, $message, $headers);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
