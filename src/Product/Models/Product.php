<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use EasySlugger\Slugger;
use App;

class Product extends Model implements ProductInterface, VariableInterface, PropertySubjectInterface
{
    use SoftDeletes, Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    protected $dates = ['deleted_at', 'available_on'];

    public $translatedAttributes = ['slug', 'name', 'short_description', 'description', 'meta_keywords', 'meta_description'];

    /**
     * Constructor.
     */
    public function __construct(array $attributes = array())
    {
        $this->available_on = new \DateTime();

        parent::__construct($attributes);
    }

    public static function boot()
    {
        parent::boot();

        self::saving(function ($row) {
            if (is_null($row->slug)) {
                $row->slug = $row->name;
            }

            $row->slug = Slugger::slugify($row->slug);
        });
    }

    public static function firstOrNewByName($name)
    {
        $instance = static::whereHas('translations', function ($query) use ($name) {
            $query->where('name', 'LIKE', $name);
        })->first();

        if (! is_null($instance)) {
            return $instance;
        }

        return static::create([
            App::getLocale() => ['name' => $name]
        ]);
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

    public function properties()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Product\Models\PropertyValue');
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->getMasterVariant()->getSku();
    }
    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        $this->getMasterVariant()->setSku($sku);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImages()
    {
        return $this->getMasterVariant()->getImages();
    }

    /**
     * {@inheritdoc}
     */
    public function getImage()
    {
        return $this->getMasterVariant()->getImages()->first();
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->getMasterVariant()->getPrice();
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        $this->getMasterVariant()->setPrice($price);

        return $this;
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
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function setProperties(Collection $properties)
    {
        $this->properties = $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function addProperty(PropertyValueInterface $property)
    {
        if (! $this->hasProperty($property)) {
            $property->setSubject($this);
            $this->properties->push($property);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeProperty(PropertyValueInterface $property)
    {
        if ($this->hasProperty($property)) {
            foreach ($this->properties as $key => $item) {
                if ($item->getKey() === $property->getKey()) {
                    $this->properties->forget($key);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty(PropertyValueInterface $property)
    {
        return $this->properties->contains($property);
    }

    /**
     * {@inheritdoc}
     */
    public function hasPropertyByName($propertyName)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getPropertyByName($propertyName)
    {

    }
}
