# phpunit-object-constraint

PHPUnit helper for explicit object comparison.

Make it easier to your apps more safety by providing easy object assertion. 

## How to use

### 1. Import helper trait into your class

```php

use Hshn\PHPUnit\Framework\Constraint\ObjectConstraintSupport;

class MyTest extends \PHPUnit_Framework_TestCase 
{
    use ObjectConstraintSupport;
}
```

### 2. Build your object constraint using constraint builder

```php

public function test1()
{
    // this constraint means: 
    //      property 'foo' start with 'a' and end with 'e'
    //  and property 'bar' is true 
    $constraint = $this->constraintFor(\stdClass::class)
        ->property('foo')
            ->stringStartsWith('a')
            ->stringEndsWith('e')
        ->property('bar')
            ->isTrue()
        ->getConstraint();
}
```

### 3. Assert any value with the constraint you built

```php
self::assertThat($value, $constraint);
```


