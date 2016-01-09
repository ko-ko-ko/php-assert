<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class LengthNotBetweenException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     * @param int    $from
     * @param int    $to
     * @throws InvalidIntException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue, $from, $to)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_string($variableValue)) {
            throw new InvalidStringException('variableValue', $variableValue);
        } elseif (!is_int($from)) {
            throw new InvalidIntException('from', $from);
        } elseif (!is_int($to)) {
            throw new InvalidIntException('to', $to);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must have length between "%d" and "%d", actual length: "%d"',
                $variableName,
                $from,
                $to,
                mb_strlen($variableValue)
            )
        );
    }
}