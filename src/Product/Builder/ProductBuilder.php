<?php
namespace ANavallaSuiza\Ecommerce\Product\Builder;

use ANavallaSuiza\Ecommerce\Product\Models\Product;
use ANavallaSuiza\Ecommerce\Product\Models\Property;
use ANavallaSuiza\Ecommerce\Product\Models\PropertyValue;
use ANavallaSuiza\Ecommerce\Product\Models\Variant;
use DB;

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
    public function build($name, $sku, $price, $stockQty)
    {
        DB::beginTransaction();

        $this->product = Product::firstOrCreateByName($name);

        // Set Base Varient
        $variant = new Variant;

        $variant->sku = $sku;
        $variant->price = $price;
        $variant->on_hand = $stockQty;
        $variant->product_id = $this->product->id;
        $variant->master = true;

        if ($variant->save()) {
            return $this;
        }

        DB::rollBack();
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function addAttribute($name, $value)
    {
        $this->product->setAttribute($name, $value);

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
        $propertyValue->product()->associate($this->product);

        $propertyValue->save();

        $this->product->addProperty($propertyValue);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $this->product->save();

        DB::commit();

        return $this->product;
    }
}
