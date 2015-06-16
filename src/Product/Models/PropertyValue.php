<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyValue extends Model implements PropertyValueInterface
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_properties_values';

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('ANavallaSuiza\Ecommerce\Product\Models\Product');
    }

    public function property()
    {
        return $this->belongsTo('ANavallaSuiza\Ecommerce\Product\Models\Property');
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
    public function setSubject(PropertySubjectInterface $subject)
    {
        $this->product()->associate($subject);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * {@inheritdoc}
     */
    public function setProperty(PropertyInterface $property)
    {
        $this->property()->associate($property);
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
