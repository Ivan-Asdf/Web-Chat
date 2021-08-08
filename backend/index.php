<?php
include "common/cors_autoload.php";

use App\UsersModel;
use App\ChatEntriesModel;

$usersModel         = new UsersModel();
$chatEntriesModel   = new ChatEntriesModel();

$chatEntriesModel->getEntriesAll();
// echo var_dump($_COOKIE["user_sesh"]);