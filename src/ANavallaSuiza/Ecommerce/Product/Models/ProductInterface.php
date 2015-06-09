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

    /**
     * Returns all prototype options.
     *
     * @return Collection|OptionInterface[]
     */
    public function getOptions();

    /**
     * Sets all prototype options.
     *
     * @param Collection|OptionInterface[] $options
     */
    public function setOptions(Collection $options);

    /**
     * Adds option.
     *
     * @param OptionInterface $option
     */
    public function addOption(OptionInterface $option);

    /**
     * Removes option from prototype.
     *
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option);

    /**
     * Checks whether prototype has given option.
     *
     * @param OptionInterface $option
     *
     * @return boolean
     */
    public function hasOption(OptionInterface $option);
}
