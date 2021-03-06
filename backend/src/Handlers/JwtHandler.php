<?php

namespace App\Handlers;

use Firebase\JWT\JWT;

use \App\Models\UsersModel;

class JwtHandler
{
    private $secret_key = "example_key";
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
        $dotenv->load();
        $this->secret_key = $_ENV["JWT_SECRET"];
    }

    public function generateJwt(string $username)
    {
        $userId = $this->userModel->getUserId($username);
        $time = time();
        $payload = array(
            "user_id" => $userId,
            "iat" => $time,
        );
        $jwt = JWT::encode($payload, $this->secret_key);
        return $jwt;
    }

    public function validateJwt($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, $this->secret_key, array('HS256'));
            // The jwt is bad.
        } catch (\Exception $e) {
            echo $e;
            return false;
        }
        // Check if user exists
        $username = $this->userModel->getUsername($decoded->user_id);
        if (!$username)
            return false;

        return array("id" => $decoded->user_id, "username" => $username);
    }
}
