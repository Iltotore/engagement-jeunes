<?php

namespace App\Providers;

use App\Services\TimeService;
use App\Services\FrozenTimeService;
use App\Services\SystemTimeService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Nette\InvalidStateException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(App::runningUnitTests()) {
            $this->app->singleton(TimeService::class, function($container) {
                return new FrozenTimeService(0);
            });
        } else {
            $this->app->singleton(TimeService::class, function($container) {
                return new SystemTimeService();
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
