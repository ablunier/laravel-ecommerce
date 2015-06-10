<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;

interface ProductInterface
{
    /**
     * Check whether the product is available.
     *
     * @return bool
     */
    public function isAvailable();
}
