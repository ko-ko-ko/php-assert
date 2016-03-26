<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class ArrayKeyNotExistsException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param string $key
     * @throws InvalidIntOrStringException
     * @throws InvalidNotEmptyException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $key)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_int($key) && !is_string($key)) {
            throw new InvalidIntOrStringException('key', $key);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must contain key: "%s"',
                $variableName,
                $key
            )
        );
    }
}
