<?php

namespace App\Providers;

use App\Forms\Fields\ButtonFormField;
use Illuminate\Support\ServiceProvider;
use Voyager;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        Voyager::addFormField(ButtonFormField::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
