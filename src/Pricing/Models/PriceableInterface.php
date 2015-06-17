<?php
namespace ANavallaSuiza\Ecommerce\Pricing\Models;

interface PriceableInterface
{
    /**
     * Get standard price.
     *
     * @return integer
     */
    public function getPrice();

    /**
     * Set standard price.
     *
     * @param integer $price
     */
    public function setPrice($price);
}
