<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model implements OptionValueInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_options_values';

    public $timestamps = false;
}
