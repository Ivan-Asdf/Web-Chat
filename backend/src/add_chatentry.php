<?php
require "common/cors_autoload.php";

use App\Models\ChatEntriesModel;
use App\External\PushEmitter;

$userData = require "common/check_authentication.php";
$content = $_POST["content"];

$chatEntriesModel   = new ChatEntriesModel();
$id = $chatEntriesModel->addEntry($userData["id"], $content);

$pushEmitter = new PushEmitter();

$data['id'] = $id;
$data['user_id'] = $userData["id"];
$data['content'] = $content;
$pushEmitter->emit($data);