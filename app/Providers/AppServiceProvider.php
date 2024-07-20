<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Interfaces\ProductRepositryInterface;
use App\Repository\ProductRepositry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositryInterface::class,ProductRepositry::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
