<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidNotNullAndNotStringException;
use KoKoKo\assert\exceptions\InvalidNullOrStringException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidNullOrStringExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidNullOrStringException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $expectedMessage = (new InvalidNotNullAndNotStringException('variableName'))->getMessage();

        try {
            new InvalidNullOrStringException('variableName', $this->getTypeFixture(self::NULL_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotNullAndNotStringException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        try {
            new InvalidNullOrStringException('variableName', $this->getTypeFixture(self::STRING_FIXTURE));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotNullAndNotStringException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        $fixtureTypes = [self::NULL_FIXTURE, self::STRING_FIXTURE];

        foreach ($this->getTypeFixturesWithout($fixtureTypes) as $typeName => $typeValue) {
            new InvalidNullOrStringException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::NULL_FIXTURE, self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidNullOrStringException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be: "null" or "string", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}
