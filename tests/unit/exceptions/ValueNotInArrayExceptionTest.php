<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidArrayException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\ValueNotInArrayException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class ValueNotInArrayExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new ValueNotInArrayException($typeValue, 'variableName', [1]);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithArray()
    {
        $fixtures = $this->getTypeFixturesWithout([self::ARRAY_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidArrayException('array', $typeValue))->getMessage();

            try {
                new ValueNotInArrayException('variableName', 'variableValue', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidArrayException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMessage()
    {
        $value   = 'variableValue';
        $fixture = $this->getTypeFixture(self::ARRAY_FIXTURE);
        $error   = new ValueNotInArrayException('variableName', $value, $fixture);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be "in array" {%s}, actual value: "%s"',
                print_r($fixture, true),
                print_r($value, true)
            ),
            $error->getMessage()
        );
    }
}