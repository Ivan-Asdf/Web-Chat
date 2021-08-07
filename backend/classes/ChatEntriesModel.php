<?php
class ChatEntriesModel
{
    private $sql;
    public function __construct()
    {
        $this->sql = new SQLite3("site.db");
        $this->sql->exec(
            "CREATE TABLE IF NOT EXISTS chat_entries (
                id INTEGER PRIMARY KEY,
                user_id INTEGER,
                content TEXT,
                FOREIGN KEY(user_id) REFERENCES users(id)
            )"
        );
    }

    public function getEntriesAll()
    {
        $results = [];
        $query = $this->sql->query("SELECT * FROM chat_entries");
        while ($row = $query->fetchArray()) {
            $row = array_filter(
                $row,
                function ($key) {
                    if (is_int($key))
                        return false;
                    else
                        return true;
                },
                ARRAY_FILTER_USE_KEY
            );
            array_push($results, $row);
        }
        $json = json_encode($results, JSON_PRETTY_PRINT);
        echo $json;
    }

    public function addEntry(int $user_id, string $content)
    {
        $this->sql->exec(
            "INSERT INTO chat_entries(user_id, content)
             VALUES(\"$user_id\", \"$content\")");
    }
}
