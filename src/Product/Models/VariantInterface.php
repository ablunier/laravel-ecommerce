<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

interface VariantInterface
{
    /**
     * Get element key.
     *
     * @return mixed
     */
    public function getKey();

    /**
     * Checks whether variant is master.
     *
     * @return Boolean
     */
    public function isMaster();

    /**
     * Defines whether variant is master.
     *
     * @param Boolean $master
     */
    public function setMaster($master);

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
    public function setProduct(ProductInterface $product);

    /**
     * Returns all option values.
     *
     * @return Collection|OptionValueInterface[]
     */
    public function getOptions();

    /**
     * Sets all variant options.
     *
     * @param Collection $options
     */
    public function setOptions(Collection $options);

    /**
     * Adds option value.
     *
     * @param OptionValueInterface $option
     */
    public function addOption(OptionValueInterface $option);

    /**
     * Removes option from variant.
     *
     * @param OptionValueInterface $option
     */
    public function removeOption(OptionValueInterface $option);

    /**
     * Checks whether variant has given option.
     *
     * @param OptionValueInterface $option
     *
     * @return Boolean
     */
    public function hasOption(OptionValueInterface $option);

    /**
     * This method is used by product variants to inherit values
     * from a master variant, which is treated as a "template" for them.
     *
     * This is usable only when product has options.
     *
     * @param VariantInterface $masterVariant
     */
    public function setDefaults(VariantInterface $masterVariant);
}
