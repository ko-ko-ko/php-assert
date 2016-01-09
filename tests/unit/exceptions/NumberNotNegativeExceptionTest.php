<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\NumberNotNegativeException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class NumberNotNegativeExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new NumberNotNegativeException($typeValue, -1);

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
                new NumberNotNegativeException('variableName', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotNegativeException('variableValue', $this->getTypeFixture(self::INT_FIXTURE));
        new NumberNotNegativeException('variableValue', $this->getTypeFixture(self::FLOAT_FIXTURE));
    }

    public function testMessage()
    {
        $fixture = 10;
        $error   = new NumberNotNegativeException(self::STRING_FIXTURE, $fixture);

        $this->assertSame(
            sprintf(
                'Variable "$%s" must be "negative", actual value: "%s"',
                self::STRING_FIXTURE,
                $fixture
            ),
            $error->getMessage()
        );
    }
}