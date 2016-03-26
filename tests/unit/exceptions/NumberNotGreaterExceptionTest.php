<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\NumberNotGreaterException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class NumberNotGreaterExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new NumberNotGreaterException($typeValue, 1, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrFloatException('variableValue', $typeValue))->getMessage();

            try {
                new NumberNotGreaterException('variableName', $typeValue, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotGreaterException('variableValue', $this->getTypeFixture(self::INT_FIXTURE), 1);
        new NumberNotGreaterException('variableValue', $this->getTypeFixture(self::FLOAT_FIXTURE), 1);
    }

    public function testConstructWithNumber()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrFloatException('number', $typeValue))->getMessage();

            try {
                new NumberNotGreaterException('variableName', 1, $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotGreaterException('variableValue', 1, $this->getTypeFixture(self::INT_FIXTURE));
        new NumberNotGreaterException('variableValue', 1, $this->getTypeFixture(self::FLOAT_FIXTURE));
    }

    public function testMessage()
    {
        $number  = -100;
        $fixture = $this->getTypeFixture(self::INT_FIXTURE);
        $error   = new NumberNotGreaterException('variableName', $fixture, $number);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be greater than "%s", actual value: "%s"',
                (string) $number,
                (string) $fixture
            ),
            $error->getMessage()
        );
    }
}
