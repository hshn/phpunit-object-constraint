<?php

namespace PHPUnit\Framework\Constraint;

use Hshn\PHPUnit\Framework\Constraint\ObjectConstraintSupport;

class ObjectConstraintBuilderImplTest extends \PHPUnit_Framework_TestCase
{
    use ObjectConstraintSupport;

    /**
     * @dataProvider provideIsAnythingSuccessTests
     * @param \stdClass $data
     */
    public function testIsAnythingSuccess(\stdClass $data)
    {
        $constraint = $this->constraintFor(\stdClass::class)
            ->property('foo')
                ->isAnything()
            ->getConstraint();

        self::assertThat($data, $constraint);
    }

    /**
     * @return array
     */
    public function provideIsAnythingSuccessTests()
    {
        return [
            [self::stdClass(['foo' => rand()])],
            [self::stdClass(['foo' => null])],
        ];
    }

    /**
     * @dataProvider provideIsAnythingFailureTests
     *
     * @param \stdClass $data
     */
    public function testIsAnythingFailure(\stdClass $data)
    {
        $constraint = $this->constraintFor(\stdClass::class)
            ->property('foo')
                ->isAnything()
            ->getConstraint();

        self::assertThat($data, self::logicalNot($constraint));
    }

    /**
     * @return array
     */
    public function provideIsAnythingFailureTests()
    {
        return [
            [self::stdClass(['bar' => null])],
        ];
    }

    /**
     * @dataProvider provideIsTrueSuccessTests
     * @param \stdClass $data
     */
    public function testIsTrueSuccess(\stdClass $data)
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isTrue()
            ->getConstraint();

        self::assertThat($data, $constraint);
    }

    public function provideIsTrueSuccessTests()
    {
        return [
            [self::stdClass(['foo' => true])]
        ];
    }
    /**
     * @dataProvider provideIsTrueFailureTests
     * @param \stdClass $data
     */
    public function testIsTrueFailure(\stdClass $data)
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isTrue()
            ->getConstraint();

        self::assertThat($data, self::logicalNot($constraint));
    }

    /**
     * @return array
     */
    public function provideIsTrueFailureTests()
    {
        return [
            [self::stdClass(['foo' => false])],
            [self::stdClass(['bar' => true])],
        ];
    }

    /**
     * @dataProvider provideIsFalseSuccessTests
     * @param \stdClass $data
     */
    public function testIsFalseSuccess(\stdClass $data)
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isFalse()
            ->getConstraint();

        self::assertThat($data, $constraint);
    }

    public function provideIsFalseSuccessTests()
    {
        return [
            [self::stdClass(['foo' => false])]
        ];
    }
    /**
     * @dataProvider provideIsFalseFailureTests
     * @param \stdClass $data
     */
    public function testIsFalseFailure(\stdClass $data)
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isFalse()
            ->getConstraint();

        self::assertThat($data, self::logicalNot($constraint));
    }

    /**
     * @return array
     */
    public function provideIsFalseFailureTests()
    {
        return [
            [self::stdClass(['foo' => true])],
            [self::stdClass(['bar' => false])],
        ];
    }

    /**
     * @test
     */
    public function testCallback()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->callback(function ($v) {
                    return $v === 'valid';
                })
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 'valid']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'invalid']), self::logicalNot($constraint));
        self::assertThat(self::stdClass(['bar' => 'valid']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsJson()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isJson()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => json_encode(['foo' => 'bar'])]), $constraint);
        self::assertThat(self::stdClass(['foo' => 'text']), self::logicalNot($constraint));
        self::assertThat(self::stdClass(['bar' => json_encode(['foo' => 'bar'])]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsNull()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isNull()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => null]), $constraint);
        self::assertThat(self::stdClass(['bar' => null]), self::logicalNot($constraint));
        self::assertThat(self::stdClass(['bar' => 1]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsFinite()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isFinite()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 1]), $constraint);
        self::assertThat(self::stdClass(['foo' => log(0)]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsInfinite()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isInfinite()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => log(0)]), $constraint);
        self::assertThat(self::stdClass(['foo' => 1]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsNan()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isNan()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => acos(8)]), $constraint);
        self::assertThat(self::stdClass(['foo' => 1]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testContains()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->contains('bar')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => ['foo', 'bar', 'baz']]), $constraint);
        self::assertThat(self::stdClass(['foo' => ['foo', 'baz']]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testContainsOnly()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->containsOnly('string')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => ['bar']]), $constraint);
        self::assertThat(self::stdClass(['foo' => ['bar', 1]]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testContainsOnlyInstancesOf()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->containsOnlyInstancesOf(\stdClass::class)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => [new \stdClass(), new \stdClass()]]), $constraint);
        self::assertThat(self::stdClass(['foo' => ['foo', 'baz']]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testArrayHasKey()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->arrayHasKey('bar')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => new \ArrayObject(['bar' => null])]), $constraint);
        self::assertThat(self::stdClass(['foo' => new \ArrayObject(['baz' => null])]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testEqualTo()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->equalTo('bar')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 'bar']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'baz']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIs()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->is(self::equalTo('bar'))
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 'bar']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'baz']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsEmpty()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isEmpty()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => '']), $constraint);
        self::assertThat(self::stdClass(['foo' => '1']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsWritable()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isWritable()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => __FILE__]), $constraint);
        self::assertThat(self::stdClass(['foo' => 'baz']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsReadable()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isReadable()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => __FILE__]), $constraint);
        self::assertThat(self::stdClass(['foo' => 'baz']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testDirectoryExists()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->directoryExists()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => __DIR__]), $constraint);
        self::assertThat(self::stdClass(['foo' => 'baz']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testFileExists()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->fileExists()
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => __FILE__]), $constraint);
        self::assertThat(self::stdClass(['foo' => 'baz']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testGreaterThan()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->greaterThan(1)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 2]), $constraint);
        self::assertThat(self::stdClass(['foo' => 1]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testGreaterThanOrEqual()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->greaterThanOrEqual(1)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 1]), $constraint);
        self::assertThat(self::stdClass(['foo' => 0]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIdenticalTo()
    {
        $v = new \stdClass();

        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->identicalTo($v)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => $v]), $constraint);
        self::assertThat(self::stdClass(['foo' => new \stdClass()]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsInstanceOf()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isInstanceOf(\stdClass::class)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => new \stdClass()]), $constraint);
        self::assertThat(self::stdClass(['foo' => $this]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testIsType()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->isType('string')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => '1']), $constraint);
        self::assertThat(self::stdClass(['foo' => 1]), self::logicalNot($constraint));
    }


    /**
     * @test
     */
    public function testLessThan()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->lessThan(1)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 0]), $constraint);
        self::assertThat(self::stdClass(['foo' => 1]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testLessThanOrEqual()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->lessThanOrEqual(1)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 1]), $constraint);
        self::assertThat(self::stdClass(['foo' => 2]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testMatchesRegularExpression()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->matchesRegularExpression('/\d+/')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => '0']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'a']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testMatches()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->matches('%i')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => '1234']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'abcd']), self::logicalNot($constraint));

    }

    /**
     * @test
     */
    public function testStringStartsWith()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->stringStartsWith('a')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 'abc']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'def']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testStringContains()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->stringContains('a')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 'bac']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'edf']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testStringEndsWith()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->stringEndsWith('a')
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => 'cba']), $constraint);
        self::assertThat(self::stdClass(['foo' => 'fed']), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testCountOf()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->countOf(2)
            ->getConstraint();

        self::assertThat(self::stdClass(['foo' => new \ArrayObject([1, 2])]), $constraint);
        self::assertThat(self::stdClass(['foo' => new \ArrayObject([1])]), self::logicalNot($constraint));
    }

    /**
     * @test
     */
    public function testSuccessWithObjectConstraintBuilder()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->equalTo('bar')
            ->property('bar')
                ->stringStartsWith('ba')
                ->stringEndsWith('az')
            ->getConstraint();

        self::assertThat($this->stdClass(['foo' => 'bar', 'bar' => 'baaz']), $constraint);
    }

    /**
     * @test
     * @expectedException \PHPUnit_Framework_ExpectationFailedException
     */
    public function testFailureWithObjectConstraintBuilder()
    {
        $constraint = self::constraintFor(\stdClass::class)
            ->property('foo')
                ->equalTo('bar')
            ->property('bar')
                ->stringStartsWith('ba')
                ->stringEndsWith('az')
            ->getConstraint();

        self::assertThat($this->stdClass(['foo' => 'bar', 'bar' => 'boz']), $constraint);
    }

    /**
     * @param array $data
     * @return \stdClass
     */
    private static function stdClass(array $data)
    {
        return self::assignProps(new \stdClass(), $data);
    }

    /**
     * @param \stdClass $data
     * @param array $props
     * @return \stdClass
     */
    private static function assignProps(\stdClass $data, array $props)
    {
        foreach ($props as $key => $value) {
            $data->$key = is_array($value)
                ? self::assignProps(new \stdClass(), $value)
                : $value;
        }

        return $data;
    }
}
