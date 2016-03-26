<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidArrayCountException;
use KoKoKo\assert\exceptions\InvalidArrayException;
use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\NumberNotGreaterException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidArrayCountExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidArrayCountException($typeValue, 'variableName', 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtures = $this->getTypeFixturesWithout([self::ARRAY_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidArrayException('variableValue', $typeValue))->getMessage();

            try {
                new InvalidArrayCountException('variableName', $typeValue, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithCount()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntException('count', $typeValue))->getMessage();

            try {
                new InvalidArrayCountException('variableName', [], $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        $count           = -1;
        $expectedMessage = (new NumberNotGreaterException('count', $count, 0))->getMessage();

        try {
            new InvalidArrayCountException('variableName', [], $count);

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (NumberNotGreaterException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }
    }

    public function testMessage()
    {
        $variableName  = 'variableName';
        $variableValue = ['test'];
        $count         = 2;
        $error         = new InvalidArrayCountException($variableName, $variableValue, $count);

        $this->assertSame(
            sprintf(
                'Variable "$%s" must contain: "%d" elements, actual count: "%d"',
                $variableName,
                $count,
                count($variableValue)
            ),
            $error->getMessage()
        );
    }
}
