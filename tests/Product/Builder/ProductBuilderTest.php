<?php
namespace ANavallaSuiza\Tests\Product\Models;

use ANavallaSuiza\Tests\TestBase;
use Mockery;
use App;
use DB;
use ANavallaSuiza\Ecommerce\Product\Builder\ProductBuilder;
use ANavallaSuiza\Ecommerce\Product\Models\Product;

class ProductBuilderTest extends TestBase
{
    protected $productBuilder;
    protected $product;

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
        $SKU = 'SKU99';
        $price = 100;
        $stock = 100;

        $this->productBuilder->build($productName, $SKU, $price, $stock)
            ->addAttribute('description', 'Awesome description')
            ->save();

        $this->product = Product::firstOrCreateByName($productName);

        $this->assertEquals($productName, $this->product->name);
        $this->assertEquals($price, $this->product->getPrice());
        $this->assertEquals($SKU, $this->product->getSku());
        $this->assertEquals(true, $this->product->getMasterVariant()->isInStock());
    }

    public function test_creates_property_if_it_does_not_exist()
    {
        $productName = 'GitHub T-Shirt';
        $SKU = 'SKU99';
        $price = 100;
        $stock = 100;

        $this->product = $this->productBuilder->build($productName, $SKU, $price, $stock)
            ->addAttribute('description', 'Awesome description')
            ->addProperty('Collection', 2015)
            ->save();

        $properties = $this->product->getProperties();

        $this->assertEquals(2015, $properties->first()->getValue());
        $this->assertEquals('Collection', $properties->first()->getProperty()->name);
    }
}
