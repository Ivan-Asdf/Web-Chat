<?php

namespace App\External;

abstract class PushConnection
{
    private $options;

    protected $pusher;

    protected const CHAT_ENTRIES_CHANNEL = 'private-my-channel';
    protected const CHAT_ENTRIES_EVENT = 'my-event';

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
}
