<?php

class UsersModel {
    public function __construct()
    {
        $this->sql = new SQLite3("site.db");
        $this->sql->exec(
            "CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                username TEXT
            )"
        );
    }
}