<?php
namespace ANavallaSuiza\Ecommerce\Cart\Context;

use ANavallaSuiza\Ecommerce\Cart\Models\CartInterface;
use ANavallaSuiza\Ecommerce\Cart\Storage\StorageInterface;

class CartContext implements CartContextInterface
{
    /**
     * Cart storage.
     *
     */
    protected $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentCart()
    {
        return $this->storage->getData(self::STORAGE_KEY);
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrentCart(CartInterface $cart)
    {
        $this->storage->setData(self::STORAGE_KEY, $cart);
    }

    /**
     * {@inheritdoc}
     */
    public function resetCurrentCart()
    {
        $this->storage->removeData(self::STORAGE_KEY);
    }
}
