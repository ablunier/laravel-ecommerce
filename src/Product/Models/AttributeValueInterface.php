<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

interface AttributeValueInterface
{
    /**
     * Get subject.
     *
     * @return AttributeSubjectInterface
     */
    public function getSubject();

    /**
     * Set subject.
     *
     * @param AttributeSubjectInterface|null $subject
     */
    public function setSubject(AttributeSubjectInterface $subject);

    /**
     * Get attribute.
     *
     * @return AttributeInterface
     */
    public function getAttribute();

    /**
     * Set attribute.
     *
     * @param AttributeInterface $attribute
     */
    public function setAttribute(AttributeInterface $attribute);

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
