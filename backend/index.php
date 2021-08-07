<?php
include "common/cors_autoload.php";

$usersModel         = new UsersModel();
$chatEntriesModel   = new ChatEntriesModel();

$chatEntriesModel->getEntriesAll();
// echo var_dump($_COOKIE["user_sesh"]);