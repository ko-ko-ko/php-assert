<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\StringNotMatchGlobException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class StringNotMatchGlobExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new StringNotMatchGlobException($typeValue, 1, 1);

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
                new StringNotMatchGlobException('variableName', $typeValue, 'pattern');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new StringNotMatchGlobException(
            'variableName', $this->getTypeFixture(self::STRING_FIXTURE), 'pattern'
        );
    }

    public function testConstructWithPattern()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('pattern', $typeValue))->getMessage();

            try {
                new StringNotMatchGlobException('variableName', 'variableValue', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new StringNotMatchGlobException(
            'variableValue', 'variableValue', $this->getTypeFixture(self::STRING_FIXTURE)
        );
    }

    public function testMessage()
    {
        $pattern = 'pattern';
        $fixture = $this->getTypeFixture(self::STRING_FIXTURE);
        $error   = new StringNotMatchGlobException('variableName', $fixture, $pattern);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must match glob pattern "%s", actual value: "%s"',
                (string) $pattern,
                (string) $fixture
            ),
            $error->getMessage()
        );
    }
}
