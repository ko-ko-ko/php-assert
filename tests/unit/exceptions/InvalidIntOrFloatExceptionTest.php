<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidNotIntAndNotFloatException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidIntOrFloatExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidIntOrFloatException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $expectedMessage = (new InvalidNotIntAndNotFloatException('variableValue'))->getMessage();

        try {
            new InvalidIntOrFloatException('variableName', $this->getTypeFixture(self::INT_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotIntAndNotFloatException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        try {
            new InvalidIntOrFloatException('variableName', $this->getTypeFixture(self::FLOAT_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotIntAndNotFloatException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        $fixtureTypes = [self::INT_FIXTURE, self::FLOAT_FIXTURE];

        foreach ($this->getTypeFixturesWithout($fixtureTypes) as $typeName => $typeValue) {
            new InvalidIntOrFloatException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::FLOAT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidIntOrFloatException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be "int" or "float", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}
