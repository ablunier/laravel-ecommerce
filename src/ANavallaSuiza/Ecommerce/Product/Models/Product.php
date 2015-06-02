<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model implements ProductInterface
{
    /**
     * {@inheritdoc}
     */
    public function isAvailable()
    {

    }
}
