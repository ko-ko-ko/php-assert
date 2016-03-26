<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\InvalidNotStringException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class InvalidNotStringExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new InvalidNotStringException($typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMessage()
    {
        $error = new InvalidNotStringException(self::INT_FIXTURE);

        $this->assertSame(
            sprintf(
                'Variable "$%s" must be "not string"',
                self::INT_FIXTURE
            ),
            $error->getMessage()
        );
    }
}
