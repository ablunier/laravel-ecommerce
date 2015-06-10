<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

interface ProductInterface
{
    /**
     * Check whether the product is available.
     *
     * @return bool
     */
    public function isAvailable();
}
