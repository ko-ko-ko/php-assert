<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrFloatOrStringException;
use KoKoKo\assert\exceptions\InvalidNotIntAndNotFloatAndNotStringException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidIntOrFloatOrStringExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidIntOrFloatOrStringException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $expectedMessage = (new InvalidNotIntAndNotFloatAndNotStringException('variableValue'))->getMessage();

        try {
            new InvalidIntOrFloatOrStringException('variableName', $this->getTypeFixture(self::INT_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotIntAndNotFloatAndNotStringException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        try {
            new InvalidIntOrFloatOrStringException('variableName', $this->getTypeFixture(self::FLOAT_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotIntAndNotFloatAndNotStringException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        $fixtureTypes = [self::INT_FIXTURE, self::FLOAT_FIXTURE, self::STRING_FIXTURE];

        foreach ($this->getTypeFixturesWithout($fixtureTypes) as $typeName => $typeValue) {
            new InvalidIntOrFloatOrStringException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout(
            [self::INT_FIXTURE, self::FLOAT_FIXTURE, self::STRING_FIXTURE]
        );

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidIntOrFloatOrStringException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be "int" or "float" or "string", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}
