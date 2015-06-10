<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model implements OptionInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_options';
}
