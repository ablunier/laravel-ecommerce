<?php
namespace ANavallaSuiza\Ecommerce\Order\Models;

interface OrderItemInterface
{
    /**
     * Order Eloquent Relation
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function order();

    /**
     * Get item quantity.
     *
     * @return int
     */
    public function getQuantity();

    /**
     * Set quantity.
     *
     * @param int $quantity
     */
    public function setQuantity($quantity);

    /**
     * Get unit price of item.
     *
     * @return int
     */
    public function getUnitPrice();

    /**
     * Define the unit price of item.
     *
     * @param int $unitPrice
     */
    public function setUnitPrice($unitPrice);

    /**
     * Get item total.
     *
     * @return int
     */
    public function getTotal();

    /**
     * Set item total.
     *
     * @param int $total
     */
    public function setTotal($total);

    /**
     * Calculate total based on quantity and unit price.
     * Take adjustments into account.
     */
    public function calculateTotal();
}
