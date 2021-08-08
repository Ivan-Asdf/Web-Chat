<?php
include "common/cors_autoload.php";

use App\ChatEntriesModel;
use App\JwtHandler;
use App\UsersModel;

$jwt = $_COOKIE["jwt"];
$jwtHandler = new JwtHandler;
$username = $jwtHandler->validateJwt($jwt);
if(!$username) {
    header("HTTP/1.1 401 Unauthorized");
    return;
}
$usersModel = new UsersModel;
$user_id = $usersModel->getUserId($username);

$content = $_POST["content"];
$chatEntriesModel   = new ChatEntriesModel();
$id = $chatEntriesModel->addEntry($user_id, $content);

$options = array(
    'cluster' => 'eu',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    '44a73a86f03133cb77c9',
    '8866d6234c33195f0e87',
    '1247061',
    $options
);

$data['id'] = $id;
$data['user_id'] = $user_id;
$data['content'] = $content;
$pusher->trigger('my-channel', 'my-event', $data);
