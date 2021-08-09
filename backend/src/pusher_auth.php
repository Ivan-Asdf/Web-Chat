<?php
require "common/cors_autoload.php";
require "common/check_authentication.php";

use App\External\PushAuthenticator;

$pushAuthenticator = new PushAuthenticator();
echo $pushAuthenticator->authenticate($_POST["channel_name"], $_POST["socket_id"]);
