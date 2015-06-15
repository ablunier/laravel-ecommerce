<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model implements AttributeValueInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_attributes_values';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('ANavallaSuiza\Ecommerce\Product\Models\Product');
    }

    public function attribute()
    {
        return $this->belongsTo('ANavallaSuiza\Ecommerce\Product\Models\Attribute');
    }

    /**
     * {@inheritdoc}
     */
    public function getSubject()
    {
        return $this->product;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubject(AttributeSubjectInterface $subject)
    {
        $this->product()->associate($subject);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute(AttributeInterface $attribute)
    {
        $this->attribute()->associate($attribute);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
