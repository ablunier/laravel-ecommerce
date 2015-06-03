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
        return $this->quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * {@inheritdoc}
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unit_price = $unitPrice;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function calculateTotal()
    {

    }
}
