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

    public function product()
    {
        return $this->belongsTo('ANavallaSuiza\Ecommerce\Product\Models\Product');
    }

    public function options()
    {
        return $this->belongsToMany('ANavallaSuiza\Ecommerce\Product\Models\OptionValue', 'products_variants_options_values', 'product_variant_id', 'product_option_value_id');
    }

    /**
     * {@inheritdoc}
     */
    public function isMaster()
    {
        return is_null($this->master) ? false : $this->master;
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
        return $this->product;
    }

    /**
     * {@inheritdoc}
     */
    public function setProduct(ProductInterface $product = null)
    {
        $this->product()->associate($product);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions(Collection $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addOption(OptionValueInterface $option)
    {
        if (! $this->hasOption($option)) {
            $this->options->push($option);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionValueInterface $option)
    {
        if ($this->hasOption($option)) {
            foreach ($this->options as $key => $item) {
                if ($item->getKey() === $option->getKey()) {
                    $this->options->forget($key);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionValueInterface $option)
    {
        return $this->options->contains($option);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaults(VariantInterface $masterVariant)
    {
        if (! $masterVariant->isMaster()) {
            throw new \InvalidArgumentException('Cannot inherit values from non master variant.');
        }

        if ($this->isMaster()) {
            throw new \LogicException('Master variant cannot inherit from another master variant.');
        }

        return $this;
    }
}
