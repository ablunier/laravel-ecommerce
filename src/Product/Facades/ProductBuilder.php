<?php
namespace ANavallaSuiza\Ecommerce\Product\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ANavallaSuiza\Ecommerce\Product\Builder\ProductBuilder
 */
class ProductBuilder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ANavallaSuiza\Ecommerce\Product\Builder\ProductBuilderInterface';
    }
}
