<?php

namespace Project\Providers;

use Illuminate\Support\ServiceProvider;
use Project\Repositories\ClientRepository;
use Project\Repositories\ClientRepositoryEloquent;
use Project\Repositories\ProjectMemberRepository;
use Project\Repositories\ProjectMemberRepositoryEloquent;
use Project\Repositories\ProjectNoteRepository;
use Project\Repositories\ProjectNoteRepositoryEloquent;
use Project\Repositories\ProjectRepository;
use Project\Repositories\ProjectRepositoryEloquent;
use Project\Repositories\ProjectTaskRepository;
use Project\Repositories\ProjectTaskRepositoryEloquent;
use Project\Repositories\ProjectFileRepository;
use Project\Repositories\ProjectFileRepositoryEloquent;

class ProjectRepositoryProvider extends ServiceProvider
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

        $this->app->bind( ProjectFileRepository::class,
            ProjectFileRepositoryEloquent::class );

        $this->app->bind( ProjectRepository::class,
                          ProjectRepositoryEloquent::class );

        $this->app->bind( ProjectNoteRepository::class,
                          ProjectNoteRepositoryEloquent::class );

        $this->app->bind( ProjectTaskRepository::class,
                          ProjectTaskRepositoryEloquent::class );

        $this->app->bind( ProjectMemberRepository::class,
                          ProjectMemberRepositoryEloquent::class );

    }
}
