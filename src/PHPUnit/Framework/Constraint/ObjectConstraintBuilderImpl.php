<?php


namespace Hshn\PHPUnit\Framework\Constraint;


use Hshn\PHPUnit\Framework\Constraint\ObjectConstraint\PropertyConstraintBuilder;
use \PHPUnit_Framework_Assert as Assert;

class ObjectConstraintBuilderImpl implements ObjectConstraintBuilder
{
    /**
     * @var \PHPUnit_Framework_Constraint
     */
    private $constraint;

    /**
     * ObjectConstraintBuilder constructor.
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->constraint = new \PHPUnit_Framework_Constraint_IsInstanceOf($className);
    }

    /**
     * @param string $name
     * @return PropertyConstraintBuilder
     */
    public function property(string $name)
    {
        return new PropertyConstraintBuilder($name, $this);
    }

    /**
     * @param string $property
     * @param \PHPUnit_Framework_Constraint $constraint
     * @return ObjectConstraintBuilderImpl
     */
    public function addPropertyConstraint(string $property, \PHPUnit_Framework_Constraint $constraint)
    {
        $this->constraint = Assert::logicalAnd(
            $this->constraint,
            new Property($constraint, $property)
        );

        return $this;
    }

    /**
     * @return \PHPUnit_Framework_Constraint
     */
    public function get()
    {
        return $this->constraint;
    }
}
