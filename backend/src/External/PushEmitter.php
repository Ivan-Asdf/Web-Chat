<?php

namespace App\External;

class PushEmitter
{

    private $options;
    private $pusher;

    public function __construct()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
        $dotenv->load();
        $app_id = $_ENV["PUSHER_APP_ID"];
        $key = $_ENV["PUSHER_KEY"];
        $secret = $_ENV["PUSHER_SECRET"];

            $this->options = array(
                'cluster' => 'eu',
                'useTLS' => true
            );

        $this->pusher = new \Pusher\Pusher(
            $key,
            $secret,
            $app_id,
            $this->options
        );
    }

    public function emit($data)
    {
        $this->pusher->trigger('my-channel', 'my-event', $data);
    }
}
