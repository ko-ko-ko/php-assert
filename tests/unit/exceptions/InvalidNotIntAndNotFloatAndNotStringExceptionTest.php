<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidNotIntAndNotFloatAndNotStringException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidNotIntAndNotFloatAndNotStringExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidNotIntAndNotFloatAndNotStringException($typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMessage()
    {
        $error = new InvalidNotIntAndNotFloatAndNotStringException(self::STRING_FIXTURE);

        $this->assertSame(
            sprintf(
                'Variable "$%s" must be "not int" and "not float" and "not string"',
                self::STRING_FIXTURE
            ),
            $error->getMessage()
        );
    }
}
