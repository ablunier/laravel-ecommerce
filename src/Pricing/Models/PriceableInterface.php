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

    /**
     * Get the name of pricing calculator.
     *
     * @return string
     */
    public function getPricingCalculator();

    /**
     * Set the pricing calculation service type.
     *
     * @param string $calculator
     */
    public function setPricingCalculator($calculator);

    /**
     * Get pricing configuration.
     *
     * @return array
     */
    public function getPricingConfiguration();

    /**
     * Set pricing configuration.
     *
     * @param array $configuration
     */
    public function setPricingConfiguration(array $configuration);
}
