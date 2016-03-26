<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntOrStringException;
use KoKoKo\assert\exceptions\InvalidNotIntAndNotStringException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidIntOrStringExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidIntOrStringException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $expectedMessage = (new InvalidNotIntAndNotStringException('variableName'))->getMessage();

        try {
            new InvalidIntOrStringException('variableName', $this->getTypeFixture(self::INT_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotIntAndNotStringException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        try {
            new InvalidIntOrStringException('variableName', $this->getTypeFixture(self::STRING_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotIntAndNotStringException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        $fixtureTypes = [self::INT_FIXTURE, self::STRING_FIXTURE];

        foreach ($this->getTypeFixturesWithout($fixtureTypes) as $typeName => $typeValue) {
            new InvalidIntOrStringException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidIntOrStringException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be: "int" or "string", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}
