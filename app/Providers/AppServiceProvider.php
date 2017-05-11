<?php

namespace App\Providers;

use App\Models\News;
use App\Observers\NewsObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Мелочь, но это лишнее
        // Без этого при мигоации сконва были ошибки на длину строки(
        Schema::defaultStringLength(191);

        //Регистрация обсервера для News
        News::observe(NewsObserver::class);
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
