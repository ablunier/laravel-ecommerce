<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model implements VariantInterface
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_variants';

    protected $dates = ['deleted_at'];

    /**
     * {@inheritdoc}
     */
    public function isMaster()
    {
        return $this->master;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaster($master)
    {
        $this->master = (Boolean) $master;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getProduct()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setProduct(ProductInterface $product = null)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(Collection $options)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function addOption(OptionValueInterface $option)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionValueInterface $option)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionValueInterface $option)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setDefaults(VariantInterface $masterVariant)
    {

    }
}
