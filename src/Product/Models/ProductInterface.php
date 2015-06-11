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

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = array());
}
