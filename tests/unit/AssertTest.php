<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit;

use KoKoKo\assert\Assert;
use KoKoKo\assert\exceptions\ArrayKeyNotExistsException;
use KoKoKo\assert\exceptions\InvalidArrayCountException;
use KoKoKo\assert\exceptions\InvalidArrayException;
use KoKoKo\assert\exceptions\InvalidBoolException;
use KoKoKo\assert\exceptions\InvalidDigitException;
use KoKoKo\assert\exceptions\InvalidEmptyException;
use KoKoKo\assert\exceptions\InvalidFloatException;
use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidIntOrFloatOrStringException;
use KoKoKo\assert\exceptions\InvalidIntOrStringException;
use KoKoKo\assert\exceptions\InvalidNotArrayException;
use KoKoKo\assert\exceptions\InvalidNotEmptyException;
use KoKoKo\assert\exceptions\InvalidNotNullException;
use KoKoKo\assert\exceptions\InvalidNotObjectException;
use KoKoKo\assert\exceptions\InvalidNotSameValueException;
use KoKoKo\assert\exceptions\InvalidNullException;
use KoKoKo\assert\exceptions\InvalidNumericException;
use KoKoKo\assert\exceptions\InvalidRegExpPatternException;
use KoKoKo\assert\exceptions\InvalidResourceException;
use KoKoKo\assert\exceptions\InvalidSameValueException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\InvalidStringLengthException;
use KoKoKo\assert\exceptions\LengthNotBetweenException;
use KoKoKo\assert\exceptions\LengthNotGreaterException;
use KoKoKo\assert\exceptions\LengthNotLessException;
use KoKoKo\assert\exceptions\NumberNotBetweenException;
use KoKoKo\assert\exceptions\NumberNotBetweenStrictlyException;
use KoKoKo\assert\exceptions\NumberNotGreaterException;
use KoKoKo\assert\exceptions\NumberNotGreaterStrictlyException;
use KoKoKo\assert\exceptions\NumberNotLessException;
use KoKoKo\assert\exceptions\NumberNotLessStrictlyException;
use KoKoKo\assert\exceptions\NumberNotNegativeException;
use KoKoKo\assert\exceptions\NumberNotPositiveException;
use KoKoKo\assert\exceptions\StringNotMatchGlobException;
use KoKoKo\assert\exceptions\StringNotMatchRegExpException;
use KoKoKo\assert\exceptions\ValueNotInArrayException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class AssertTest extends BaseUnitTestCase
{
    public function testAssert()
    {
        $fixtures = $this->getTypeFixturesWithout([self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            Assert::assert($fixture);
        }
    }

    public function testAssertWithInvalidTypeFixturesForValueArgument()
    {
        $name            = 'value';
        $fixture         = $this->getTypeFixture(self::OBJECT_FIXTURE);
        $expectedMessage = (new InvalidNotObjectException($name))->getMessage();

        try {
            Assert::assert($fixture, $name);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotObjectException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testAssertWithInvalidTypeFixturesForNameArgument()
    {
        $name     = 'name';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert('var', $fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testForList()
    {
        Assert::assert([1, 2, 3])->forList(
            function (Assert $assert) {
                $assert->int();
            }
        );
    }

    public function testForListWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::ARRAY_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidArrayException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->forList(
                    function (Assert $assert) {
                    }
                );

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testForListWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $keyName  = 'variable[0]';
        $fixtures = ['a'];

        $expectedMessage = (new InvalidIntException($keyName, $fixtures[0]))->getMessage();

        try {
            Assert::assert($fixtures, $name)->forList(
                function (Assert $assert) {
                    $assert->int();
                }
            );

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidIntException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testForListWithEmptyValueFixtures()
    {
        /** @noinspection PhpUnusedParameterInspection */
        Assert::assert([], 'value')->forList(
            function (Assert $assert) {
                $this->fail('Func must be not called');
            }
        );
    }

    public function testForMap()
    {
        Assert::assert([1, 2, 3])->forMap(
            function (Assert $keyAssert, Assert $valueAssert) {
                $keyAssert->int();
                $valueAssert->int();

                $this->assertNotSame($keyAssert->get(), $valueAssert->get());
            }
        );
    }

    public function testForMapWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::ARRAY_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidArrayException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->forMap(
                    function (Assert $keyAssert, Assert $valueAssert) {
                    }
                );

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testForMapWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $keyName  = "variable['a']";
        $fixtures = ['a' => 'b'];

        $expectedMessage = (new InvalidIntException($keyName, $fixtures['a']))->getMessage();

        try {
            Assert::assert($fixtures, $name)->forMap(
                function (Assert $keyAssert, Assert $valueAssert) {
                    $keyAssert->string();
                    $valueAssert->int();
                }
            );

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidIntException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testForMapWithInvalidKeyValueFixtures()
    {
        $name     = 'variable';
        $keyName  = "variable: key 'a'";
        $fixtures = ['a' => 'b'];

        $expectedMessage = (new InvalidIntException($keyName, $fixtures['a']))->getMessage();

        try {
            Assert::assert($fixtures, $name)->forMap(
                function (Assert $keyAssert, Assert $valueAssert) {
                    $keyAssert->int();
                    $valueAssert->string();
                }
            );

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidIntException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testForMapWithEmptyValueFixtures()
    {
        /** @noinspection PhpUnusedParameterInspection */
        Assert::assert([], 'value')->forMap(
            function (Assert $assert) {
                $this->fail('Func must be not called');
            }
        );
    }

    public function testLength()
    {
        Assert::assert('ab')->length(2);
    }

    public function testLengthWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->length(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $length   = 5;
        $fixtures = ['abc', 'abcd'];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringLengthException($name, $fixture, $length))->getMessage();

            try {
                Assert::assert($fixture, $name)->length($length);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringLengthException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthWithInvalidTypeFixturesForLengthArgument()
    {
        $name     = 'length';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntException($name, $fixture))->getMessage();

            try {
                Assert::assert('abc', $name)->length($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthWithInvalidValueFixturesForLengthArgument()
    {
        $name            = 'length';
        $fixture         = -3;
        $expectedMessage = (new NumberNotPositiveException($name, $fixture))->getMessage();

        try {
            Assert::assert('abc', $name)->length($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (NumberNotPositiveException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testLengthBetween()
    {
        Assert::assert('a')->lengthBetween(1, 3);
        Assert::assert('ab')->lengthBetween(1, 3);
        Assert::assert('abc')->lengthBetween(1, 3);
    }

    public function testLengthBetweenWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->lengthBetween(1, 2);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthBetweenWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $from     = 1;
        $to       = 3;
        $fixtures = ['abcd', ''];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new LengthNotBetweenException($name, $fixture, $from, $to))->getMessage();

            try {
                Assert::assert($fixture, $name)->lengthBetween($from, $to);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (LengthNotBetweenException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthBetweenWithInvalidTypeFixturesForFromArgument()
    {
        $name     = 'from';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntException($name, $fixture))->getMessage();

            try {
                Assert::assert('abc', $name)->lengthBetween($fixture, 10);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthBetweenWithInvalidValueFixturesForFromArgument()
    {
        $name            = 'from';
        $fixture         = -1;
        $expectedMessage = (new NumberNotGreaterException($name, $fixture, 0))->getMessage();

        try {
            Assert::assert('abc', $name)->lengthBetween($fixture, 10);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (NumberNotGreaterException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testLengthBetweenWithInvalidTypeFixturesForToArgument()
    {
        $name     = 'to';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntException($name, $fixture))->getMessage();

            try {
                Assert::assert('abc', $name)->lengthBetween(0, $fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthBetweenWithInvalidValueFixturesForFromAndToArgument()
    {
        $name            = 'from';
        $from            = 10;
        $to              = 1;
        $expectedMessage = (new NumberNotLessException($name, $from, $to))->getMessage();

        try {
            Assert::assert('abc', $name)->lengthBetween($from, $to);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (NumberNotLessException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testLengthGreater()
    {
        Assert::assert('abc')->lengthGreater(2);
        Assert::assert('ab')->lengthGreater(2);
    }

    public function testLengthGreaterWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->lengthGreater(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthGreaterWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $length   = 5;
        $fixtures = ['abc', 'abcd'];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new LengthNotGreaterException($name, $fixture, $length))->getMessage();

            try {
                Assert::assert($fixture, $name)->lengthGreater($length);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (LengthNotGreaterException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthGreaterWithInvalidTypeFixturesForLengthArgument()
    {
        $name     = 'length';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntException($name, $fixture))->getMessage();

            try {
                Assert::assert('abc', $name)->lengthGreater($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthGreaterWithInvalidValueFixturesForLengthArgument()
    {
        $name            = 'length';
        $fixture         = -3;
        $expectedMessage = (new NumberNotPositiveException($name, $fixture))->getMessage();

        try {
            Assert::assert('abc', $name)->lengthGreater($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (NumberNotPositiveException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testLengthLess()
    {
        Assert::assert('ab')->lengthLess(2);
        Assert::assert('a')->lengthLess(2);
    }

    public function testLengthLessWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->lengthLess(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthLessWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $length   = 2;
        $fixtures = ['abc', 'abcde'];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new LengthNotLessException($name, $fixture, $length))->getMessage();

            try {
                Assert::assert($fixture, $name)->lengthLess($length);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (LengthNotLessException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthLessWithInvalidTypeFixturesForLengthArgument()
    {
        $name     = 'length';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntException($name, $fixture))->getMessage();

            try {
                Assert::assert('abc', $name)->lengthLess($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLengthLessWithInvalidValueFixturesForLengthArgument()
    {
        $name            = 'length';
        $fixture         = -3;
        $expectedMessage = (new NumberNotPositiveException($name, $fixture))->getMessage();

        try {
            Assert::assert('abc', $name)->lengthLess($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (NumberNotPositiveException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testInArray()
    {
        $name     = 'variable';
        $fixtures = array_values($this->getTypeFixturesWithout([self::OBJECT_FIXTURE]));

        foreach ($fixtures as $fixture) {
            Assert::assert($fixture, $name)->inArray($fixtures);
        }
    }

    public function testInArrayWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $range    = array_values($this->getTypeFixtures());
        $fixtures = [
            'null',
            false,
            'true',
            '0',
            '0.0',
            'abc',
            1,
            1.2,
            ['a'],
            stream_context_create(),
        ];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new ValueNotInArrayException($name, $fixture, $range))->getMessage();

            try {
                Assert::assert($fixture, $name)->inArray($range);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (ValueNotInArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testInArrayWithInvalidTypeFixturesForRangeArgument()
    {
        $name     = 'range';
        $fixtures = $this->getTypeFixturesWithout([self::ARRAY_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidArrayException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->inArray($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testInArrayWithEmptyValueFixturesForRangeArgument()
    {
        $name            = 'range';
        $fixture         = [];
        $expectedMessage = (new InvalidNotEmptyException($name, $fixture))->getMessage();

        try {
            Assert::assert(5, $name)->inArray($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotEmptyException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testIsArray()
    {
        Assert::assert($this->getTypeFixture(self::ARRAY_FIXTURE))->isArray();
    }

    public function testIsArrayWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::ARRAY_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidArrayException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->isArray();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testHasKey()
    {
        Assert::assert(['a' => 'b'])->hasKey('a');
    }

    public function testHasKeyWithInvalidTypeKey()
    {
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::INT_FIXTURE,
                self::STRING_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrStringException('key', $fixture))->getMessage();

            try {
                Assert::assert([])->hasKey($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testHasKeyWithNotArrayValue()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::ARRAY_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidArrayException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->hasKey('key');

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testHasKeyWithArrayKeyNotExists()
    {
        $name    = 'variable';
        $key     = 'notExistsKey';
        $fixture = $this->getTypeFixture(self::ARRAY_FIXTURE);

        $expectedMessage = (new ArrayKeyNotExistsException($name, $key))->getMessage();

        try {
            Assert::assert($fixture, $name)->hasKey($key);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (ArrayKeyNotExistsException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testCount()
    {
        Assert::assert(['a', 'b'])->count(2);
    }

    public function testCountWithInvalidTypeCount()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntException('count', $fixture))->getMessage();

            try {
                Assert::assert([])->count($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testCountWithInvalidValueCount()
    {
        $count           = -10;
        $expectedMessage = (new NumberNotGreaterException('count', $count, 0))->getMessage();

        try {
            Assert::assert([])->count($count);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (NumberNotGreaterException  $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testCountWithNotArrayValue()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::ARRAY_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidArrayException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->count(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testHasKeyWithInvalidArrayElementsCount()
    {
        $name    = 'variable';
        $count   = 10;
        $fixture = $this->getTypeFixture(self::ARRAY_FIXTURE);

        $expectedMessage = (new InvalidArrayCountException($name, $fixture, $count))->getMessage();

        try {
            Assert::assert($fixture, $name)->count($count);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidArrayCountException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testBetween()
    {
        Assert::assert(5)->between(4, 6);
        Assert::assert(5)->between(4.9, 6.9);
        Assert::assert(5.1)->between(5.0, 6);
        Assert::assert(5.1)->between(0, 7.0);
        Assert::assert(5.4)->between(5.4, 6);
        Assert::assert(5.1)->between(0, 5.1);
    }

    public function testBetweenWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->between(-1, 1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $from     = -2;
        $to       = 1.4;
        $fixtures = [3, 7.3, 1.5];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotBetweenException($name, $fixture, $from, $to))->getMessage();

            try {
                Assert::assert($fixture, $name)->between($from, $to);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotBetweenException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenWithInvalidTypeFixturesForFromArgument()
    {
        $name     = 'from';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->between($fixture, 10);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenWithInvalidTypeFixturesForToArgument()
    {
        $name     = 'to';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->between(-5, $fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenWithInvalidValueFixturesForFromAndToArgument()
    {
        $name     = 'from';
        $fixtures = [[10, -1], [10.1, -1.2]];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotLessStrictlyException($name, $fixture[0], $fixture[1]))->getMessage();

            try {
                Assert::assert(5, $name)->between($fixture[0], $fixture[1]);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotLessStrictlyException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenStrict()
    {
        Assert::assert(5)->betweenStrict(4, 6);
        Assert::assert(5)->betweenStrict(4.9, 6.9);
        Assert::assert(5.1)->betweenStrict(5.0, 6);
        Assert::assert(5.1)->betweenStrict(0, 7.0);
    }

    public function testBetweenStrictWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->betweenStrict(-1, 1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenStrictWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $from     = -2;
        $to       = 1.4;
        $fixtures = [3, 7.3, 1.4];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotBetweenStrictlyException($name, $fixture, $from, $to))->getMessage();

            try {
                Assert::assert($fixture, $name)->betweenStrict($from, $to);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotBetweenStrictlyException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenStrictWithInvalidTypeFixturesForFromArgument()
    {
        $name     = 'from';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->betweenStrict($fixture, 10);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenStrictWithInvalidTypeFixturesForToArgument()
    {
        $name     = 'to';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->betweenStrict(-5, $fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBetweenStrictWithInvalidValueFixturesForFromAndToArgument()
    {
        $name     = 'from';
        $fixtures = [[10, -1], [10.1, -1.2]];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotLessStrictlyException($name, $fixture[0], $fixture[1]))->getMessage();

            try {
                Assert::assert(5, $name)->betweenStrict($fixture[0], $fixture[1]);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotLessStrictlyException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testBool()
    {
        Assert::assert(true)->bool();
        Assert::assert(false)->bool();
    }

    public function testBoolWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::BOOL_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidBoolException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->bool();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidBoolException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testDigit()
    {
        Assert::assert('123')->digit();
        Assert::assert('0000')->digit();
    }

    public function testDigitWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::STRING_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->digit();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testDigitWithInvalidValueFixtures()
    {
        $name            = 'variable';
        $fixture         = 'abc';
        $expectedMessage = (new InvalidDigitException($name, $fixture))->getMessage();

        try {
            Assert::assert($fixture, $name)->digit();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidDigitException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testIsEmpty()
    {
        Assert::assert(null)->isEmpty();
        Assert::assert(false)->isEmpty();
        Assert::assert(0)->isEmpty();
        Assert::assert(0.0)->isEmpty();
        Assert::assert('')->isEmpty();
        Assert::assert([])->isEmpty();
    }

    public function testIsEmptyWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $fixtures = [true, 1, 1.1, 'abc', [1], stream_context_create()];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidEmptyException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->isEmpty();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidEmptyException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testNotEmpty()
    {
        Assert::assert(true)->notEmpty();
        Assert::assert(1)->notEmpty();
        Assert::assert(1.2)->notEmpty();
        Assert::assert('abc')->notEmpty();
        Assert::assert(['1'])->notEmpty();
        Assert::assert(stream_context_create())->notEmpty();
    }

    public function testNotEmptyWithInvalidValueFixtures()
    {
        $name            = 'variable';
        $fixture         = $this->getTypeFixture(self::NULL_FIXTURE);
        $expectedMessage = (new InvalidNotEmptyException($name, $fixture))->getMessage();

        try {
            Assert::assert($fixture, $name)->notEmpty();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotEmptyException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testFloat()
    {
        Assert::assert($this->getTypeFixture(self::FLOAT_FIXTURE))->float();
    }

    public function testFloatWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::FLOAT_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->float();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testInt()
    {
        Assert::assert($this->getTypeFixture(self::INT_FIXTURE))->int();
    }

    public function testIntWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::INT_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->int();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLess()
    {
        Assert::assert(5)->less(6);
        Assert::assert(5)->less(6.9);
        Assert::assert(5.1)->less(6);
        Assert::assert(5.1)->less(6.0);
        Assert::assert(5.1)->less(5.1);
        Assert::assert(-2)->less(-2);
    }

    public function testLessWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->less(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLessWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $number   = 1.4;
        $fixtures = [3, 7.2];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotLessException($name, $fixture, $number))->getMessage();

            try {
                Assert::assert($fixture, $name)->less($number);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotLessException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLessWithInvalidTypeFixturesForNumberArgument()
    {
        $name     = 'number';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->less($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGreater()
    {
        Assert::assert(5)->greater(4);
        Assert::assert(5)->greater(4.9);
        Assert::assert(5.1)->greater(5);
        Assert::assert(5.1)->greater(5.0);
        Assert::assert(5.1)->greater(5.1);
        Assert::assert(-2)->greater(-2);
    }

    public function testGreaterWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->greater(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGreaterWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $number   = 2.4;
        $fixtures = [-1, -2.2];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotGreaterException($name, $fixture, $number))->getMessage();

            try {
                Assert::assert($fixture, $name)->greater($number);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotGreaterException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGreaterWithInvalidTypeFixturesForNumberArgument()
    {
        $name     = 'number';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->greater($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLessStrict()
    {
        Assert::assert(5)->lessStrict(6);
        Assert::assert(5)->lessStrict(6.9);
        Assert::assert(5.1)->lessStrict(6);
        Assert::assert(5.1)->lessStrict(5.2);
    }

    public function testLessStrictWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->lessStrict(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLessStrictWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $number   = 1.4;
        $fixtures = [3, 7.3, 1.4];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotLessStrictlyException($name, $fixture, $number))->getMessage();

            try {
                Assert::assert($fixture, $name)->lessStrict($number);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotLessStrictlyException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testLessStrictWithInvalidTypeFixturesForNumberArgument()
    {
        $name     = 'number';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->lessStrict($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGreaterStrict()
    {
        Assert::assert(5)->greaterStrict(4);
        Assert::assert(5)->greaterStrict(4.9);
        Assert::assert(5.1)->greaterStrict(5);
        Assert::assert(5.1)->greaterStrict(5.0);
    }

    public function testGreaterStrictWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->greaterStrict(1);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGreaterStrictWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $number   = 2.4;
        $fixtures = [-1, -2.2, 2.4];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotGreaterStrictlyException($name, $fixture, $number))->getMessage();

            try {
                Assert::assert($fixture, $name)->greaterStrict($number);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotGreaterStrictlyException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGreaterStrictWithInvalidTypeFixturesForNumberArgument()
    {
        $name     = 'number';
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert(5, $name)->greaterStrict($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMatch()
    {
        Assert::assert('abc')->match('/abc/');
        Assert::assert('def')->match('/.+/');
    }

    public function testMatchWithInvalidTypeFixturesForPatternArgument()
    {
        $name     = 'pattern';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert('value', $name)->match($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMatchWithEmptyValueFixturesForPatternArgument()
    {
        $name            = 'pattern';
        $fixture         = '';
        $expectedMessage = (new InvalidNotEmptyException($name, $fixture))->getMessage();

        try {
            Assert::assert('value', $name)->match($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotEmptyException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testMatchWithInvalidValueFixturesForPatternArgument()
    {
        $name            = 'pattern';
        $fixture         = '/invalid';
        $expectedMessage = (new InvalidRegExpPatternException($name, $fixture))->getMessage();

        try {
            Assert::assert('value', $name)->match($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidRegExpPatternException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testMatchWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $pattern  = '/.+/';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::STRING_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture, $pattern))->getMessage();

            try {
                Assert::assert($fixture, $name)->match($pattern);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMatchWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $pattern  = '/^test$/';
        $fixtures = ['abc', 'cde'];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new StringNotMatchRegExpException($name, $fixture, $pattern))->getMessage();

            try {
                Assert::assert($fixture, $name)->match($pattern);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (StringNotMatchRegExpException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGlob()
    {
        Assert::assert('abc')->glob('a*c');
        Assert::assert('def')->glob('d*');
    }

    public function testGlobWithInvalidTypeFixturesForPatternArgument()
    {
        $name     = 'pattern';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert('value', $name)->glob($fixture);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGlobWithInvalidValueFixturesForPatternArgument()
    {
        $name            = 'pattern';
        $fixture         = '';
        $expectedMessage = (new InvalidNotEmptyException($name, $fixture))->getMessage();

        try {
            Assert::assert('value', $name)->glob($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotEmptyException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testGlobWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $pattern  = 'pattern*';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::STRING_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture, $pattern))->getMessage();

            try {
                Assert::assert($fixture, $name)->glob($pattern);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testGlobWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $pattern  = 'pattern*';
        $fixtures = ['abc', 'cde'];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new StringNotMatchGlobException($name, $fixture, $pattern))->getMessage();

            try {
                Assert::assert($fixture, $name)->glob($pattern);

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (StringNotMatchGlobException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testNegative()
    {
        Assert::assert(-5)->negative();
        Assert::assert(-2.5)->negative();
    }

    public function testNegativeWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::INT_FIXTURE,
                self::FLOAT_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->negative();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testNegativeWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $fixtures = [1, 2.1, 0, 0.0];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotNegativeException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->negative();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotNegativeException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testPositive()
    {
        Assert::assert(5)->positive();
        Assert::assert(2.5)->positive();
    }

    public function testPositiveWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::INT_FIXTURE,
                self::FLOAT_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->positive();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testPositiveWithInvalidValueFixtures()
    {
        $name     = 'variable';
        $fixtures = [-1, -2.1, 0, 0.0];

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new NumberNotPositiveException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->positive();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (NumberNotPositiveException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testIsSame()
    {
        Assert::assert('a')->isSame('a');
    }

    public function testIsSameWithInvalidTypeFixtures()
    {
        $fixture = $this->getTypeFixture(self::OBJECT_FIXTURE);

        $expectedMessage = (new InvalidNotObjectException('anotherValue'))->getMessage();

        try {
            Assert::assert(1)->isSame($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotObjectException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testIsSameWithVariableValueAndAnotherValue()
    {
        $fixtures = $this->getTypeFixturesWithout([self::OBJECT_FIXTURE]);

        foreach ($fixtures as $variableValue) {
            foreach ($fixtures as $anotherValue) {
                if ($variableValue === $anotherValue) {
                    continue;
                }

                $expectedMessage = (new InvalidSameValueException('value', $variableValue, $anotherValue))
                    ->getMessage();

                try {
                    Assert::assert($variableValue)->isSame($anotherValue);

                    $this->fail('Not fail with: ' . $expectedMessage);
                } catch (InvalidSameValueException $error) {
                    $this->assertSame($expectedMessage, $error->getMessage());
                }
            }
        }
    }

    public function testNotSame()
    {
        Assert::assert('a')->notSame('b');
    }

    public function testNotSameWithInvalidTypeFixtures()
    {
        $fixture = $this->getTypeFixture(self::OBJECT_FIXTURE);

        $expectedMessage = (new InvalidNotObjectException('anotherValue'))->getMessage();

        try {
            Assert::assert(1)->notSame($fixture);

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotObjectException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testNotSameWithVariableValueAndAnotherValue()
    {
        $fixtures = $this->getTypeFixturesWithout([self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidNotSameValueException('value', $fixture))->getMessage();

            try {
                Assert::assert($fixture)->notSame($fixture);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidNotSameValueException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testIsNull()
    {
        Assert::assert($this->getTypeFixture(self::NULL_FIXTURE))->isNull();
    }

    public function testIsNullWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::NULL_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidNullException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->isNull();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidNullException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testNotNull()
    {
        Assert::assert($this->getTypeFixture(self::BOOL_FIXTURE))->notNull();
        Assert::assert($this->getTypeFixture(self::INT_FIXTURE))->notNull();
        Assert::assert($this->getTypeFixture(self::FLOAT_FIXTURE))->notNull();
        Assert::assert($this->getTypeFixture(self::STRING_FIXTURE))->notNull();
        Assert::assert($this->getTypeFixture(self::ARRAY_FIXTURE))->notNull();
        Assert::assert($this->getTypeFixture(self::RESOURCE_FIXTURE))->notNull();
    }

    public function testNotNullWithInvalidTypeFixtures()
    {
        $name            = 'variable';
        $fixture         = $this->getTypeFixture(self::NULL_FIXTURE);
        $expectedMessage = (new InvalidNotNullException($name, $fixture))->getMessage();

        try {
            Assert::assert($fixture, $name)->notNull();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotNullException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testNumeric()
    {
        Assert::assert('42')->numeric();
        Assert::assert(1337)->numeric();
        Assert::assert(0x539)->numeric();
        Assert::assert(02471)->numeric();
        Assert::assert(0b10100111001)->numeric();
        Assert::assert(1337e0)->numeric();
        Assert::assert(9.1)->numeric();
    }

    public function testNumericWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout(
            [
                self::FLOAT_FIXTURE,
                self::INT_FIXTURE,
                self::STRING_FIXTURE,
                self::OBJECT_FIXTURE,
            ]
        );

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidIntOrFloatOrStringException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->numeric();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidIntOrFloatOrStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testNumericWithInvalidValueFixtures()
    {
        $name    = 'variable';
        $fixture = 'invalid';

        $expectedMessage = (new InvalidNumericException($name, $fixture))->getMessage();

        try {
            Assert::assert($fixture, $name)->numeric();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNumericException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testResource()
    {
        Assert::assert(stream_context_create())->resource();
    }

    public function testResourceWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::RESOURCE_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidResourceException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->resource();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidResourceException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testString()
    {
        Assert::assert('var')->string();
    }

    public function testStringWithInvalidTypeFixtures()
    {
        $name     = 'variable';
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE, self::OBJECT_FIXTURE]);

        foreach ($fixtures as $fixture) {
            $expectedMessage = (new InvalidStringException($name, $fixture))->getMessage();

            try {
                Assert::assert($fixture, $name)->string();

                $this->fail(sprintf('Not fail with: %s', $expectedMessage));
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testToBool()
    {
        $this->assertTrue(Assert::assert('var')->toBool()->get());
        $this->assertTrue(Assert::assert(5)->toBool()->get());
        $this->assertFalse(Assert::assert('')->toBool()->get());
        $this->assertFalse(Assert::assert(null)->toBool()->get());
        $this->assertFalse(Assert::assert(false)->toBool()->get());
        $this->assertFalse(Assert::assert([])->toBool()->get());
    }

    public function testToFloat()
    {
        $this->assertSame(0.0, Assert::assert('')->toFloat()->get());
        $this->assertSame(0.0, Assert::assert(null)->toFloat()->get());
        $this->assertSame(0.0, Assert::assert(false)->toFloat()->get());
        $this->assertSame(15.2, Assert::assert('15.2')->toFloat()->get());
        $this->assertSame(2.0, Assert::assert(2)->toFloat()->get());
    }

    public function testToFloatWithInvalidTypeFixtures()
    {
        $name            = 'variable';
        $expectedMessage = (new InvalidNotArrayException($name))->getMessage();

        try {
            Assert::assert([], $name)->toFloat();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotArrayException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testToFloatWithInvalidValueFixtures()
    {
        $name            = 'variable';
        $value           = 'not_numeric';
        $expectedMessage = (new InvalidNumericException($name, $value))->getMessage();

        try {
            Assert::assert($value, $name)->toFloat();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNumericException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testToInt()
    {
        $this->assertSame(0, Assert::assert('')->toInt()->get());
        $this->assertSame(0, Assert::assert(null)->toInt()->get());
        $this->assertSame(0, Assert::assert(false)->toInt()->get());
        $this->assertSame(15, Assert::assert('15.2')->toInt()->get());
        $this->assertSame(2, Assert::assert(2.1)->toInt()->get());
    }

    public function testToIntWithInvalidTypeFixtures()
    {
        $name            = 'variable';
        $expectedMessage = (new InvalidNotArrayException($name))->getMessage();

        try {
            Assert::assert([], $name)->toInt();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotArrayException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testToIntWithInvalidValueFixtures()
    {
        $name            = 'variable';
        $value           = 'not_numeric';
        $expectedMessage = (new InvalidNumericException($name, $value))->getMessage();

        try {
            Assert::assert($value, $name)->toInt();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNumericException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testToString()
    {
        $this->assertSame('17', Assert::assert(17)->toString()->get());
        $this->assertSame('2.1', Assert::assert(2.1)->toString()->get());
        $this->assertSame('', Assert::assert(null)->toString()->get());
        $this->assertSame('', Assert::assert(false)->toString()->get());
        $this->assertSame('test', Assert::assert('test')->toString()->get());
    }

    public function testToStringWithInvalidTypeFixtures()
    {
        $name            = 'variable';
        $expectedMessage = (new InvalidNotArrayException($name))->getMessage();

        try {
            Assert::assert([], $name)->toString();

            $this->fail(sprintf('Not fail with: %s', $expectedMessage));
        } catch (InvalidNotArrayException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }
}
