<?php
require "common/cors_autoload.php";
require "common/check_authentication.php";

use App\Models\UsersModel;
use App\Models\ChatEntriesModel;

$usersModel         = new UsersModel();
$chatEntriesModel   = new ChatEntriesModel();

$chatEntriesModel->getEntriesAll();