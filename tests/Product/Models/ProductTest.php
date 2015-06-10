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

    private function getVariantMock()
    {
        return Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\VariantInterface');
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

        $variant = $this->getVariantMock();
        $variant->shouldReceive('setProduct')->once()->with($product);
        $variant->shouldReceive('setMaster')->once()->with(true);
        $variant->shouldReceive('isMaster')->once()->andReturn(true);

        $product->setMasterVariant($variant);

        $this->assertEquals($variant, $product->getMasterVariant());
    }

    public function test_should_not_add_master_variant_twice_to_collection()
    {
        $product = $this->getInstance();

        $variant = $this->getVariantMock();
        $variant->shouldReceive('isMaster')->times(2)->andReturn(true);
        $variant->shouldReceive('setProduct')->times(2)->with($product);
        $variant->shouldReceive('setMaster')->times(2)->with(true);
        $variant->shouldReceive('getKey')->once(1)->andReturn(null);

        $product->setMasterVariant($variant);
        $product->setMasterVariant($variant);

        $this->assertFalse($product->hasVariants());
    }

    public function test_hasVariants_should_return_false_if_no_variants_defined()
    {
        $product = $this->getInstance();


        $this->assertFalse($product->hasVariants());
    }

    public function test_add_remove_variant()
    {
        $product = $this->getInstance();

        $variant = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\Variant');
        $variant->shouldReceive('isMaster')->once()->andReturn(false);
        $variant->shouldReceive('setProduct')->once()->with($product);
        $variant->shouldReceive('getKey')->andReturn(1);

        $product->addVariant($variant);

        $this->assertTrue($product->hasVariants());

        $product->removeVariant($variant);

        $this->assertFalse($product->hasVariants());
    }

    public function test_should_initialize_variants_collection_by_default()
    {
        $product = $this->getInstance();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->getVariants());
    }
}
