<?php
namespace ANavallaSuiza\Tests\Product\Models;

use ANavallaSuiza\Tests\TestBase;
use Mockery;
use ANavallaSuiza\Ecommerce\Product\Models\OptionValue;

class OptionValueTest extends TestBase
{
    protected $optionValue;

    public function setUp()
    {
        parent::setUp();

        $this->optionValue = $this->getInstance();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    private function getInstance($id = null)
    {
        if (isset($id)) {
            return OptionValue::find($id);
        }

        return new OptionValue;
    }

    public function test_implement_option_interface()
    {
        $this->assertInstanceOf('ANavallaSuiza\Ecommerce\Product\Models\OptionValueInterface', $this->optionValue);
    }

    public function test_should_allow_assigning_itself_to_an_option()
    {
        $option = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\Option')->makePartial();

        $this->optionValue->setOption($option);

        $this->assertEquals($option, $this->optionValue->getOption());
    }
}
