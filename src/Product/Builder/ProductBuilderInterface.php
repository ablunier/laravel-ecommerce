<?php
namespace ANavallaSuiza\Ecommerce\Product\Builder;

/**
 * Product builder interface.
 *
 * The goal of service implementing this interface is to ease the process of creating products.
 *
 */
interface ProductBuilderInterface
{
    /**
     * Start creating the product with specified name.
     *
     * @param string $name
     *
     * @return ProductBuilderInterface
     */
    public function build($name, $sku, $price, $stockQty);

    /**
     * Add attribute value.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return ProductBuilderInterface
     */
    public function addAttribute($name, $value);

    /**
     * Add property with name and value.
     *
     * @param string $name
     * @param mixed  $value
     * @param string $presentation
     *
     * @return ProductBuilderInterface
     */
    public function addProperty($name, $value, $presentation = null);

    /**
     * Save the product
     *
     * @param Boolean $flush
     *
     * @return ProductInterface
     */
    public function save();
}
