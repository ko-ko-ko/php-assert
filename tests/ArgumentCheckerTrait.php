<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests;

use KoKoKo\assert\Assert;
use KoKoKo\assert\exceptions\ArrayKeyNotExistsException;
use KoKoKo\assert\exceptions\InvalidArrayException;
use KoKoKo\assert\exceptions\InvalidBoolException;
use KoKoKo\assert\exceptions\InvalidFloatException;
use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidIntOrStringException;
use KoKoKo\assert\exceptions\InvalidNotEmptyException;
use KoKoKo\assert\exceptions\InvalidNotObjectException;
use KoKoKo\assert\exceptions\InvalidNotResourceException;
use KoKoKo\assert\exceptions\InvalidNullOrIntException;
use KoKoKo\assert\exceptions\InvalidNullOrStringException;
use KoKoKo\assert\exceptions\InvalidResourceException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\NumberNotPositiveException;

trait ArgumentCheckerTrait
{
    /**
     * @return array
     */
    public function getTypeFixtures()
    {
        return [
            'null'     => null,
            'bool'     => true,
            'int'      => 100,
            'float'    => 100.5,
            'string'   => 'string',
            'array'    => [],
            'object'   => new \stdClass,
            'resource' => stream_context_create(),
        ];
    }

    /**
     * @param string[] $fixtureNames
     * @return array
     * @throws InvalidArrayException
     * @throws InvalidIntOrStringException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     * @throws ArrayKeyNotExistsException
     */
    public function getTypeFixturesWithout($fixtureNames)
    {
        Assert::assert($fixtureNames, 'fixtureNames')->isArray();

        $fixtures = $this->getTypeFixtures();

        foreach ($fixtureNames as $typeName) {
            Assert::assert($fixtures, 'fixtures')->hasKey($typeName);

            unset($fixtures[$typeName]);
        }

        return $fixtures;
    }

    /**
     * @param string $fixtureName
     * @return mixed
     * @throws ArrayKeyNotExistsException
     * @throws InvalidArrayException
     * @throws InvalidIntOrStringException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function getTypeFixture($fixtureName)
    {
        Assert::assert($fixtureName, 'fixtureName')->string();

        $fixtures = $this->getTypeFixtures();

        Assert::assert($fixtures, 'fixtures')->hasKey($fixtureName);

        return $fixtures[$fixtureName];
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkStringArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['string']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            } catch (InvalidNotObjectException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame((new InvalidNotObjectException($argumentName))->getMessage(), $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkNullOrStringArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['string', 'null']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidNullOrStringException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidNullOrStringException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkNullOrIntArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['int', 'null']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidNullOrIntException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidNullOrIntException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkIntOrStringArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['int', 'string']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrStringException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrStringException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkIntArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['int']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            } catch (InvalidNotObjectException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame((new InvalidNotObjectException($argumentName))->getMessage(), $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkBoolArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['bool']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidBoolException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidBoolException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            } catch (InvalidNotObjectException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame((new InvalidNotObjectException($argumentName))->getMessage(), $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkFloatArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['float']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidFloatException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidFloatException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            } catch (InvalidNotObjectException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame((new InvalidNotObjectException($argumentName))->getMessage(), $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkArrayArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['array']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidArrayException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidArrayException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            } catch (InvalidNotObjectException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame((new InvalidNotObjectException($argumentName))->getMessage(), $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkResourceArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        foreach ($this->getTypeFixturesWithout(['resource']) as $typeName => $typeValue) {
            $expectedMessage = (new InvalidResourceException($argumentName, $typeValue))->getMessage();

            try {
                $func($typeValue);

                /** @noinspection PhpUndefinedMethodInspection */
                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidResourceException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame($expectedMessage, $e->getMessage());
            } catch (InvalidNotObjectException $e) {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->assertSame((new InvalidNotObjectException($argumentName))->getMessage(), $e->getMessage());
            }
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkNotResourceArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        $fixture = $this->getTypeFixture('resource');

        $expectedMessage = (new InvalidNotResourceException($argumentName, $fixture))->getMessage();

        try {
            $func($fixture);

            /** @noinspection PhpUndefinedMethodInspection */
            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotResourceException $e) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->assertSame($expectedMessage, $e->getMessage());
        } catch (InvalidNotObjectException $e) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->assertSame((new InvalidNotObjectException($argumentName))->getMessage(), $e->getMessage());
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkEmptyStringArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        $fixture         = '';
        $expectedMessage = (new InvalidNotEmptyException($argumentName))->getMessage();

        try {
            $func($fixture);

            /** @noinspection PhpUndefinedMethodInspection */
            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotEmptyException $e) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->assertSame($expectedMessage, $e->getMessage());
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkEmptyArrayArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        $fixture         = [];
        $expectedMessage = (new InvalidNotEmptyException($argumentName))->getMessage();

        try {
            $func($fixture);

            /** @noinspection PhpUndefinedMethodInspection */
            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotEmptyException $e) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->assertSame($expectedMessage, $e->getMessage());
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkPositiveIntArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        $fixture         = 0;
        $expectedMessage = (new NumberNotPositiveException($argumentName, $fixture))->getMessage();

        try {
            $func($fixture);

            /** @noinspection PhpUndefinedMethodInspection */
            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (NumberNotPositiveException $e) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->assertSame($expectedMessage, $e->getMessage());
        }
    }

    /**
     * @param string   $argumentName
     * @param callable $func
     * @throws InvalidNotEmptyException
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public function checkPositiveFloatArgument($argumentName, callable $func)
    {
        Assert::assert($argumentName, 'argumentName')->string()->notEmpty();

        $fixture         = -1.5;
        $expectedMessage = (new NumberNotPositiveException($argumentName, $fixture))->getMessage();

        try {
            $func($fixture);

            /** @noinspection PhpUndefinedMethodInspection */
            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (NumberNotPositiveException $e) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->assertSame($expectedMessage, $e->getMessage());
        }
    }
}
