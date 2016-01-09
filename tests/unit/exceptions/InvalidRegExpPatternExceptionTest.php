<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidRegExpPatternException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidRegExpPatternExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidRegExpPatternException($typeValue, 'data');

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
                new InvalidRegExpPatternException('variableName', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new InvalidRegExpPatternException('variableValue', $this->getTypeFixture(self::STRING_FIXTURE));
    }

    public function testMessage()
    {
        $fixture = $this->getTypeFixture(self::STRING_FIXTURE);
        $error   = new InvalidRegExpPatternException('variableName', $fixture);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be "correct RegExp pattern", actual value: "%s"',
                $fixture
            ),
            $error->getMessage()
        );
    }
}