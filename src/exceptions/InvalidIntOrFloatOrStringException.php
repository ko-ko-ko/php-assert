<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidIntOrFloatOrStringException extends ArgumentException
{
    /**
     * @param string                          $variableName
     * @param array|bool|null|resource|string $variableValue
     * @throws InvalidNotIntAndNotFloatAndNotStringException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_int($variableValue) || is_float($variableValue) || is_string($variableValue)) {
            throw new InvalidNotIntAndNotFloatAndNotStringException('variableValue');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "int" or "float" or "string", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}