<?php

namespace App\Providers;

use App\Models\Rubric;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//из-за этого вывода могут не передаваться заголовки и сайт будет работать не коректно
        //app/provides/AppServiceProvider
        DB::listen(function ($query) {
//            dump($query->sql, $query->bindings);
            //логирование sql запросов
            Log::channel('sqllogs')->info($query->sql);
        });


        //передача рубрик для шаблона footer
        view()->composer('layouts.footer', function ($view) {
            $view->with('rubrics', Rubric::all());
        });

    }
}
