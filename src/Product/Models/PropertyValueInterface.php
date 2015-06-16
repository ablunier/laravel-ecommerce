<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

interface PropertyValueInterface
{
    /**
     * Get element key.
     *
     * @return mixed
     */
    public function getKey();

    /**
     * Get subject.
     *
     * @return PropertySubjectInterface
     */
    public function getSubject();

    /**
     * Set subject.
     *
     * @param PropertySubjectInterface|null $subject
     */
    public function setSubject(PropertySubjectInterface $subject);

    /**
     * Get attribute.
     *
     * @return PropertyInterface
     */
    public function getProperty();

    /**
     * Set attribute.
     *
     * @param PropertyInterface $attribute
     */
    public function setProperty(PropertyInterface $attribute);

    /**
     * Get attribute value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Set attribute value.
     *
     * @param mixed $value
     */
    public function setValue($value);
}
