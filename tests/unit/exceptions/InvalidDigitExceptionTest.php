<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidDigitException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidDigitExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidDigitException($typeValue, 'data');

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
                new InvalidDigitException('variableName', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }

        new InvalidDigitException('variableValue', $this->getTypeFixture(self::STRING_FIXTURE));
    }

    public function testMessage()
    {
        $fixture = $this->getTypeFixture(self::STRING_FIXTURE);
        $error   = new InvalidDigitException('variableName', $fixture);

        $this->assertSame(
            sprintf(
                'Variable "$variableName" must be "digit", actual value: "%s"',
                $fixture
            ),
            $error->getMessage()
        );
    }
}
