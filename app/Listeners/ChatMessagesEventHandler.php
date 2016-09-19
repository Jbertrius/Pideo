<?php

namespace App\Listeners;

use App\Events\ChatMessagesEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

class ChatMessagesEventHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    CONST EVENT   = 'chat.messages';
    CONST CHANNEL = 'chat.messages';

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChatMessagesEvent  $event
     * @return void
     */
    public function handle(ChatMessagesEvent $event)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $event->data);
    }
}
