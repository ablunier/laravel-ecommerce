<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Attribute extends Model implements AttributeInterface
{
    use Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_attributes';

    public $timestamps = false;

    public $translatedAttributes = ['presentation'];
}
