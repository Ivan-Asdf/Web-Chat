<?php
include "common/cors_autoload.php";
require "common/check_authentication.php";

use App\UsersModel;
use Firebase\JWT\JWT;


setcookie('jwt', '', time() - 3600);
