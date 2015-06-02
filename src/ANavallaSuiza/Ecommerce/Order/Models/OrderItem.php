<?php
namespace ANavallaSuiza\Ecommerce\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model implements OrderItemInterface
{
    public $timestamps = false;

    /**
     * {@inheritdoc}
     */
    public function order()
    {
        return $this->belongsTo('ANavallaSuiza\Ecommerce\Order\Order');
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getUnitPrice()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setUnitPrice($unitPrice)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getTotal()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function setTotal($total)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function calculateTotal()
    {

    }
}
