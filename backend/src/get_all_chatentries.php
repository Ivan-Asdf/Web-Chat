<?php
require "common/cors_autoload.php";
require "common/check_authentication.php";

use App\Models\UsersModel;
use App\Models\ChatEntriesModel;

$usersModel         = new UsersModel();
$chatEntriesModel   = new ChatEntriesModel();

$results = $chatEntriesModel->getEntriesAll();
foreach ($results as &$entry) {
    $username = $usersModel->getUsername($entry["user_id"]);
    $entry["username"] = $username;
}

$json = json_encode($results, JSON_PRETTY_PRINT);
echo $json;
