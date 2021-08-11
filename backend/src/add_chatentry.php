<?php
require "common/cors_autoload.php";

use App\Models\ChatEntriesModel;
use App\External\PushEmitter;
use App\Models\UsersModel;

$userData = require "common/check_authentication.php";
$content = $_POST["content"];

$chatEntriesModel   = new ChatEntriesModel();
$id = $chatEntriesModel->addEntry($userData["id"], $content);

$pushEmitter = new PushEmitter();

$data['id'] = $id;
$data['user_id'] = $userData["id"];
$data['content'] = $content;
$usersModel = new UsersModel();
$data['username'] = $usersModel->getUsername($data['user_id']);
$pushEmitter->emit($data);
