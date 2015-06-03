<?php

namespace spec\ANavallaSuiza\Ecommerce\Order\Models;

use ANavallaSuiza\PhpSpec\Eloquent\ModelBehavior;
use Prophecy\Argument;

class OrderSpec extends ModelBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ANavallaSuiza\Ecommerce\Order\Models\Order');
    }

    function it_implements_order_interface()
    {
        $this->shouldImplement('ANavallaSuiza\Ecommerce\Order\Models\OrderInterface');
    }

    function it_is_not_completed_by_default()
    {
        $this->shouldNotBeCompleted();
    }

    function it_can_be_completed()
    {
        $this->complete();
        $this->shouldBeCompleted();
    }
}
