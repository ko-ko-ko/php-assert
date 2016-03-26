<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidNotSameValueException;
use KoKoKo\assert\exceptions\InvalidSameValueException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidSameValueExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidSameValueException($typeValue, 'data1', 'data2');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValueAndAnotherValue()
    {
        $fixtures = $this->getTypeFixtures();

        foreach ($fixtures as $variableValue) {
            foreach ($fixtures as $anotherValue) {
                if ($variableValue !== $anotherValue) {
                    new InvalidSameValueException('data', $variableValue, $anotherValue);
                } else {
                    $expectedMessage = (new InvalidNotSameValueException('variableValue', $variableValue))
                        ->getMessage();

                    try {
                        new InvalidSameValueException('data', $variableValue, $anotherValue);

                        $this->fail('Not fail with: ' . $expectedMessage);
                    } catch (InvalidNotSameValueException $error) {
                        $this->assertSame($expectedMessage, $error->getMessage());
                    }
                }
            }
        }
    }

    public function testMessage()
    {
        $variableName  = 'variableName';
        $variableValue = $this->getTypeFixture(self::INT_FIXTURE);
        $anotherValue  = $this->getTypeFixture(self::BOOL_FIXTURE);

        $error = new InvalidSameValueException($variableName, $variableValue, $anotherValue);

        $this->assertSame(
            sprintf(
                'Variable "$%s" must be same as: "%s", actual value: "%s"',
                $variableName,
                print_r($anotherValue, true),
                print_r($variableValue, true)
            ),
            $error->getMessage()
        );
    }
}
