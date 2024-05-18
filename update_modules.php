<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: loginpage.php");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to MySQL
    @include 'inc/config.php';

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Loop through submitted data to update user-module associations
    foreach ($_POST['user_module'] as $email => $selected_modules) {
        // Delete existing associations for the user
        $sql_delete = "DELETE FROM user_modules WHERE email = '$email'";
        mysqli_query($con, $sql_delete);

        // Insert new associations
        foreach ($selected_modules as $module_id) {
            $sql_insert = "INSERT INTO user_modules (email, module_id) VALUES ('$email', $module_id)";
            mysqli_query($con, $sql_insert);
        }
    }

    // Close MySQL connection
    mysqli_close($con);

    // Redirect back to dashboard with success message
    header("Location: dashboard.php?success=1");
    exit();
} else {
    // If form is not submitted, redirect back to dashboard
    header("Location: dashboard.php");
    exit();
}
?>
