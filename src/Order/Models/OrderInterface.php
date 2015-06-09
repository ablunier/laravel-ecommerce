<?php
namespace ANavallaSuiza\Ecommerce\Order\Models;

use Illuminate\Database\Eloquent\Collection;

interface OrderInterface
{
    const STATE_CART        = 'cart';
    const STATE_CART_LOCKED = 'cart_locked';
    const STATE_PENDING     = 'pending';
    const STATE_CONFIRMED   = 'confirmed';
    const STATE_SHIPPED     = 'shipped';
    const STATE_ABANDONED   = 'abandoned';
    const STATE_CANCELLED   = 'cancelled';
    const STATE_RETURNED    = 'returned';

    /**
     * Items Eloquent Relation
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function items();

    /**
     * Get customer email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set customer email.
     *
     * @param string $email
     */
    public function setEmail($email);

    /**
     * Has the order been completed by user and can be handled.
     *
     * @return Boolean
     */
    public function isCompleted();

    /**
     * Mark the order as completed.
     */
    public function complete();

    /**
     * Return completion date.
     *
     * @return \DateTime
     */
    public function getCompletedAt();

    /**
     * Set completion time.
     *
     * @param null|\DateTime $completedAt
     */
    public function setCompletedAt(\DateTime $completedAt = null);

    /**
     * Get order items.
     *
     * @return Collection|OrderItemInterface[] An array or collection of OrderItemInterface
     */
    public function getItems();

    /**
     * Set items.
     *
     * @param Collection|OrderItemInterface[] $items
     */
    public function setItems(Collection $items);

    /**
     * Returns number of order items.
     *
     * @return integer
     */
    public function countItems();

    /**
     * Clears all items in cart.
     */
    public function clearItems();

    /**
     * Adds item to order.
     *
     * @param OrderItemInterface $item
     */
    public function addItem(OrderItemInterface $item);

    /**
     * Remove item from order.
     *
     * @param OrderItemInterface $item
     */
    public function removeItem(OrderItemInterface $item);

    /**
     * Has item in order?
     *
     * @param OrderItemInterface $item
     *
     * @return Boolean
     */
    public function hasItem(OrderItemInterface $item);

    /**
     * Checks whether the cart is empty or not.
     *
     * @return Boolean
     */
    public function isEmpty();

    /**
     * Get items total.
     *
     * @return integer
     */
    public function getItemsTotal();

    /**
     * Calculate items total based on the items
     * unit prices and quantities.
     */
    public function calculateItemsTotal();

    /**
     * Get order total.
     *
     * @return integer
     */
    public function getTotal();

    /**
     * Set total.
     *
     * @param integer $total
     */
    public function setTotal($total);

    /**
     * Calculate total.
     * Items total + Adjustments total.
     */
    public function calculateTotal();

    /**
     * Returns total quantity of items in cart.
     *
     * @return integer
     */
    public function getTotalQuantity();

    /**
     * Get order state.
     *
     * @return string
     */
    public function getState();

    /**
     * Set order state.
     *
     * @param string $state
     */
    public function setState($state);
}
