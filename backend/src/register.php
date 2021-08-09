<?php
require "common/cors_autoload.php";

use App\Models\UsersModel;

$userModel = new UsersModel();

$username = $_POST["username"];
$password = $_POST["password"];

$tmpFileName = $_FILES["avatar"]["tmp_name"];
$file = fopen($tmpFileName, "r");
$fileData = fread($file, filesize($tmpFileName));

if ($username && $password && $fileData) {
    $userModel->addUser($username, $password, $fileData);
} else {
    header("HTTP/1.1 400 Bad Request");
}
