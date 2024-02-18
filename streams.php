<?php
include 'helpers.php';

setHeaders();

// Function to fetch streams from the Xtream Codes API
function fetchStreams($baseUrl, $port, $username, $password, $categoryId) {
    $url = "http://$baseUrl:$port/player_api.php?username=$username&password=$password&action=get_live_streams&category_id=$categoryId";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

// Extract parameters from query
$baseUrl = isset($_GET['baseurl']) ? $_GET['baseurl'] : 'vip.tvis.us';
$port = isset($_GET['port']) ? $_GET['port'] : '826';
$username = isset($_GET['username']) ? $_GET['username'] : 'cablekillers';
$password = isset($_GET['password']) ? $_GET['password'] : '8xyw23m';
$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';

// Fetch streams for the given category ID
$streams = fetchStreams($baseUrl, $port, $username, $password, $categoryId);

// Map the streams to the format expected by Stremio
$streamData = array_map(function($stream) use ($baseUrl, $port, $username, $password) {
    return [
        "title" => $stream['name'],
        // Construct stream URL based on the stream_id
        "url" => "http://$baseUrl:$port/live/$username/$password/{$stream['stream_id']}.ts",
        "isFree" => true // Assume all streams are free; adjust as necessary
    ];
}, $streams);

echo json_encode(["streams" => $streamData]);
