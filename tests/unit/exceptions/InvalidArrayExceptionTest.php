<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidArrayException;
use KoKoKo\assert\exceptions\InvalidNotArrayException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidArrayExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidArrayException($typeValue, 'variableName');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithVariableValue()
    {
        $fixtureName     = self::ARRAY_FIXTURE;
        $expectedMessage = (new InvalidNotArrayException('variableValue'))->getMessage();

        try {
            new InvalidArrayException('variableName', $this->getTypeFixture($fixtureName));

            $this->fail('Not fail with: ' . $expectedMessage);
        } catch (InvalidNotArrayException $error) {
            $this->assertSame($expectedMessage, $error->getMessage());
        }

        foreach ($this->getTypeFixturesWithout([$fixtureName]) as $typeName => $typeValue) {
            new InvalidArrayException('variableName', $typeValue);
        }
    }

    public function testMessage()
    {
        $fixtures = $this->getTypeFixturesWithout([self::ARRAY_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidArrayException($typeName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be "array", actual type: "%s"',
                    $typeName,
                    gettype($typeValue)
                ),
                $error->getMessage()
            );
        }
    }
}
