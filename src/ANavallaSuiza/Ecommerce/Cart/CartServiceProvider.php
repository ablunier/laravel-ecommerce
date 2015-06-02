<?php
namespace ANavallaSuiza\Ecommerce\Cart\Providers;

use Illuminate\Support\ServiceProvider;
use ANavallaSuiza\Ecommerce\Cart\Models\Cart;

class CartServiceProvider extends ServiceProvider
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
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ANavallaSuiza\Ecommerce\Cart\Models\CartInterface', function () {
            return new Cart;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ANavallaSuiza\Ecommerce\Cart\Models\CartInterface'];
    }
}
