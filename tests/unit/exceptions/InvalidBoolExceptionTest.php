<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidBoolException;
use KoKoKo\assert\exceptions\InvalidNotBoolException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidBoolExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidBoolException($typeValue, 'variableName');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtureName     = self::BOOL_FIXTURE;
        $expectedMessage = (new InvalidNotBoolException('variableValue'))->getMessage();

        try {
            new InvalidBoolException('variableValue', $this->getTypeFixture($fixtureName));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotBoolException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        foreach ($this->getTypeFixturesWithout([$fixtureName]) as $typeName => $typeValue) {
            new InvalidBoolException('variableValue', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::BOOL_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidBoolException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be "bool", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}