<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidFloatException;
use KoKoKo\assert\exceptions\InvalidNotFloatException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidFloatExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidFloatException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtureName     = self::FLOAT_FIXTURE;
        $expectedMessage = (new InvalidNotFloatException('variableValue'))->getMessage();

        try {
            new InvalidFloatException('variableName', $this->getTypeFixture($fixtureName));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotFloatException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        foreach ($this->getTypeFixturesWithout([$fixtureName]) as $typeName => $typeValue) {
            new InvalidFloatException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::FLOAT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidFloatException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be "float", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}