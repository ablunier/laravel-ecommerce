<?php

namespace spec\ANavallaSuiza\Ecommerce\Cart\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CartItemSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ANavallaSuiza\Ecommerce\Cart\Models\CartItem');
    }

    function it_implements_cart_item_interface()
    {
        $this->shouldImplement('ANavallaSuiza\Ecommerce\Cart\Models\CartItemInterface');
    }

    function it_extends_order_item()
    {
        $this->shouldHaveType('ANavallaSuiza\Ecommerce\Order\Models\OrderItem');
    }
}
