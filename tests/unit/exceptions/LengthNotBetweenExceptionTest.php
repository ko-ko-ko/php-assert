<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\LengthNotBetweenException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class LengthNotBetweenExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new LengthNotBetweenException($typeValue, 'variableValue', 1, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableValue', $typeValue))->getMessage();

            try {
                new LengthNotBetweenException('variableName', $typeValue, 1, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new LengthNotBetweenException('variableValue', $this->getTypeFixture(self::STRING_FIXTURE), 1, 1);
    }

    public function testConstructWithFrom()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntException('from', $typeValue))->getMessage();

            try {
                new LengthNotBetweenException('variableName', 'variableValue', $typeValue, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new LengthNotBetweenException(
            'variableName', 'variableValue', $this->getTypeFixture(self::INT_FIXTURE), 1
        );
    }

    public function testConstructFourthArgument()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntException('to', $typeValue))->getMessage();

            try {
                new LengthNotBetweenException('variableName', 'variableValue', 1, $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new LengthNotBetweenException(
            'variableName', 'variableValue', 1, $this->getTypeFixture(self::INT_FIXTURE)
        );
    }

    public function testMessage()
    {
        $from    = 1;
        $to      = 5;
        $fixture = $this->getTypeFixture(self::STRING_FIXTURE);
        $error   = new LengthNotBetweenException('variableName', $fixture, $from, $to);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must have length between "%s" and "%s", actual length: "%s"',
                (string) $from,
                (string) $to,
                mb_strlen($fixture)
            ),
            $error->getMessage()
        );
    }
}