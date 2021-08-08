<?php
// Included in every path.php which requires authentication
// Return user_id and username

$jwt = $_COOKIE["jwt"];

$jwtHandler = new App\Handlers\JwtHandler;

if ($jwt) {
    if($userData = $jwtHandler->validateJwt($jwt)) {
        return $userData;
    } else {
        header("HTTP/1.1 401 Unauthorized");
        error_log("SDSD");
        die;
    }
} else {
    header("HTTP/1.1 401 Unauthorized");
    error_log("SDSD2");
    die;
}