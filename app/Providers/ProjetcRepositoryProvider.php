<?php

namespace Project\Providers;

use Illuminate\Support\ServiceProvider;
use Project\Repositories\ClientRepository;
use Project\Repositories\ClientRepositoryEloquent;
use Project\Repositories\ProjectRepository;
use Project\Repositories\ProjectRepositoryEloquent;

class ProjetcRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( ClientRepository::class,
                          ClientRepositoryEloquent::class );

        $this->app->bind( ProjectRepository::class,
                          ProjectRepositoryEloquent::class );

    }
}
