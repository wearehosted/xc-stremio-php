<?php
include 'helpers.php';

// Extract configuration from query parameters
$baseurl = isset($_GET['baseurl']) ? $_GET['baseurl'] : 'default';
$port = isset($_GET['port']) ? $_GET['port'] : '80';
$username = isset($_GET['username']) ? $_GET['username'] : 'user';
$password = isset($_GET['password']) ? $_GET['password'] : 'pass';

setHeaders();

// Dynamic manifest with configuration embedded or as query params
$manifest = [
    "id" => "com.kapiftgiptv",
    "version" => "1.0.0",
    "name" => "KillerAPI FTG IPTV Add-on",
    "description" => "Stream IPTV channels from Xtream Codes",
    "resources" => ["stream", "catalog"],
    "types" => ["tv"],
    "idPrefixes" => ["xtream"],
    "catalogs" => [
        [
            "id" => "liveCategories",
            "type" => "tv",
            "name" => "Live Stream Categories",
            "extra" => [
                ["name" => "baseurl", "value" => $baseurl],
                ["name" => "port", "value" => $port],
                ["name" => "username", "value" => $username],
                ["name" => "password", "value" => $password]
            ]
        ]
    ]
];

echo json_encode($manifest);
