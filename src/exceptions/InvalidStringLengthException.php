<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidStringLengthException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     * @param int    $length
     * @throws InvalidIntException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue, $length)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_string($variableValue)) {
            throw new InvalidStringException('variableValue', $variableValue);
        } elseif (!is_int($length)) {
            throw new InvalidIntException('length', $length);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must have length "%d", actual length: "%d"',
                $variableName,
                $length,
                mb_strlen($variableValue)
            )
        );
    }
}