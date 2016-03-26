<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidNotNullAndNotIntException;
use KoKoKo\assert\exceptions\InvalidNullOrIntException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidNullOrIntExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidNullOrIntException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $expectedMessage = (new InvalidNotNullAndNotIntException('variableName'))->getMessage();

        try {
            new InvalidNullOrIntException('variableName', $this->getTypeFixture(self::NULL_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotNullAndNotIntException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        try {
            new InvalidNullOrIntException('variableName', $this->getTypeFixture(self::INT_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotNullAndNotIntException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        $fixtureTypes = [self::NULL_FIXTURE, self::INT_FIXTURE];

        foreach ($this->getTypeFixturesWithout($fixtureTypes) as $typeName => $typeValue) {
            new InvalidNullOrIntException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::NULL_FIXTURE, self::INT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidNullOrIntException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be: "null" or "int", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}
