<?php

namespace App\Models;

use finfo;

class UsersModel
{
    public function __construct()
    {
        $this->sql = new \SQLite3("site.db");
        $this->sql->exec(
            "CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY,
                username TEXT,
                password TEXT,
                avatar BLOB
            )"
        );
    }

    public function addUser(string $username, string $password, string $avatar): bool
    {
        // Check if exists
        $statement = $this->sql->prepare("SELECT * FROM users WHERE username=:username");
        $statement->bindValue(":username", $username);
        $query = $statement->execute();
        if ($query->fetchArray()) {
            header("HTTP/1.1 409 Conflict");
            return false;
        }

        // Hash and salt
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->sql->prepare(
            "INSERT INTO users(username, password, avatar)
            VALUES(:username, :passwordHash, :avatar)"
        );
        $statement->bindValue(":username", $username);
        $statement->bindValue(":passwordHash", $passwordHash);
        $statement->bindValue(":avatar", $avatar);

        if ($statement->execute())
            return true;
        else {
            header("HTTP/1.1 500 Internal Server Error");
            return false;
        }
    }

    public function getHash(string $username): string
    {
        $statement = $this->sql->prepare("SELECT * FROM users WHERE username=:username");
        $statement->bindValue(":username", $username);
        $query = $statement->execute();
        if (!$query)
            return false;

        $row = $query->fetchArray();
        if (!$row)
            return false;

        return $row["password"];
    }

    public function getUserId(string $username)
    {
        $statement = $this->sql->prepare("SELECT * FROM users WHERE username=:username");
        $statement->bindValue(":username", $username);
        $query = $statement->execute();

        $row = $query->fetchArray();

        return $row['id'];
    }

    public function getUsername(string $userId)
    {
        $statement = $this->sql->prepare("SELECT * FROM users WHERE id=:id");
        $statement->bindValue(":id", $userId);
        $query = $statement->execute();
        if (!$query)
            return false;

        $row = $query->fetchArray();
        if (!$row)
            return false;

        return $row['username'];
    }

    public function getUserAvatar(string $userId): string
    {
        $read = $this->sql->openBlob("users", "avatar", $userId);
        $rawData = stream_get_contents($read);

        $finfo = new finfo();
        $mimeType = $finfo->buffer($rawData, FILEINFO_MIME_TYPE);
        header("Content-Type: $mimeType");

        return $rawData;
    }
}
