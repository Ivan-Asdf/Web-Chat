<?php

class UsersModel {
    public function __construct()
    {
        $this->sql = new SQLite3("site.db");
        $this->sql->exec(
            "CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY,
                username TEXT,
                password TEXT
            )"
        );
    }

    public function addUser(string $username, string $password) {
        // Check if exists
        $query = $this->sql->query("SELECT username FROM users");
        $row = $query->fetchArray();
        if ($row["username"] = $username) {
            header("HTTP/1.1 409 Conflict");
            return;
        }

        // Hash and salt
        $passwordHash = password_hash($password , PASSWORD_DEFAULT);
        $this->sql->exec(
            "INSERT INTO users(username, password)
             VALUES(\"$username\", \"$passwordHash\")");
    }

    public function authUser(string $username, string $password) {
        $statement = $this->sql->prepare("SELECT * FROM users WHERE username=:username");
        $statement->bindValue(":username", $username);
        $query = $statement->execute();

        $row = $query->fetchArray();

        $isVerified = password_verify($password, $row["password"]);

        echo $row["id"] . $row["username"] . $row["password"];
        echo $isVerified;
    }
}