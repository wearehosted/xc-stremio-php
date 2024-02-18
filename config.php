<?php

// Define your addon's manifest endpoint. Replace 'your-addon-host.com' with your actual host.
$addonHost = "https://app.killerapi.com";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addon Configuration</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        max-width: 400px;
        width: 100%;
        overflow: hidden; /* Ensures the container does not stretch */
    }
    h1 {
        color: #333;
        font-size: 24px;
    }
    p {
        color: #666;
        word-wrap: break-word; /* Breaks long words to prevent overflow */
        overflow-wrap: break-word; /* Alternative to word-wrap for better support */
        max-width: 100%; /* Ensures text does not overflow the container's width */
    }
    a, .copy-btn {
        display: inline-block;
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        margin-top: 20px;
        cursor: pointer;
    }
    a:hover, .copy-btn:hover {
        background-color: #0056b3;
    }
      .btn-custom-orange {
        background-color: #f79009; /* Example of a custom orange color */
        border-color: #f79009; /* Adjust the border color to match the background */
    }
    .btn-custom-orange:hover {
        background-color: #e57c00; /* Darker orange for hover state */
        border-color: #e57c00;
    }
</style>
  </head>
<body>
<div class="container">
    <?php
    // Check if the necessary query parameters are set
    if (isset($_GET['baseurl'], $_GET['port'], $_GET['username'], $_GET['password'])) {
        $baseurl = urlencode($_GET['baseurl']);
        $port = urlencode($_GET['port']);
        $username = urlencode($_GET['username']);
        $password = urlencode($_GET['password']);

        // Construct the URL with dynamic query parameters
        $addonUrl = "{$addonHost}/manifest.json?baseurl={$baseurl}&port={$port}&username={$username}&password={$password}";

        // Output the addon URL for the user
        echo "<h1>Your Stremio Addon URL</h1>";
        echo "<p>{$addonUrl}</p>";
		echo "<button class='btn btn-custom-orange' onclick='copyToClipboard(\"{$addonUrl}\")'>Copy URL</button>";
        echo "<br>Add to Stremio Manually if the button does not work.</a>";
        echo "<p>Copy and paste the URL below into Stremio to add your addon:</p>";
        echo "<a href='stremio://{$addonUrl}'>Add to Stremio</a><br><br>";
        // Button to copy URL to clipboard
    } else {
        echo "<h1>Configuration Error</h1>";
        echo "<p>Please provide baseurl, port, username, and password as query parameters.</p>";
    }
    ?>
</div>
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL copied to clipboard');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
</body>
</html>
