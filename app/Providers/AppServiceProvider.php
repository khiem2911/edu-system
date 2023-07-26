<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Support\Facades\Schema; 
use Illuminate\Pagination\Paginator;    
=======
use Illuminate\Pagination\Paginator;
>>>>>>> c5f0101bc636bdc232c62eee42a5228ba3c25fe2

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
        //
        Paginator::useBootstrap();
<<<<<<< HEAD
        Schema::defaultStringLength(191);
=======
>>>>>>> c5f0101bc636bdc232c62eee42a5228ba3c25fe2
    }
}
