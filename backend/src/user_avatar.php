<?php
require "common/cors_autoload.php";
// require "common/check_authentication.php";

use App\Models\UsersModel;

$userId = $_GET["user_id"];

$usersModel = new UsersModel();
echo $usersModel->getUserAvatar($userId);
