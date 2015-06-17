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

    public function images()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Product\Models\Image');
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

    /**
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage()
    {
        if ($this->images->isEmpty()) {
            return $this->getProduct()->getImage();
        }

        return $this->images->first();
    }

    /**
     * {@inheritdoc}
     */
    public function hasImage(ImageInterface $image)
    {
        return $this->images->contains($image);
    }

    /**
     * {@inheritdoc}
     */
    public function addImage(ImageInterface $image)
    {
        if (! $this->hasImage($image)) {
            $this->images->push($image);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeImage(ImageInterface $image)
    {
        if ($this->hasImage($image)) {
            foreach ($this->images as $key => $item) {
                if ($item->getKey() === $image->getKey()) {
                    $this->images->forget($key);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * {@inheritdoc}
     */
    public function getInventoryName()
    {
        return $this->getProduct()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function isInStock()
    {
        return 0 < $this->on_hand;
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailableOnDemand()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getOnHold()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setOnHold($onHold)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getOnHand()
    {
        return $this->on_hand;
    }

    /**
     * {@inheritdoc}
     */
    public function setOnHand($onHand)
    {
        $this->on_hand = $onHand;

        if (0 > $this->on_hand) {
            $this->on_hand = 0;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        if (! is_int($price)) {
            throw new \InvalidArgumentException('Price must be an integer.');
        }

        $this->price = $price;

        return $this;
    }
}
