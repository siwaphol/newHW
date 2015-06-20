<?php namespace App\Providers;

use App\User;
use App\Auth\CustomUserProvider;
use Illuminate\Support\ServiceProvider;

class CustomAuthProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->extend('custom',function()
        {
//            return new CustomUserProvider($this->app['hash'],$this->app['config']['auth.model']);
            return new CustomUserProvider(['App\Student','App\Teacher','App\Ta','App\Admin']);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        return;
    }

}