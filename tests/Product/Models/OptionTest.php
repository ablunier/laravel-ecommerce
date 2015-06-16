<?php
namespace ANavallaSuiza\Tests\Product\Models;

use ANavallaSuiza\Tests\TestBase;
use Mockery;
use ANavallaSuiza\Ecommerce\Product\Models\Option;

class OptionTest extends TestBase
{
    protected $option;

    public function setUp()
    {
        parent::setUp();

        $this->option = $this->getInstance();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    private function getInstance($id = null)
    {
        if (isset($id)) {
            return Option::find($id);
        }

        return new Option;
    }

    public function test_implement_option_value_interface()
    {
        $this->assertInstanceOf('ANavallaSuiza\Ecommerce\Product\Models\OptionInterface', $this->option);
    }

    public function test_should_initialize_values_collection_by_default()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->option->getValues());
    }

    public function test_adds_removes_value()
    {
        $value = Mockery::mock('ANavallaSuiza\Ecommerce\Product\Models\OptionValue');
        $value->shouldReceive('setOption')->once()->with($this->option);
        $value->shouldReceive('getKey')->andReturn(1);

        $this->option->addValue($value);

        $this->assertTrue($this->option->hasValue($value));

        $this->option->removeValue($value);

        $this->assertFalse($this->option->hasValue($value));
    }
}
