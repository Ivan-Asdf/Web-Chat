<?php

namespace App\External;

class PushAuthenticator extends PushConnection
{
    public function authenticate(string $channel_name, string $socket_id): string
    {
        return $this->pusher->socketAuth($channel_name, $socket_id);
    }
}
