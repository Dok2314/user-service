<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Application\Shared\Ports\IdGenerator;
use App\Application\Shared\Ports\PasswordHasher;
use App\Application\Shared\Ports\TransactionManager;
use App\Domain\Identity\Repositories\UserRepository;
use App\Infrastructure\Identity\Persistence\EloquentUserRepository;
use App\Infrastructure\Shared\Adapters\LaravelPasswordHasher;
use App\Infrastructure\Shared\Adapters\LaravelTransactionManager;
use App\Infrastructure\Shared\Adapters\StrUuidIdGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(IdGenerator::class, StrUuidIdGenerator::class);
        $this->app->bind(TransactionManager::class, LaravelTransactionManager::class);
        $this->app->bind(PasswordHasher::class, LaravelPasswordHasher::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
