<?php
namespace App;

use Firebase\JWT\JWT;

class JwtHandler {
    private $secret_key = "example_key";

    public function generateJwt(string $username) {
        $time = time();
        $payload = array(
            "user" => $username,
            "iat" => $time,
        );
        $jwt = JWT::encode($payload, $this->secret_key);
        return $jwt;
    }

    public function validateJwt($jwt) {
        try {
            $decoded = JWT::decode($jwt, $this->secret_key, array('HS256'));
            // echo var_dump($decoded);
        // The jwt is bad.
        } catch (\Exception $e) {
            echo $e;
            return false;
        }
        return $decoded->user;
    }
}