<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class OptionValue extends Model implements OptionValueInterface
{
    use Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_options_values';

    public $timestamps = false;

    public $translatedAttributes = ['value'];

    public function option()
    {
        return $this->belongsTo('ANavallaSuiza\Ecommerce\Product\Models\Option', 'product_option_id');
    }

    /**
     * {@inheritdoc}
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * {@inheritdoc}
     */
    public function setOption(OptionInterface $option = null)
    {
        $this->option()->associate($option);
    }
}
