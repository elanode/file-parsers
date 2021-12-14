<?php

namespace Elanode\FileParsers;

use Illuminate\Support\ServiceProvider;

class FileParsersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('csvparser', function ($app) {
            return new CsvParser();
        });
    }

    public function boot()
    {
        //
    }
}
