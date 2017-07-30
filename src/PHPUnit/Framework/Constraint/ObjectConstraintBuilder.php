<?php

namespace Hshn\PHPUnit\Framework\Constraint;

use Hshn\PHPUnit\Framework\Constraint\ObjectConstraint\PropertyConstraintBuilder;

interface ObjectConstraintBuilder
{
    /**
     * @param string $name
     * @return PropertyConstraintBuilder
     */
    public function property(string $name);

    /**
     * @return \PHPUnit_Framework_Constraint
     */
    public function get();
}
