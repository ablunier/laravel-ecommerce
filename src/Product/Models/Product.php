<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;

class Product extends Model implements ProductInterface, VariableInterface, AttributeSubjectInterface
{
    use SoftDeletes, Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $dates = ['deleted_at', 'available_on'];

    public $translatedAttributes = ['slug', 'name', 'description', 'meta_keywords', 'meta_description'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->available_on = new \DateTime();

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return new \DateTime() >= $this->available_on;
    }

    public function variants()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Product\Models\Variant');
    }

    public function options()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Product\Models\Option');
    }

    public function attributes()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Product\Models\AttributeValue');
    }

    /**
     * {@inheritdoc}
     */
    public function getMasterVariant()
    {
        foreach ($this->variants as $variant) {
            if ($variant->isMaster()) {
                return $variant;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setMasterVariant(VariantInterface $variant)
    {
        $variant->setMaster(true);

        if (! $this->variants->contains($variant)) {
            $variant->setProduct($this);
            $this->variants->push($variant);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasVariants()
    {
        $items = $this->variants->filter(function (VariantInterface $variant) {
            return ! $variant->isMaster();
        });

        if ($items->isEmpty()) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * {@inheritdoc}
     */
    public function setVariants(Collection $variants)
    {
        $this->variants = $variants;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addVariant(VariantInterface $variant)
    {
        if (! $this->hasVariant($variant)) {
            $variant->setProduct($this);
            $this->variants->push($variant);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeVariant(VariantInterface $variant)
    {
        if ($this->hasVariant($variant)) {
            foreach ($this->variants as $key => $item) {
                if ($item->getKey() === $variant->getKey()) {
                    $this->variants->forget($key);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasVariant(VariantInterface $variant)
    {
        return $this->variants->contains($variant);
    }

    /**
     * {@inheritdoc}
     */
    public function hasOptions()
    {
        return (! $this->options->isEmpty());
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
    public function addOption(OptionInterface $option)
    {
        if (! $this->hasOption($option)) {
            $this->options->push($option);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
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
    public function hasOption(OptionInterface $option)
    {
        return $this->options->contains($option);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(Collection $attributes)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function addAttribute(AttributeValueInterface $attribute)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function removeAttribute(AttributeValueInterface $attribute)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasAttribute(AttributeValueInterface $attribute)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasAttributeByName($attributeName)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeByName($attributeName)
    {

    }
}
