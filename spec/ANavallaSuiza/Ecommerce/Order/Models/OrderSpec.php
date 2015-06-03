<?php

namespace spec\ANavallaSuiza\Ecommerce\Order\Models;

use ANavallaSuiza\PhpSpec\Eloquent\ModelBehavior;
use Prophecy\Argument;
use ANavallaSuiza\Ecommerce\Order\Models\OrderItemInterface;

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

    function it_is_completed_when_completion_date_is_set()
    {
        $this->shouldNotBeCompleted();

        $this->setCompletedAt(new \DateTime('2 days ago'));
        $this->shouldBeCompleted();
    }

    function it_has_no_completion_date_by_default()
    {
        $this->getCompletedAt()->shouldReturn(null);
    }

    function it_creates_items_collection_by_default()
    {
        $this->getItems()->shouldHaveType('Illuminate\Database\Eloquent\Collection');
    }

    function it_adds_items_properly(OrderItemInterface $item)
    {
        $this->hasItem($item)->shouldReturn(false);

        $this->addItem($item);

        $this->hasItem($item)->shouldReturn(true);
    }

    function it_removes_items_properly(OrderItemInterface $item)
    {
        $this->hasItem($item)->shouldReturn(false);

        $this->addItem($item);
        $this->hasItem($item)->shouldReturn(true);

        $this->removeItem($item);
        $this->hasItem($item)->shouldReturn(false);
    }

}
