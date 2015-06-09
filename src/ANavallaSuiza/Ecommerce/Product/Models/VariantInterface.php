<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

interface VariantInterface
{
    /**
     * Checks whether variant is master.
     *
     * @return Boolean
     */
    public function isMaster();

    /**
     * Get product.
     *
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * Set product.
     *
     * @param null|ProductInterface $product
     */
    public function setProduct(ProductInterface $product = null);
}
