<?php

namespace Tarasenko\Time;

use Illuminate\Support\ServiceProvider;

class TimeServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadViewsFrom(__DIR__ . '/views', 'time');
        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/tarasenko/time'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';
        $this->app->make('Tarasenko\Time\TimeController');
    }

}
