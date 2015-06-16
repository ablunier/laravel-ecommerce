<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Option extends Model implements OptionInterface
{
    use Translatable;

    /**
     *
     */
    protected $table = 'products_options';

    public $translatedAttributes = ['presentation'];

    public function values()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Product\Models\OptionValue', 'product_option_id');
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     */
    public function setValues(Collection $optionValues)
    {
        $this->values = $optionValues;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addValue(OptionValueInterface $optionValue)
    {
        if (! $this->hasValue($optionValue)) {
            $optionValue->setOption($this);
            $this->values->push($optionValue);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(OptionValueInterface $optionValue)
    {
        if ($this->hasValue($optionValue)) {
            foreach ($this->values as $key => $item) {
                if ($item->getKey() === $optionValue->getKey()) {
                    $this->values->forget($key);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(OptionValueInterface $optionValue)
    {
        return $this->values->contains($optionValue);
    }
}
