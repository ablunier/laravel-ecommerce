<?php

namespace spec\ANavallaSuiza\Ecommerce\Product\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ANavallaSuiza\Ecommerce\Product\Models\Product');
    }
}
