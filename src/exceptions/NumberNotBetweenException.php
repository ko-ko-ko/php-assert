<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class NumberNotBetweenException extends ArgumentException
{
    /**
     * @param string    $variableName
     * @param int|float $variableValue
     * @param int|float $from
     * @param int|float $to
     * @throws InvalidIntOrFloatException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue, $from, $to)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_int($variableValue) && !is_float($variableValue)) {
            throw new InvalidIntOrFloatException('variableValue', $variableValue);
        } elseif (!is_int($from) && !is_float($from)) {
            throw new InvalidIntOrFloatException('from', $from);
        } elseif (!is_int($to) && !is_float($to)) {
            throw new InvalidIntOrFloatException('to', $to);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be between "%s" and "%s", actual value: "%s"',
                $variableName,
                (string) $from,
                (string) $to,
                (string) $variableValue
            )
        );
    }
}