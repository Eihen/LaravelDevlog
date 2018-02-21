<?php

namespace Eihen\Devlog;

use Eihen\Devlog\Commands\MakeMigrationCommand;
use Eihen\Devlog\Commands\MakeVersionCommand;
use Eihen\Devlog\Commands\MakeChangeCommand;
use Eihen\Devlog\Commands\NewChangeCommand;
use Eihen\Devlog\Commands\NewVersionCommand;
use Eihen\Devlog\Commands\ReleaseVersionCommand;
use Eihen\Devlog\Commands\SetupCommand;
use Illuminate\Support\ServiceProvider;

class DevlogServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Register published configuration.
        $this->publishes([
            __DIR__ . '/config/devlog.php' => config_path('devlog.php')
        ], 'devlog');

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeMigrationCommand::class,
                MakeVersionCommand::class,
                MakeChangeCommand::class,
                SetupCommand::class,
                NewVersionCommand::class,
                NewChangeCommand::class,
                ReleaseVersionCommand::class
            ]);
        }
    }

    public function register()
    {
    }
}
