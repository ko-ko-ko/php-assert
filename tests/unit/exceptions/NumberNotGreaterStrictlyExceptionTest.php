<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\NumberNotGreaterStrictlyException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class NumberNotGreaterStrictlyExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new NumberNotGreaterStrictlyException($typeValue, 1, 1);

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
                new NumberNotGreaterStrictlyException('variableName', $typeValue, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotGreaterStrictlyException('variableValue', $this->getTypeFixture(self::INT_FIXTURE), 1);
        new NumberNotGreaterStrictlyException('variableValue', $this->getTypeFixture(self::FLOAT_FIXTURE), 1);
    }

    public function testConstructThirdArgument()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrFloatException('number', $typeValue))->getMessage();

            try {
                new NumberNotGreaterStrictlyException('variableName', 1, $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrFloatException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new NumberNotGreaterStrictlyException('variableValue', 1, $this->getTypeFixture(self::INT_FIXTURE));
        new NumberNotGreaterStrictlyException('variableValue', 1, $this->getTypeFixture(self::FLOAT_FIXTURE));
    }

    public function testMessage()
    {
        $number  = -100;
        $fixture = $this->getTypeFixture(self::INT_FIXTURE);
        $error   = new NumberNotGreaterStrictlyException('variableName', $fixture, $number);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be strictly greater than "%s", actual value: "%s"',
                (string) $number,
                (string) $fixture
            ),
            $error->getMessage()
        );
    }
}