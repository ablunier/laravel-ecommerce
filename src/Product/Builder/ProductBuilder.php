<?php
namespace ANavallaSuiza\Ecommerce\Product\Builder;

use ANavallaSuiza\Ecommerce\Product\Models\ProductInterface;

class ProductBuilder implements ProductBuilderInterface
{
    /**
     * Currently built product.
     *
     * @var ProductInterface
     */
    protected $product;

    public function __construct()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function create($name)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function addAttribute($name, $value)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {

    }
}
