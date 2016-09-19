<?php

namespace App\Listeners;

use App\Events\ChatConversationsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

class ChatConversationsEventHandler  
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    CONST EVENT   = 'chat.conversations';
    CONST CHANNEL = 'chat.conversations';
    
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChatConversationsEvent  $event
     * @return void
     */
    public function handle(ChatConversationsEvent $event)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $event->data);
    }
}
