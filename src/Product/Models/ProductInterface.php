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

    /**
     * Get product SKU.
     *
     * @return string
     */
    public function getSku();

    /**
     * Set product SKU.
     *
     * @param string $sku
     */
    public function setSku($sku);

    /**
     * Get all product images.
     *
     * @return Collection|ImageInterface[]
     */
    public function getImages();

    /**
     * Get product main image.
     *
     * @return ImageInterface
     */
    public function getImage();
}
