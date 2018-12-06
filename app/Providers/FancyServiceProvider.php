<?php

namespace App\Providers;

use App\Services\FancyService as Client;
use Illuminate\Support\ServiceProvider;

class FancyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the app service.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('fancy_service_client', function () {
            // return new Client(Mbira\Config::get('FancyService'));

            return new Client(config('services.fancy_service'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'fancy_service_client',
        ];
    }
}
