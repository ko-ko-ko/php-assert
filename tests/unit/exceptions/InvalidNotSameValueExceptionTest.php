<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidNotSameValueException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidNotSameValueExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidNotSameValueException($typeValue, 'data');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMessage()
    {
        $variableName = 'variableName';
        $fixtures     = $this->getTypeFixtures();

        foreach ($fixtures as $typeName => $typeValue) {
            $error = new InvalidNotSameValueException($variableName, $typeValue);

            $this->assertSame(
                sprintf(
                    'Variable "$%s" must be not same as: "%s"',
                    $variableName,
                    print_r($typeValue, true)
                ),
                $error->getMessage()
            );
        }
    }
}
