<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidIntOrFloatException extends ArgumentException
{
    /**
     * @param string                          $variableName
     * @param array|bool|null|resource|string $variableValue
     * @throws InvalidNotIntAndNotFloatException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_int($variableValue) || is_float($variableValue)) {
            throw new InvalidNotIntAndNotFloatException('variableValue');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "int" or "float", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}