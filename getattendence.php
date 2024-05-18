<?php
session_start(); // Start the session

@include 'inc/config.php';

// Previous maximum ID stored in session variable
$prevMaxId = isset($_SESSION['prevMaxId']) ? $_SESSION['prevMaxId'] : 0;

// Perform a query to check for updates based on ID increment
$query = "SELECT MAX(ID) as currentMaxId FROM CamsBiometricAttendance";
$result = mysqli_query($con, $query);

// Initialize response
$response = array('hasUpdates' => false, 'error' => null);

// Check for errors in the query
if (!$result) {
    $response['error'] = mysqli_error($con);
} else {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);

    // Check if there are updates based on the increment in ID
    $response['hasUpdates'] = ($row['currentMaxId'] > $prevMaxId);

    // Update the previous maximum ID
    $_SESSION['prevMaxId'] = $row['currentMaxId'];
}

// Clean the output buffer
ob_clean();

// Set the content type header to indicate that the response is JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);

// Explicitly exit the script
exit;
?>
