<?php

namespace App\Providers;

use App\Repositories\EloquentRepository;
use Illuminate\Support\ServiceProvider;
//use App\Interfaces\RepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind(RepositoryInterface::class, EloquentRepository::class);
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
