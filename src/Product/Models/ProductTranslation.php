<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;
use ANavallaSuiza\Ecommerce\Product\Observer\ProductTranslationObserver;

class ProductTranslation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_translations';

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        parent::observe(new ProductTranslationObserver());
    }
}
