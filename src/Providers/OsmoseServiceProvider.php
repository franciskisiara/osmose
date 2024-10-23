<?php

namespace Agog\Osmose\Providers;

use Illuminate\Support\ServiceProvider;
use Agog\Osmose\Console\Commands\MakeFilter;
use Agog\Osmose\Library\Services\OsmoseFilterService;

class OsmoseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/osmose.php' => config_path('osmose.php'),
        ]);

        $this->registerCommands();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('Agog\Osmose\Library\Services\OsmoseFilterService', function() {
            return new OsmoseFilterService();
        });
    }

    /**
     * Register console commands
     *
     * @return void
     */
    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFilter::class,
            ]);
        }
    }
}
