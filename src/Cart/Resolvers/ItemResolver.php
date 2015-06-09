<?php
namespace ANavallaSuiza\Ecommerce\Cart\Resolvers;

use ANavallaSuiza\Ecommerce\Product\Models\ProductInterface;
use ANavallaSuiza\Ecommerce\Cart\Models\CartItem;

class ItemResolver implements ItemResolverInterface
{
    protected $productModel;

    public function __construct(ProductInterface $product)
    {
        $this->productModel = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($id, $quantity)
    {
        $product = $this->productModel->findOrFail($id);

        $cartItem = new CartItem;

        $cartItem->product()->associate($product);
        $cartItem->setQuantity($quantity);

        return $cartItem;
    }
}
