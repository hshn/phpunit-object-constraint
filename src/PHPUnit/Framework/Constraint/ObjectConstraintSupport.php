<?php


namespace Hshn\PHPUnit\Framework\Constraint;


use PHPUnit_Framework_Constraint;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

trait ObjectConstraintSupport
{
    /**
     * @param PHPUnit_Framework_Constraint $constraint
     * @param string $property
     * @param PropertyAccessorInterface|null $propertyAccessor
     *
     * @return Property
     */
    static protected function property(PHPUnit_Framework_Constraint $constraint, string $property, PropertyAccessorInterface $propertyAccessor = null)
    {
        return new Property($constraint, $property, $propertyAccessor);
    }

    /**
     * @param $class
     * @return ObjectConstraintBuilder
     */
    static protected function constraintFor($class)
    {
        return new ObjectConstraintBuilderImpl($class);
    }
}
