<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrFloatOrStringException;
use KoKoKo\assert\exceptions\InvalidNumericException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidNumericExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidNumericException($typeValue, 'variableName');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtures = $this->getTypeFixturesWithout(
            [self::INT_FIXTURE, self::FLOAT_FIXTURE, self::STRING_FIXTURE]
        );

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrFloatOrStringException('variableValue', $typeValue))->getMessage();

            try {
                new InvalidNumericException('variableName', $typeValue, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatOrStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new InvalidNumericException('variableValue', $this->getTypeFixture(self::INT_FIXTURE));
        new InvalidNumericException('variableValue', $this->getTypeFixture(self::FLOAT_FIXTURE));
        new InvalidNumericException('variableValue', $this->getTypeFixture(self::STRING_FIXTURE));
    }

    public function testMessage()
    {
        $fixture = $this->getTypeFixture(self::INT_FIXTURE);
        $error   = new InvalidNumericException('variableName', $fixture);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be "numeric", actual value: "%s"',
                (string) $fixture
            ),
            $error->getMessage()
        );
    }
}