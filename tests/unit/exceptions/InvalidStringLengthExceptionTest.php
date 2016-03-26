<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\InvalidStringLengthException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidStringLengthExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidStringLengthException($typeValue, 'variableValue', 1);

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
                new InvalidStringLengthException('variableName', $typeValue, 1);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new InvalidStringLengthException('variableName', $this->getTypeFixture(self::STRING_FIXTURE), 1);
    }

    public function testConstructWithLength()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntException('length', $typeValue))->getMessage();

            try {
                new InvalidStringLengthException('variableName', 'variableValue', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new InvalidStringLengthException(
            'variableName', 'variableValue', $this->getTypeFixture(self::INT_FIXTURE)
        );
    }

    public function testMessage()
    {
        $length  = 10;
        $fixture = $this->getTypeFixture(self::STRING_FIXTURE);
        $error   = new InvalidStringLengthException('variableName', $fixture, $length);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must have length "%s", actual length: "%s"',
                (string) $length,
                mb_strlen($fixture)
            ),
            $error->getMessage()
        );
    }
}
