<?php
namespace ANavallaSuiza\Ecommerce\Inventory\Models;

interface StockableInterface
{
    /**
     * Get stock keeping unit.
     *
     * @return mixed
     */
    public function getSku();

    /**
     * Get inventory displayed name.
     *
     * @return string
     */
    public function getInventoryName();

    /**
     * Simply checks if there any stock available.
     * It should also return true for items available on demand.
     *
     * @return Boolean
     */
    public function isInStock();

    /**
     * Is stockable available on demand?
     *
     * @return Boolean
     */
    public function isAvailableOnDemand();

    /**
     * Get stock on hold.
     *
     * @return integer
     */
    public function getOnHold();

    /**
     * Set stock on hold.
     *
     * @param integer
     */
    public function setOnHold($onHold);

    /**
     * Get stock on hand.
     *
     * @return integer
     */
    public function getOnHand();

    /**
     * Set stock on hand.
     *
     * @param integer $onHand
     */
    public function setOnHand($onHand);
}
