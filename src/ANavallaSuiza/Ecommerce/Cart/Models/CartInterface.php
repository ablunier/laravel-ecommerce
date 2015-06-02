<?php
namespace ANavallaSuiza\Ecommerce\Cart\Models;

use ANavallaSuiza\Ecommerce\Order\Models\OrderInterface;

interface CartInterface extends OrderInterface
{
    /**
     * Get the identifier.
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Gets expiration time.
     *
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * Sets expiration time.
     *
     * @param \DateTime|null $expiresAt
     */
    public function setExpiresAt(\DateTime $expiresAt = null);

    /**
     * Bumps the expiration time.
     * Default is +3 hours.
     */
    public function incrementExpiresAt();

    /**
     * Checks whether the cart is expired or not.
     *
     * @return Boolean
     */
    public function isExpired();
}
