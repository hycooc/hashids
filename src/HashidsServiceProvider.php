<?php
/**
 * Created by PhpStorm.
 * User: baoerge
 * Email: baoerge123@163.com
 * Date: 2018/2/8
 * Time: 下午3:52
 */
namespace Hycooc\Hashids;

use Hashids\Hashids;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class HashidsServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     */
    public function setupConfig()
    {
        $source = realpath($raw = __DIR__ . '/../config/hashids.php') ?: $raw;

        if ($this->app instanceof Application && $this->app->runningInConsole()) {
            $this->publishes([
                $source => config_path('hashids.php')
            ]);
        }

        $this->mergeConfigFrom($source, 'hashids');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     */
    protected function registerFactory()
    {
        $this->app->singleton('hashids.factory', function () {
            return new HashidsFactory();
        });
        $this->app->alias('hashids.factory', HashidsFactory::class);
    }

    /**
     * Register the manager class.
     */
    protected function registerManager()
    {
        $this->app->singleton('hashids', function (Container $app) {
            $config  = $app['config'];
            $factory = $app['hashids.factory'];

            return new HashidsManager($config, $factory);
        });
        $this->app->alias('hashids', HashidsManager::class);
    }

    /**
     * Register the bindings.
     */
    protected function registerBindings()
    {
        $this->app->bind('hashids.connection', function (Container $app) {
            $manager = $app['hashids'];

            return $manager->connection();
        });
        $this->app->alias('hashids.connection', Hashids::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'hashids',
            'hashids.factory',
            'hashids.connection',
        ];
    }
}