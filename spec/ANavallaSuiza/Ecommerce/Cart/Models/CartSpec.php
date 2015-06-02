<?php

namespace spec\ANavallaSuiza\Ecommerce\Cart\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CartSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('ANavallaSuiza\Ecommerce\Cart\Models\Cart');
    }

    function it_implements_cart_interface()
    {
        $this->shouldImplement('ANavallaSuiza\Ecommerce\Cart\Models\CartInterface');
    }

    function it_extends_order()
    {
        $this->shouldBeAnInstanceOf('ANavallaSuiza\Ecommerce\Order\Models\Order');
    }

    function it_is_not_expired_by_default()
    {
        $this->shouldNotBeExpired();
    }

    function it_is_not_expired_if_the_expiration_time_is_in_future()
    {
        $expiresAt = new \DateTime('tomorrow');
        $this->setExpiresAt($expiresAt);

        $this->shouldNotBeExpired();
    }

    function it_is_expired_if_the_expiration_time_is_in_past()
    {
        $expiresAt = new \DateTime('-1 hour');
        $this->setExpiresAt($expiresAt);

        $this->shouldBeExpired();
    }
}
