<?php
require "common/cors_autoload.php";

use App\Models\UsersModel;

$userModel = new UsersModel();

$username = $_POST["username"];
$password = $_POST["password"];

if ($username && $password) {
    echo $username . " " . $password;
    $userModel->addUser($username, $password);
} else {
    header("HTTP/1.1 400 Bad Request");
}
