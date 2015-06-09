<?php
namespace ANavallaSuiza\Ecommerce;

use Illuminate\Support\ServiceProvider;

class StoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('ans-ecommerce.php')
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ans-ecommerce');

        $this->app->bind('ANavallaSuiza\Ecommerce\Product\Models\ProductInterface', function () {
            return $this->app->make(config('ans-ecommerce.product_model'));
        });

        $this->app->register('Dimsav\Translatable\TranslatableServiceProvider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'ANavallaSuiza\Ecommerce\Product\Models\ProductInterface'
        ];
    }
}
