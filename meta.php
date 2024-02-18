<?php

include 'helpers.php';
setHeaders();

// Parse configuration from query parameters
$baseurl = $_GET['baseurl'] ?? 'default-base-url.com';
$port = $_GET['port'] ?? '80';
$username = $_GET['username'] ?? 'default-username';
$password = $_GET['password'] ?? 'default-password';

// Assuming you have a function to determine if the request should be handled dynamically
if (shouldFetchDynamically($_GET['type'], $_GET['id'])) {
    // Construct the API URL with the user's configuration for fetching meta data
    // This URL structure is hypothetical; adjust it according to the actual API documentation
    $apiUrl = "http://$baseurl:$port/player_api.php?username=$username&password=$password&action=get_meta&type={$_GET['type']}&id={$_GET['id']}";

    // Use your HTTP request helper to fetch data from the API
    $response = makeHttpRequest($apiUrl);
    $metaData = json_decode($response, true);

    // Transform meta data into Stremio format and output as JSON
    $output = transformToStremioMeta($metaData);
    echo json_encode($output);
} else {
    // Handle static file serving
    $jsonPath = dirname(__FILE__) . '/meta/' . $_GET['type'] . '/' . $_GET['id'] . '.json';

    if (realpath($jsonPath)) {
        // file exists
        setHeaders(); // Enable CORS and set JSON Content-Type
        echo file_get_contents($jsonPath); // Respond with json file from file system
    } else {
        page404(); // Respond with 404 page if file doesn't exist
    }
}

function shouldFetchDynamically($type, $id) {
    // Implement logic to determine if the request should be handled dynamically
    // For example, check if the type or id matches certain patterns or values
    return true; // Placeholder logic
}

function transformToStremioMeta($metaData) {
    // Transform the data fetched from Xtream Codes API into the format expected by Stremio
    // This function would need to map the structure from Xtream Codes to Stremio's meta object structure
    return $metaData; // Placeholder transformation logic
}
?>
