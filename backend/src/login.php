<?php
include "common/cors_autoload.php";

use App\Handlers\LoginHandler;
use App\Models\UsersModel;

$loginHandler = new LoginHandler();
$loginHandler->login($_POST["username"], $_POST["password"]);