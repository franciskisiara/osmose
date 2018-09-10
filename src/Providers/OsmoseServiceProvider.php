<?php

namespace Kisiara\Osmose\Providers;

use Illuminate\Support\ServiceProvider;
use Kisiara\Osmose\Console\MakeFilter;

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
//        $this->mergeConfigFrom(
//            __DIR__ . '/../config/osmose.php', 'osmose'
//        );
    }

    /*
     * Register console commands
     */
    public function registerCommands()
    {
//        if ($this->app->runningInConsole()) {
//            $this->commands([
//                MakeFilter::class,
//            ]);
//        }
    }
}
