<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;

class Product extends Model implements ProductInterface
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
        parent::__construct();

        $this->available_on = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return new \DateTime() >= $this->available_on;
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
    public function addOption(OptionInterface $option)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function removeOption(OptionInterface $option)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function hasOption(OptionInterface $option)
    {

    }
}
