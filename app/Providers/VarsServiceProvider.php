<?php

namespace App\Providers;
use View;

use Illuminate\Support\ServiceProvider;

class VarsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.base', 'App\Providers\ViewComposers\BaseComposer');
    }
}
