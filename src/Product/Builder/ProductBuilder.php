<?php
namespace ANavallaSuiza\Ecommerce\Product\Builder;

use ANavallaSuiza\Ecommerce\Product\Models\Product;
use ANavallaSuiza\Ecommerce\Product\Models\Property;
use ANavallaSuiza\Ecommerce\Product\Models\PropertyValue;

class ProductBuilder implements ProductBuilderInterface
{
    /**
     * Currently built product.
     *
     * @var \ANavallaSuiza\Ecommerce\Product\Models\ProductInterface
     */
    protected $product;

    public function __construct()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function __call($method, $arguments)
    {
        if (!method_exists($this->product, $method)) {
            throw new \BadMethodCallException(sprintf('Product has no "%s()" method.', $method));
        }

        call_user_func_array(array($this->product, $method), $arguments);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build($name)
    {
        $this->product = Product::firstOrNewByName($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addProperty($name, $value, $presentation = null)
    {
        $property = Property::firstOrCreate(['name' => $name]);

        $property->presentation = is_null($presentation) ? $name : $presentation;

        $propertyValue = new PropertyValue;

        $propertyValue->value = $value;
        $propertyValue->property()->associate($property);

        $this->product->addProperty($propertyValue);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $this->product->push();
    }
}
