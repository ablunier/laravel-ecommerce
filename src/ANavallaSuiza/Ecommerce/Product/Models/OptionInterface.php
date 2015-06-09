<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;

interface OptionInterface
{
    /**
     * Returns all option values.
     *
     * @return Collection|OptionValueInterface[]
     */
    public function getValues();

    /**
     * Sets all option values.
     *
     * @param Collection $optionValues
     */
    public function setValues(Collection $optionValues);

    /**
     * Adds option value.
     *
     * @param OptionValueInterface $optionValue
     */
    public function addValue(OptionValueInterface $optionValue);

    /**
     * Removes option value.
     *
     * @param OptionValueInterface $optionValue
     */
    public function removeValue(OptionValueInterface $optionValue);

    /**
     * Checks whether option has given value.
     *
     * @param OptionValueInterface $optionValue
     *
     * @return Boolean
     */
    public function hasValue(OptionValueInterface $optionValue);
}