<?php

namespace Hshn\PHPUnit\Framework\Constraint;

class PropertyTest extends \PHPUnit_Framework_TestCase
{
    use ObjectConstraintSupport;

    public function testSuccess()
    {
        self::assertThat($this, self::property(self::equalTo('bar'), 'foo'));
        self::assertThat($this, self::property(self::stringEndsWith('r'), 'foo'));
    }

    /**
     * @expectedException \PHPUnit_Framework_ExpectationFailedException
     * @expectedExceptionMessage Failed asserting that property
     */
    public function testFailure()
    {
        self::assertThat($this, self::property(self::equalTo('wrong'), 'foo'));
    }

    /**
     * @expectedException \PHPUnit_Framework_ExpectationFailedException
     * @expectedExceptionMessage Neither the property "wrongProperty" nor
     */
    public function testInvalidProperty()
    {
        self::assertThat($this, self::property(self::equalTo('bar'), 'wrongProperty'));
    }

    /**
     * @return string
     */
    public function getFoo()
    {
        return 'bar';
    }

    /**
     * @return string
     */
    public function getBar()
    {
        return 'baz';
    }
}
