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
    public function boot()
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
    public function register()
    {
        $this->app->bind('Agog\Osmose\Library\Services\OsmoseFilterService', function() {
            return new OsmoseFilterService();
        });
    }

    /*
     * Register console commands
     */
    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeFilter::class,
            ]);
        }
    }
}
