<?php
namespace ANavallaSuiza\Ecommerce\Cart\Resolvers;

interface ItemResolverInterface
{
    /**
     * Returns item that will be added into the cart.
     *
     * @param int $id Item id
     * @param int $quantity Item quantity
     *
     * @return CartItemInterface
     *
     * @throws ItemResolvingException
     */
    public function resolve($id, $quantity);
}