<?php

namespace Kisiara\Osmose\Providers;

use Illuminate\Support\ServiceProvider;
use Kisiara\Osmose\Console\Commands\MakeFilter;
use Kisiara\Osmose\Library\Services\Sift;

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
        $this->app->bind('Kisiara\Osmose\Library\Services\Sift', function() {
            return new Sift();
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
