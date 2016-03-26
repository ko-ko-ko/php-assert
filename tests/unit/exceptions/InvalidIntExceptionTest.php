<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidNotIntException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidIntExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidIntException($typeValue, 'variableValue');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtureName     = self::INT_FIXTURE;
        $expectedMessage = (new InvalidNotIntException('variableValue'))->getMessage();

        try {
            new InvalidIntException('variableName', $this->getTypeFixture($fixtureName));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotIntException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        foreach ($this->getTypeFixturesWithout([$fixtureName]) as $typeName => $typeValue) {
            new InvalidIntException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidIntException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be "int", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}
