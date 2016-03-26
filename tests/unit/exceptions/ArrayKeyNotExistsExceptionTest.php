<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\tests\unit\exceptions;

use KoKoKo\assert\exceptions\ArrayKeyNotExistsException;
use KoKoKo\assert\exceptions\InvalidIntOrStringException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\tests\BaseUnitTestCase;

class ArrayKeyNotExistsExceptionTest extends BaseUnitTestCase
{
    public function testConstructWithVariableName()
    {
        $fixtures = $this->getTypeFixturesWithout([self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidStringException('variableName', $typeValue))->getMessage();

            try {
                new ArrayKeyNotExistsException($typeValue, 'variableName');

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testConstructWithKey()
    {
        $fixtures = $this->getTypeFixturesWithout([self::INT_FIXTURE, self::STRING_FIXTURE]);

        foreach ($fixtures as $typeName => $typeValue) {
            $expectedMessage = (new InvalidIntOrStringException('key', $typeValue))->getMessage();

            try {
                new ArrayKeyNotExistsException('variableName', $typeValue);

                $this->fail('Not fail with: ' . $expectedMessage);
            } catch (InvalidIntOrStringException $error) {
                $this->assertSame($expectedMessage, $error->getMessage());
            }
        }
    }

    public function testMessage()
    {
        $variableName = 'variableName';
        $key          = 'keyName';
        $error        = new ArrayKeyNotExistsException($variableName, $key);

        $this->assertSame(
            sprintf(
                'Variable "$%s" must contain key: "%s"',
                $variableName,
                $key
            ),
            $error->getMessage()
        );
    }
}
