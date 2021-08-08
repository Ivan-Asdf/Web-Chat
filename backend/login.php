<?php
include "common/cors_autoload.php";

use App\UsersModel;
use App\JwtHandler;
use Firebase\JWT\JWT;
$key = "example_key";

$username = $_POST["username"];
$password = $_POST["password"];

$jwtHandler = new JwtHandler;

if ($username && $password) {
    $userModel = new UsersModel;
    if ($userModel->authUser($username, $password)) {
        $jwt = $jwtHandler->generateJwt($username);
        setcookie("jwt", $jwt, $options=array("samesite" => "None"));
        return;
    } else {
        header("HTTP/1.1 401 Unauthorized");
        return;
    }
}

$jwt = $_COOKIE["jwt"];

if ($jwt) {
    if($jwtHandler->validateJwt($jwt)) {
        return;
    } else {
        header("HTTP/1.1 401 Unauthorized");
        return;
    }
} else {
    header("HTTP/1.1 401 Unauthorized");
    return;
}