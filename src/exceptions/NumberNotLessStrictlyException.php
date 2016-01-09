<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class NumberNotLessStrictlyException extends ArgumentException
{
    /**
     * @param string    $variableName
     * @param int|float $variableValue
     * @param int|float $number
     * @throws InvalidIntOrFloatException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue, $number)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_int($variableValue) && !is_float($variableValue)) {
            throw new InvalidIntOrFloatException('variableValue', $variableValue);
        } elseif (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be strictly less than "%s", actual value: "%s"',
                $variableName,
                (string) $number,
                (string) $variableValue
            )
        );
    }
}