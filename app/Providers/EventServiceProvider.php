<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => ['App\Listeners\LoginSuccess'],
        'Illuminate\Auth\Events\Logout' => ['App\Listeners\LogoutSuccess'],
        'App\Events\UserAccess' => ['App\Listeners\UserAccess'],
        'App\Events\ChatConversationsEvent' => ['App\Listeners\ChatConversationsEventHandler'],
        'App\Events\ChatMessagesEvent' => ['App\Listeners\ChatMessagesEventHandler']
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
