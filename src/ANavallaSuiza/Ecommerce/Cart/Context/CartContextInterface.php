<?php
namespace ANavallaSuiza\Ecommerce\Cart\Context;

use ANavallaSuiza\Ecommerce\Cart\Models\CartInterface;

interface CartContextInterface
{
    const STORAGE_KEY = '_ans_cart';

    /**
     * Get the currently active cart.
     *
     * @return string
     */
    public function getCurrentCart();

    /**
     * Set the currently active cart.
     *
     * @param CartInterface $cart
     */
    public function setCurrentCart(CartInterface $cart);

    /**
     * Resets current cart identifier.
     * Basically, it means abandoning current cart.
     */
    public function resetCurrentCart();
}
