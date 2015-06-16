<?php
namespace ANavallaSuiza\Tests\Product\Models;

use ANavallaSuiza\Tests\TestBase;
use Mockery;
use ANavallaSuiza\Ecommerce\Product\Models\Product;
use ANavallaSuiza\Ecommerce\Product\Models\ProductInterface;

class ProductTest extends TestBase
{
    protected $product;

    public function setUp()
    {
        parent::setUp();

        $this->product = $this->getInstance();
    }

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
        $this->assertInstanceOf('ANavallaSuiza\Ecommerce\Product\Models\ProductInterface', $this->product);
    }

    public function test_initializes_availability_date_by_default()
    {
        $this->assertInstanceOf('\DateTime', $this->product->available_on);
    }

    public function test_is_available_by_default()
    {
        $this->assertTrue($this->product->isAvailable());
    }

    public function test_availability_date_is_mutable()
    {
        $availableOn = new \DateTime('yesterday');
        $this->product->available_on = $availableOn;

        $this->assertEquals($availableOn, $this->product->available_on);
    }

    public function test_is_available_only_if_availability_date_is_in_past()
    {
        $this->product->available_on = new \DateTime('yesterday');
        $this->assertTrue($this->product->isAvailable());

        $this->product->available_on = new \DateTime('tomorrow');
        $this->assertFalse($this->product->isAvailable());
    }

    function test_initializes_property_collection_by_default()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->product->getProperties());
    }

    public function test_should_not_have_master_variant_by_default()
    {
        $this->assertNull($this->product->getMasterVariant());
    }

    public function test_master_variant_should_be_mutable_and_define_given_variant_as_master()
    {
        $variant = $this->getVariantMock();
        $variant->shouldReceive('setProduct')->once()->with($this->product);
        $variant->shouldReceive('setMaster')->once()->with(true);
        $variant->shouldReceive('isMaster')->once()->andReturn(true);

        $this->product->setMasterVariant($variant);

        $this->assertEquals($variant, $this->product->getMasterVariant());
    }

    public function test_should_not_add_master_variant_twice_to_collection()
    {
        $variant = $this->getVariantMock();
        $variant->shouldReceive('isMaster')->times(2)->andReturn(true);
        $variant->shouldReceive('setProduct')->times(2)->with($this->product);
        $variant->shouldReceive('setMaster')->times(2)->with(true);
        $variant->shouldReceive('getKey')->once(1)->andReturn(null);

        $this->product->setMasterVariant($variant);
        $this->product->setMasterVariant($variant);

        $this->assertFalse($this->product->hasVariants());
    }

    public function test_hasVariants_should_return_false_if_no_variants_defined()
    {
        $this->assertFalse($this->product->hasVariants());
    }

    public function test_add_remove_variant()
    {
        $variant = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\Variant');
        $variant->shouldReceive('isMaster')->once()->andReturn(false);
        $variant->shouldReceive('setProduct')->once()->with($this->product);
        $variant->shouldReceive('getKey')->andReturn(1);

        $this->product->addVariant($variant);

        $this->assertTrue($this->product->hasVariants());

        $this->product->removeVariant($variant);

        $this->assertFalse($this->product->hasVariants());
    }

    public function test_should_initialize_variants_collection_by_default()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->product->getVariants());
    }
}
