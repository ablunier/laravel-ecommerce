<?php
namespace ANavallaSuiza\Tests\Product\Models;

use ANavallaSuiza\Tests\TestBase;
use Mockery;
use ANavallaSuiza\Ecommerce\Product\Models\Variant;

class VariantTest extends TestBase
{
    protected $variant;

    public function setUp()
    {
        parent::setUp();

        $this->variant = $this->getInstance();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    private function getInstance($id = null)
    {
        if (isset($id)) {
            return Variant::find($id);
        }

        return new Variant;
    }

    public function test_implements_variant_interface()
    {
        $this->assertInstanceOf('ANavallaSuiza\Ecommerce\Product\Models\VariantInterface', $this->variant);
    }

    public function test_should_allow_assigning_itself_to_a_product()
    {
        $product = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\Product')->makePartial();

        $this->variant->setProduct($product);

        $this->assertEquals($product, $this->variant->getProduct());
    }

    public function test_should_not_be_master_variant_by_default()
    {
        $this->assertFalse($this->variant->isMaster());
    }

    public function test_is_master_variant_when_marked_so()
    {
        $this->assertFalse($this->variant->isMaster());

        $this->variant->setMaster(true);

        $this->assertTrue($this->variant->isMaster());
    }

    public function test_should_initialize_option_values_collection_by_default()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->variant->getOptions());
    }

    public function test_should_add_option_value_properly()
    {
        $option = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\OptionValue')->makePartial();

        $this->variant->addOption($option);

        $this->assertTrue($this->variant->hasOption($option));
    }

    public function test_should_remove_option_value_properly()
    {
        $option = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\OptionValue')->makePartial();

        $this->variant->addOption($option);
        $this->assertTrue($this->variant->hasOption($option));

        $this->variant->removeOption($option);
        $this->assertFalse($this->variant->hasOption($option));
    }

    public function test_throws_exception_if_trying_to_inherit_values_and_being_a_master_variant()
    {
        $this->setExpectedException('\LogicException');

        $variant = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\Variant')->makePartial();

        $this->variant->setMaster(true);
        $this->variant->setDefaults($variant);
    }

    public function test_throws_exception_if_trying_to_inherit_values_from_non_master_variant()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $variant = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\Variant')->makePartial();

        $this->variant->setDefaults($variant);
    }

    public function test_price_should_accept_only_integer()
    {
        $this->variant->setPrice(410);

        $this->isType('int', $this->variant->getPrice());

        $this->setExpectedException('\InvalidArgumentException');

        $this->variant->setPrice(4.1 * 100);
        $this->variant->setPrice('410');
        $this->variant->setPrice(round(4.1 * 100));
        $this->variant->setPrice(array(410));
        $this->variant->setPrice(new \stdClass());
    }
}
