<?php

namespace App\ReCaptcha\Providers;

use App\ReCaptcha\ReCaptcha;
use Illuminate\Support\ServiceProvider;

class ReCaptchaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $app = $this->app;

        $this->bootConfig();
        
        $app['validator']->extend('captcha', function ($attribute, $value) use ($app) {
            return $app['captcha']->verifyResponse($value, $app['request']->getClientIp());
        });

        if ($app->bound('form')) {

            $app['form']->macro('captcha', function ($attributes = []) use ($app) {
                return $app['captcha']->display($attributes, $app->getLocale());
            });
        }
    }

    /**
     * Booting configure.
     */
    protected function bootConfig()
    {
        $this->mergeConfigFrom(base_path('config/captcha.php'), 'captcha');

        if (function_exists('config_path')) {
            $this->publishes([
                base_path('config/captcha.php') => config_path('captcha.php')
            ]);
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('re-captcha', function ($app) {
            return new ReCaptcha(
                $app['config']['captcha.secret'],
                $app['config']['captcha.sitekey'],
                $app['config']['captcha.options']
            );
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['captcha'];
    }
}
