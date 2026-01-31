<?php

namespace App\Infrastructure\Laravel\Providers;

use App\Infrastructure\Identity\Adapters\SanctumTokenIssuer;
use App\Application\Shared\Bus\Command\{
    CommandBus,
    HandlerResolver
};

use App\Application\Shared\Ports\{IdGenerator, PasswordHasher, TokenIssuer, TransactionManager};

use App\Infrastructure\Shared\Adapters\{
    LaravelPasswordHasher,
    LaravelTransactionManager,
    StrUuidIdGenerator
};

use App\Infrastructure\Shared\Bus\Command\{
    LaravelContainerHandlerResolver,
    SyncCommandBus
};

use Illuminate\Support\ServiceProvider;
use App\Domain\Identity\Repositories\UserRepository;
use App\Infrastructure\Identity\Persistence\EloquentUserRepository;

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
        $this->app->bind(HandlerResolver::class, LaravelContainerHandlerResolver::class);
        $this->app->bind(CommandBus::class, SyncCommandBus::class);
        $this->app->bind(TokenIssuer::class, SanctumTokenIssuer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
