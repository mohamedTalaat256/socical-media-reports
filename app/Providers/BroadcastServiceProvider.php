<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

 /*        Broadcast::routes(['prefix' => 'admin',['middleware' => ['web','adminAuth']]]);
      //  Broadcast::routes(['prefix' => 'admin','middleware' => 'auth']); */
        /* Broadcast::routes(); */

        require base_path('routes/channels.php');
    }
}
