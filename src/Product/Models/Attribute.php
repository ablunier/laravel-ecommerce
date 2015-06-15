<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model implements AttributeInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_attributes';

    public $timestamps = false;
}
