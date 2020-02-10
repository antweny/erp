<?php

namespace App\Providers;

use App\Repositories\ParticipantRepository;
use App\Repositories\ParticipantRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ParticipantRepositoryInterface::class,ParticipantRepository::class);
    }
}
