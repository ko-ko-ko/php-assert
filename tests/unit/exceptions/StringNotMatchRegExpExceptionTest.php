<?php

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\StringNotMatchRegExpException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class StringNotMatchRegExpExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new StringNotMatchRegExpException($typeValue, 1, 1);

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
                new StringNotMatchRegExpException('variableName', $typeValue, 'pattern');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new StringNotMatchRegExpException(
            'variableName', $this->getTypeFixture(self::STRING_FIXTURE), 'pattern'
        );
    }

    public function testConstructWithPattern()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('pattern', $typeValue))->getMessage();

            try {
                new StringNotMatchRegExpException('variableName', 'variableValue', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new StringNotMatchRegExpException(
            'variableValue', 'variableValue', $this->getTypeFixture(self::STRING_FIXTURE)
        );
    }

    public function testMessage()
    {
        $pattern = 'pattern';
        $fixture = $this->getTypeFixture(self::STRING_FIXTURE);
        $error   = new StringNotMatchRegExpException('variableName', $fixture, $pattern);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must match RegExp pattern "%s", actual value: "%s"',
                (string) $pattern,
                (string) $fixture
            ),
            $error->getMessage()
        );
    }
}