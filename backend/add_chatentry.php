<?php
include "common/cors_autoload.php";

use App\ChatEntriesModel;

$chatEntriesModel   = new ChatEntriesModel();

echo $_POST["user_id"] . " " . $_POST["content"];

$chatEntriesModel->addEntry($_POST["user_id"], $_POST["content"]);