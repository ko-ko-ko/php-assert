<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidIntOrStringException extends ArgumentException
{
    /**
     * @param string                        $variableName
     * @param int|float|bool|resource|array $variableValue
     * @throws InvalidNotIntAndNotStringException
     * @throws InvalidNotEmptyException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_int($variableValue) || is_string($variableValue)) {
            throw new InvalidNotIntAndNotStringException($variableName);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be: "int" or "string", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}
