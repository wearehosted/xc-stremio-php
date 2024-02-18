<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'helpers.php'; // Make sure this file exists and is included correctly
setHeaders();

// Parse configuration from query parameters
$baseurl = $_GET['baseurl'] ?? 'default-base-url.com';
$port = $_GET['port'] ?? '80';
$username = $_GET['username'] ?? 'default-username';
$password = $_GET['password'] ?? 'default-password';

// Construct the API URL with the user's configuration
$apiUrl = "http://$baseurl:$port/player_api.php?username=$username&password=$password&action=get_live_categories";

// Use your HTTP request helper to fetch data from the API
$response = makeHttpRequest($apiUrl); // Ensure this returns a decoded array

// Since makeHttpRequest should return an array, we don't need to decode it again
$categories = $response; // Assuming $response is already an array

// Implement the transformation function if not already done
function transformToStremioCatalog($categories) {
    $output = [];
    foreach ($categories as $category) {
        // Transform each category into the format expected by Stremio
        // This is just an example; adjust according to your actual data structure
        $output[] = [
            'id' => 'xtream:category:'.$category['category_id'],
            'name' => $category['category_name'],
            'type' => 'tv'
        ];
    }
    return $output;
}

// Transform categories into Stremio catalog format and output as JSON
$output = transformToStremioCatalog($categories);
echo json_encode(["metas" => $output]);
