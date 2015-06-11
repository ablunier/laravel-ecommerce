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
    public function create($name);

    /**
     * Add attribute with name and value.
     *
     * @param string $name
     * @param mixed  $value
     * @param string $presentation
     *
     * @return ProductBuilderInterface
     */
    public function addAttribute($name, $value);

    /**
     * Save the product
     *
     * @param Boolean $flush
     *
     * @return ProductInterface
     */
    public function save();
}
