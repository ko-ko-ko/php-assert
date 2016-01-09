<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidNumericException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param int    $variableValue
     * @throws InvalidIntOrFloatOrStringException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_int($variableValue) && !is_float($variableValue) && !is_string($variableValue)) {
            throw new InvalidIntOrFloatOrStringException('variableValue', $variableValue);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "numeric", actual value: "%s"',
                $variableName,
                (string) $variableValue
            )
        );
    }
}