<?php

namespace App\Handlers;

use \App\Models\UsersModel;
use \App\Handlers\JwtHandler;

class LoginHandler
{
    private $usersModel;
    private $jwtHandler;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->jwtHandler = new JwtHandler();
    }

    public function login($username, $password) : void
    {
        if (!$username || !$password) {
            header("HTTP/1.1 400 Bad Request");
            return;
        }

        $hash = $this->usersModel->getHash($username);
        if (!password_verify($password, $hash)) {
            header("HTTP/1.1 403 Forbidden");
            return;
        } else {
            $jwt = $this->jwtHandler->generateJwt($username);
            setcookie("jwt", $jwt, $options = array("samesite" => "None"));
            return;
        }
    }
}
