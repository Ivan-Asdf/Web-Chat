<?php
include "common/cors_autoload.php";

use App\UsersModel;
use Firebase\JWT\JWT;

// unset($_COOKIE['jwt']);
setcookie('jwt', '', time() - 3600);
