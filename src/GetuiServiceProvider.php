<?php
/**
 * Created by PhpStorm.
 * User: lacorey
 * Date: 16/9/21
 * Time: 上午9:45
 */

namespace Echobool\Getui;


use Illuminate\Support\ServiceProvider;

class GetuiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/getui.php' => config_path('getui.php'),
        ]);


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Getui', function ($app) {
            return new GetuiPush($app['config']);//config
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['getui'];
    }
}