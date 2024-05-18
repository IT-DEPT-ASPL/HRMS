<?php
// Assuming you have a database connection established already
@include 'inc/config.php';

// Query to check if there are any updates
$query = "SELECT COUNT(*) AS update_count FROM loggedin WHERE loggedtime > DATE_SUB(NOW(), INTERVAL 1 MINUTE)";
$result = mysqli_query($con, $query);

if ($result) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);

    // Check if there are updates
    $hasUpdates = ($row['update_count'] > 0);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode(['hasUpdates' => $hasUpdates]);
} else {
    // Handle the case where the query fails
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Failed to execute query']);
}
?>
