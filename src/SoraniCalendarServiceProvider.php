<?php

namespace BryarGhafoor\SoraniCalendar;

use Illuminate\Support\ServiceProvider;

class SoraniCalendarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('sorani-calendar', function ($app) {
            return new SoraniCalendar();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish config file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sorani-calendar.php' => config_path('sorani-calendar.php'),
            ], 'sorani-calendar-config');
        }
    }
}
