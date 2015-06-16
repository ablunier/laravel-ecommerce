<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Option extends Model implements OptionInterface
{
    use Translatable;

    /**
     * {@inheritdoc}
     */
    protected $table = 'products_options';

    public $translatedAttributes = ['presentation'];

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setValues(Collection $optionValues)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function addValue(OptionValueInterface $optionValue)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function removeValue(OptionValueInterface $optionValue)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasValue(OptionValueInterface $optionValue)
    {

    }
}
