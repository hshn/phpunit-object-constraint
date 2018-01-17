<?php


namespace Hshn\PHPUnit\Framework\Constraint\ObjectConstraint;


use Hshn\PHPUnit\Framework\Constraint\ObjectConstraintBuilderImpl;
use PHPUnit_Framework_Assert as Assert;

class PropertyConstraintBuilder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ObjectConstraintBuilderImpl
     */
    private $parent;

    /**
     * @var \PHPUnit_Framework_Constraint[]
     */
    private $constraints = [];

    /**
     * PropertyConstraintBuilder constructor.
     * @param string $name
     * @param ObjectConstraintBuilderImpl $parent
     */
    public function __construct($name, ObjectConstraintBuilderImpl $parent)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isAnything()
    {
        return $this->is(Assert::anything());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isTrue()
    {
        return $this->is(Assert::isTrue());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isFalse()
    {
        return $this->is(Assert::isFalse());
    }

    /**
     * @param $callback
     * @return PropertyConstraintBuilder
     */
    public function callback($callback)
    {
        return $this->is(Assert::callback($callback));
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isJson()
    {
        return $this->is(Assert::isJson());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isNull()
    {
        return $this->is(Assert::isNull());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isFinite()
    {
        return $this->is(Assert::isFinite());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isInfinite()
    {
        return $this->is(Assert::isInfinite());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isNan()
    {
        return $this->is(Assert::isNan());
    }

    /**
     * @param $value
     * @param bool $checkForObjectIdentity
     * @param bool $checkForNonObjectIdentity
     * @return PropertyConstraintBuilder
     */
    public function contains($value, $checkForObjectIdentity = true, $checkForNonObjectIdentity = false)
    {
        return $this->is(Assert::contains($value, $checkForObjectIdentity, $checkForNonObjectIdentity));
    }

    /**
     * @param $type
     * @return PropertyConstraintBuilder
     */
    public function containsOnly($type)
    {
        return $this->is(Assert::containsOnly($type));
    }

    /**
     * @param $className
     * @return PropertyConstraintBuilder
     */
    public function containsOnlyInstancesOf($className)
    {
        return $this->is(Assert::containsOnlyInstancesOf($className));
    }

    /**
     * @param $key
     * @return PropertyConstraintBuilder
     */
    public function arrayHasKey($key)
    {
        return $this->is(Assert::arrayHasKey($key));
    }

    /**
     * /**
     * @param mixed $value
     * @param float $delta
     * @param int $maxDepth
     * @param bool $canonicalize
     * @param bool $ignoreCase
     * @return $this
     */
    public function equalTo($value, $delta = 0.0, $maxDepth = 10, $canonicalize = false, $ignoreCase = false)
    {
        return $this->is(Assert::equalTo($value, $delta, $maxDepth, $canonicalize, $ignoreCase));
    }

    /**
     * @param \PHPUnit_Framework_Constraint $constraint
     * @return $this
     */
    public function is(\PHPUnit_Framework_Constraint $constraint)
    {
        $this->constraints[] = $constraint;

        return $this;
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isEmpty()
    {
        return $this->is(Assert::isEmpty());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isWritable()
    {
        return $this->is(Assert::isWritable());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function isReadable()
    {
        return $this->is(Assert::isReadable());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function directoryExists()
    {
        return $this->is(Assert::directoryExists());
    }

    /**
     * @return PropertyConstraintBuilder
     */
    public function fileExists()
    {
        return $this->is(Assert::fileExists());
    }

    /**
     * @param $value
     * @return PropertyConstraintBuilder
     */
    public function greaterThan($value)
    {
        return $this->is(Assert::greaterThan($value));
    }

    /**
     * @param $value
     * @return PropertyConstraintBuilder
     */
    public function greaterThanOrEqual($value)
    {
        return $this->is(Assert::logicalOr(
            Assert::equalTo($value),
            Assert::greaterThan($value)
        ));
    }

    /**
     * @param $value
     * @return PropertyConstraintBuilder
     */
    public function identicalTo($value)
    {
        return $this->is(Assert::identicalTo($value));
    }

    /**
     * @param $className
     * @return PropertyConstraintBuilder
     */
    public function isInstanceOf($className)
    {
        return $this->is(Assert::isInstanceOf($className));
    }

    /**
     * @param $type
     * @return PropertyConstraintBuilder
     */
    public function isType($type)
    {
        return $this->is(Assert::isType($type));
    }

    /**
     * @param $value
     * @return PropertyConstraintBuilder
     */
    public function lessThan($value)
    {
        return $this->is(Assert::lessThan($value));
    }

    /**
     * @param $value
     * @return PropertyConstraintBuilder
     */
    public function lessThanOrEqual($value)
    {
        return $this->is(Assert::logicalOr(
            Assert::equalTo($value),
            Assert::lessThan($value)
        ));
    }

    /**
     * @param $pattern
     * @return PropertyConstraintBuilder
     */
    public function matchesRegularExpression($pattern)
    {
        return $this->is(Assert::matchesRegularExpression($pattern));
    }

    /**
     * @param $string
     * @return PropertyConstraintBuilder
     */
    public function matches($string)
    {
        return $this->is(Assert::matches($string));
    }

    /**
     * @param $prefix
     * @return PropertyConstraintBuilder
     */
    public function stringStartsWith($prefix)
    {
        return $this->is(Assert::stringStartsWith($prefix));
    }

    /**
     * @param $string
     * @param bool $case
     * @return PropertyConstraintBuilder
     */
    public function stringContains($string, $case = true)
    {
        return $this->is(Assert::stringContains($string, $case));
    }

    /**
     * @param $suffix
     * @return PropertyConstraintBuilder
     */
    public function stringEndsWith($suffix)
    {
        return $this->is(Assert::stringEndsWith($suffix));
    }

    /**
     * @param $count
     * @return PropertyConstraintBuilder
     */
    public function countOf($count)
    {
        return $this->is(Assert::countOf($count));
    }

    /**
     * @param string $name
     * @return PropertyConstraintBuilder
     */
    public function property(string $name)
    {
        return $this->registerConstraints()->property($name);
    }

    /**
     * @return \PHPUnit_Framework_Constraint
     */
    public function getConstraint()
    {
        return $this->registerConstraints()->get();
    }

    /**
     * @return ObjectConstraintBuilderImpl
     */
    private function registerConstraints()
    {
        return $this->parent->addPropertyConstraint($this->name, call_user_func_array([Assert::class, 'logicalAnd'], $this->constraints));
    }
}
