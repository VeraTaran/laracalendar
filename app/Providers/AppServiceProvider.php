<?php

namespace App\Providers;

use App\Services\Admin\V1\Calendar\Repositories\CalendarRepositoryInterface;
use App\Services\Admin\V1\Calendar\Repositories\EloquentCalendarRepository;
use App\Services\Admin\V1\Event\Repositories\EloquentEventRepository;
use App\Services\Admin\V1\Event\Repositories\EventRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EloquentEventRepository::class);
        $this->app->bind(CalendarRepositoryInterface::class, EloquentCalendarRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
