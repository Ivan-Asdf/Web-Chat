<?php
// Included in every path.php which requires authentication
// Return user_id and username

$jwtHandler = new App\Handlers\JwtHandler;

$jwt = getallheaders()["Authorization"];

if ($jwt) {
    if($userData = $jwtHandler->validateJwt($jwt)) {
        return $userData;
    } else {
        header("HTTP/1.1 401 Unauthorized");
        die;
    }
} else {
    header("HTTP/1.1 401 Unauthorized");
    die;
}