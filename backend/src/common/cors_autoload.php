<?php
require __DIR__ . "/../../vendor/autoload.php";

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();
$frontendUrl = $_ENV["FRONTEND_URL"];

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Origin: $frontendUrl");
header("Access-Control-Allow-Headers: content-type, authorization");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS")
    die;
