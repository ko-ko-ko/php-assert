<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\NumberNotBetweenStrictlyException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class NumberNotBetweenStrictlyExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new NumberNotBetweenStrictlyException($typeValue, 1, 1, 1);

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
                new NumberNotBetweenStrictlyException('variableName', $typeValue, 1, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotBetweenStrictlyException('variableValue', $this->getTypeFixture(self::INT_FIXTURE), 1, 1);
        new NumberNotBetweenStrictlyException('variableValue', $this->getTypeFixture(self::FLOAT_FIXTURE), 1, 1);
    }

    public function testConstructThirdArgument()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrFloatException('from', $typeValue))->getMessage();

            try {
                new NumberNotBetweenStrictlyException('variableName', 1, $typeValue, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotBetweenStrictlyException('variableValue', 1, $this->getTypeFixture(self::INT_FIXTURE), 1);
        new NumberNotBetweenStrictlyException('variableValue', 1, $this->getTypeFixture(self::FLOAT_FIXTURE), 1);
    }

    public function testConstructFourthArgument()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrFloatException('to', $typeValue))->getMessage();

            try {
                new NumberNotBetweenStrictlyException('variableName', 1, 1, $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotBetweenStrictlyException('variableValue', 1, 1, $this->getTypeFixture(self::INT_FIXTURE));
        new NumberNotBetweenStrictlyException('variableValue', 1, 1, $this->getTypeFixture(self::FLOAT_FIXTURE));
    }

    public function testMessage()
    {
        $from    = -100;
        $to      = 100;
        $fixture = $this->getTypeFixture(self::INT_FIXTURE);
        $error   = new NumberNotBetweenStrictlyException('variableName', $fixture, $from, $to);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be strictly between "%s" and "%s", actual value: "%s"',
                (string) $from,
                (string) $to,
                (string) $fixture
            ),
            $error->getMessage()
        );
    }
}
