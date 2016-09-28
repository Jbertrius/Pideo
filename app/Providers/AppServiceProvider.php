<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Services\Validation;
use Illuminate\Support\Facades\Log;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pusher = $this->app->make('pusher');
        $pusher->set_logger( new LaravelLoggerProxy() );

        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new Validation($translator, $data, $rules, $messages);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

class LaravelLoggerProxy {
    public function log( $msg ) {
        Log::info($msg);
    }
}
