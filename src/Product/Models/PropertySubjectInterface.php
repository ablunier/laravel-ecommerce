<?php
namespace ANavallaSuiza\Ecommerce\Product\Models;

use Illuminate\Database\Eloquent\Collection;

interface PropertySubjectInterface
{
    /**
     * Returns all properties of the subject.
     *
     * @return Collection|PropertyValueInterface[]
     */
    public function getProperties();

    /**
     * Sets all properties of the subject.
     *
     * @param Collection $properties Array of PropertyValueInterface
     */
    public function setProperties(Collection $properties);

    /**
     * Adds an property to the subject.
     *
     * @param PropertyValueInterface $property
     */
    public function addProperty(PropertyValueInterface $property);

    /**
     * Removes an property from the subject.
     *
     * @param PropertyValueInterface $property
     */
    public function removeProperty(PropertyValueInterface $property);

    /**
     * Checks whether the subject has a given property.
     *
     * @param PropertyValueInterface $property
     *
     * @return Boolean
     */
    public function hasProperty(PropertyValueInterface $property);

    /**
     * Checks whether the subject has a given property, access by name.
     *
     * @param string $propertyName
     *
     * @return Boolean
     */
    public function hasPropertyByName($propertyName);

    /**
     * Returns an property of the subject by its name.
     *
     * @param string $propertyName
     *
     * @return PropertyValueInterface
     */
    public function getPropertyByName($propertyName);
}
