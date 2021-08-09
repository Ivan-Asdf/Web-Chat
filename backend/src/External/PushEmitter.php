<?php

namespace App\External;

class PushEmitter extends PushConnection
{
    public function emit($data)
    {
        $this->pusher->trigger(self::CHAT_ENTRIES_CHANNEL, self::CHAT_ENTRIES_EVENT, $data);
    }
}
