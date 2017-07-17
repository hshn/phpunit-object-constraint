<?php


namespace Hshn\PHPUnit\Framework\Constraint;


use PHPUnit_Framework_Constraint;
use Symfony\Component\PropertyAccess\Exception\AccessException;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;
use Symfony\Component\PropertyAccess\Exception\UnexpectedTypeException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class Property extends \PHPUnit_Framework_Constraint_Composite
{
    /**
     * @var string
     */
    private $property;

    /**
     * @var PropertyAccessorInterface
     */
    private $propertyAccessor;

    /**
     * Property constructor.
     * @param PHPUnit_Framework_Constraint $innerConstraint
     * @param string $property
     * @param PropertyAccessorInterface|null $propertyAccessor
     */
    public function __construct(PHPUnit_Framework_Constraint $innerConstraint, string $property, PropertyAccessorInterface $propertyAccessor = null)
    {
        parent::__construct($innerConstraint);

        $this->property = $property;
        $this->propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();
    }
    /**
     * @inheritdoc
     */
    public function evaluate($other, $description = '', $returnResult = false)
    {
        try {
            return parent::evaluate(
                $this->propertyAccessor->getValue($other, $this->property),
                $description,
                $returnResult
            );
        } catch (InvalidArgumentException $e) {
            if (!$returnResult) {
                $this->fail($other, $e->getMessage());
            }
        } catch (AccessException $e) {
            if (!$returnResult) {
                $this->fail($other, $e->getMessage());
            }
        } catch (UnexpectedTypeException $e) {
            if (!$returnResult) {
                $this->fail($other, $e->getMessage());
            }
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function toString()
    {
        return 'property "' . $this->property . '" ' . $this->innerConstraint->toString();
    }

    /**
     * @inheritdoc
     */
    protected function failureDescription($other)
    {
        return $this->toString();
    }
}
