<?php

namespace App\Providers;

use App\FooterSetup;
use App\HeaderSetup;
use Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use View;

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
        Schema::defaultStringLength(191);

        view::composer('admin.includes.header', function($view){
            $user = Auth::user();
            $header = HeaderSetup::first();
            $footer = FooterSetup::first();
            $view->with([
                'user'   => $user,
                'header' => $header,
                'footer' => $footer,
            ]);
        });
        view::composer('admin.includes.footer', function($view){
            $footer = FooterSetup::first();
            $view->with([
                'footer' => $footer,
            ]);
        });
    }
}
