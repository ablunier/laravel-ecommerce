<?php
namespace ANavallaSuiza\Ecommerce\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model implements OrderInterface
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    protected $dates = ['deleted_at', 'completed_at'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->state = OrderInterface::STATE_CART;
        $this->items = new Collection();
    }

    /**
     * {@inheritdoc}
     */
    public function items()
    {
        return $this->hasMany('ANavallaSuiza\Ecommerce\Order\Models\OrderItem');
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isCompleted()
    {
        return null !== $this->completed_at;
    }

    /**
     * {@inheritdoc}
     */
    public function complete()
    {
        $this->completed_at = new \DateTime();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCompletedAt()
    {
        return $this->completed_at;
    }

    /**
     * {@inheritdoc}
     */
    public function setCompletedAt(\DateTime $completedAt = null)
    {
        $this->completed_at = $completedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function setItems(Collection $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function countItems()
    {
        return $this->items->count();
    }

    /**
     * {@inheritdoc}
     */
    public function clearItems()
    {
        // $this->items->clear(); ??

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(OrderItemInterface $item)
    {
        if ($this->hasItem($item)) {
            return $this;
        }

        $this->items->push($item);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(OrderItemInterface $item)
    {
        if ($this->hasItem($item)) {
            // $this->items->forget($item); ??
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasItem(OrderItemInterface $item)
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getItemsTotal()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function calculateItemsTotal()
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

    /**
     * {@inheritdoc}
     */
    public function getTotalQuantity()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }
}
