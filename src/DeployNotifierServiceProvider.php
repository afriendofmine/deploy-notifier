<?php

namespace Afom\DeployNotifier;

use Afom\DeployNotifier\Console\SendDeployNotification;
use Afom\DeployNotifier\Factory\DeployNotifierFactory;
use Illuminate\Support\ServiceProvider;
use DeployNotifierInterface;

class DeployNotifierServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // bind DeployNotifierInterface
        $this->app->singleton(DeployNotifierInterface::class, function ($app) {
            $deployNotifierFactory = new DeployNotifierFactory();

            return $deployNotifierFactory->create(config('deploy-notifier.settings.notifier'));
        });

        // register command
        $this->commands([SendDeployNotification::class]);
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/deploy-notifier.php' => config_path('deploy-notifier.php'),
        ]);
    }
}
