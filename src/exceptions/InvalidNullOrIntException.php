<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidNullOrIntException extends ArgumentException
{
    /**
     * @param string                           $variableName
     * @param string|float|bool|resource|array $variableValue
     * @throws InvalidNotEmptyException
     * @throws InvalidNotNullAndNotIntException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_null($variableValue) || is_int($variableValue)) {
            throw new InvalidNotNullAndNotIntException($variableName);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be: "null" or "int", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}
