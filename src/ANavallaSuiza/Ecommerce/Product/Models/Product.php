<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

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
     * {@inheritdoc}
     */
    public function isAvailable()
    {
        return new \DateTime() >= $this->available_on;
    }
}
