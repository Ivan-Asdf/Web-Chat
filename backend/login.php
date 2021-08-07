<?php
include "./common/cors_autoload.php";

// if ($_COOKIE["user_sesh"])
//     echo "LOGGED IN ALREADY";
// else
//     header("HTTP/1.1 401 Unauthorized");


// echo var_dump($_COOKIE);
// setcookie("user_sesh1", "HAZ");

$username = $_POST["username"];
$password = $_POST["password"];

if ($username && $password) {
    $userModel = new UsersModel;
    $userModel->authUser($username, $password);
}