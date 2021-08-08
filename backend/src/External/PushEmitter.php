<?php
namespace App\External;

class PushEmitter {

    private $options;
    private $pusher;

    public function __construct() {
        $this->options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );

        $this->pusher = new \Pusher\Pusher(
            '44a73a86f03133cb77c9',
            '8866d6234c33195f0e87',
            '1247061',
            $this->options
        );
    }
    
    public function emit($data) {
        $this->pusher->trigger('my-channel', 'my-event', $data);
    }


}