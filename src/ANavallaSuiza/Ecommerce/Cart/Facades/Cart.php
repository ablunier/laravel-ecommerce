<?php
namespace ANavallaSuiza\Ecommerce\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ANavallaSuiza\Ecommerce\Cart\Models\Cart
 */
class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ANavallaSuiza\Ecommerce\Cart\Models\CartInterface';
    }
}
