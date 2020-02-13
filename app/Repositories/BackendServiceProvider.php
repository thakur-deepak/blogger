<?php

namespace App\Repositories;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Posts\Interfaces\PostRepositoryInterface',
            'App\Repositories\Posts\PostRepository'
        );
    }
}
