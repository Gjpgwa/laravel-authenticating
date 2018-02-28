<?php

namespace Gwagjp\Authenticating;

use Illuminate\Support\ServiceProvider;

class AuthenticatingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/authenticating.php';

        $this->publishes([$configPath => config_path('authenticating.php')], 'config');
        $this->mergeConfigFrom($configPath, 'authenticating');

        if ( class_exists('Laravel\Lumen\Application') ) {
            $this->app->configure('authenticating');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('authenticating', function ($app) {
            $config = isset($app['config']['services']['authenticating']) ? $app['config']['services']['authenticating'] : null;
            if (is_null($config)) {
                $config = $app['config']['authenticating'] ?: $app['config']['authenticating::config'];
            }

            return new Authenticating();

        });
    }

    public function provides() {
        return ['authenticating'];
    }


}
