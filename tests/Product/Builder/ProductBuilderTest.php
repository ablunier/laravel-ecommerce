<?php
namespace ANavallaSuiza\Tests\Product\Models;

use ANavallaSuiza\Tests\TestBase;
use Mockery;
use App;
use ANavallaSuiza\Ecommerce\Product\Builder\ProductBuilder;
use ANavallaSuiza\Ecommerce\Product\Models\Product;

class ProductBuilderTest extends TestBase
{
    protected $productBuilder;

    public function setUp()
    {
        parent::setUp();

        $this->productBuilder = $this->getInstance();
    }

    private function getInstance()
    {
        return App::make('ANavallaSuiza\Ecommerce\Product\Builder\ProductBuilder');
    }

    public function test_creates_product()
    {
        $productName = 'GitHub T-Shirt';

        $this->productBuilder->build($productName)
            ->save();

        $product = Product::firstOrNewByName($productName);

        $this->assertEquals($productName, $product->name);
    }

    public function test_creates_property_if_it_does_not_exist()
    {
        $productName = 'GitHub T-Shirt';

        $this->productBuilder->build($productName)
            ->addProperty('Collection', 2015)
            ->save();

        $product = Product::firstOrNewByName($productName);

        $properties = $product->getProperties();

        $this->assertEquals(2015, $properties->first()->getValue());
        $this->assertEquals('Collection', $properties->first()->getProperty()->name);
    }
}
