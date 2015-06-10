<?php
namespace ANavallaSuiza\Tests\Product\Models;

use ANavallaSuiza\Tests\TestBase;
use Mockery;
use ANavallaSuiza\Ecommerce\Product\Models\Product;
use ANavallaSuiza\Ecommerce\Product\Models\ProductInterface;

class ProductTest extends TestBase
{
    public function tearDown()
    {
        Mockery::close();
    }

    private function getInstance($id = null)
    {
        if (isset($id)) {
            return Product::find($id);
        }

        return new Product;
    }

    public function test_implements_product_interface()
    {
        $this->assertInstanceOf('ANavallaSuiza\Ecommerce\Product\Models\ProductInterface', $this->getInstance());
    }

    public function test_initializes_availability_date_by_default()
    {
        $this->assertInstanceOf('\DateTime', $this->getInstance()->available_on);
    }

    public function test_is_available_by_default()
    {
        $this->assertTrue($this->getInstance()->isAvailable());
    }

    public function test_availability_date_is_mutable()
    {
        $product = $this->getInstance();

        $availableOn = new \DateTime('yesterday');
        $product->available_on = $availableOn;

        $this->assertEquals($availableOn, $product->available_on);
    }

    public function test_is_available_only_if_availability_date_is_in_past()
    {
        $product = $this->getInstance();

        $product->available_on = new \DateTime('yesterday');
        $this->assertTrue($product->isAvailable());

        $product->available_on = new \DateTime('tomorrow');
        $this->assertFalse($product->isAvailable());
    }

    public function test_should_not_have_master_variant_by_default()
    {
        $product = $this->getInstance();

        $this->assertNull($product->getMasterVariant());
    }

    public function test_master_variant_should_be_mutable_and_define_given_variant_as_master()
    {
        $product = $this->getInstance();

        $variant = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\VariantInterface');
        $variant->shouldReceive('setProduct')->once()->with($product);
        $variant->shouldReceive('setMaster')->once()->with(true);
        $variant->shouldReceive('isMaster')->once()->andReturn(true);

        $product->setMasterVariant($variant);

        $this->assertEquals($variant, $product->getMasterVariant());
    }
}
