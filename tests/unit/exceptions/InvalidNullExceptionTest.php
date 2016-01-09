<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidNotNullException;
use KoKoKo\assert\exceptions\InvalidNullException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidNullExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidNullException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtureName     = self::NULL_FIXTURE;
        $expectedMessage = (new InvalidNotNullException('variableValue'))->getMessage();

        try {
            new InvalidNullException('variableName', $this->getTypeFixture($fixtureName));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotNullException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        foreach ($this->getTypeFixturesWithout([$fixtureName]) as $typeName => $typeValue) {
            new InvalidNullException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixture = $this->getTypeFixture(self::STRING_FIXTURE);
        $error   = new InvalidNullException('variableName', $fixture);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be "null", actual type: "%s"',
                self::STRING_FIXTURE
            ),
            $error->getMessage()
        );
    }
}