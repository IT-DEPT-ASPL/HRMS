<?php
// Check if latitude and longitude are submitted
if (!empty($_POST['latitude']) && !empty($_POST['longitude'])) {
    // Construct the URL to send a request and receive JSON data by latitude and longitude
    $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($_POST['latitude']) . ',' . trim($_POST['longitude']) . '&sensor=false';
    
    // Fetch JSON data from the URL
    $json = @file_get_contents($url);
    
    // Decode the JSON data
    $data = json_decode($json);
    
    // Get the status from the response
    $status = $data->status;
    
    // If the request status is successful
    if ($status == "OK") {
        // Get the address from the JSON data
        $location = $data->results[0]->formatted_address;
    } else {
        // If status is not OK, set location as empty
        $location = '';
    }
    
    // Return the address to the AJAX function
    echo $location;
} else {
    // If latitude and longitude are not provided, return an error message
    echo "Latitude and longitude are required parameters.";
}
?>
