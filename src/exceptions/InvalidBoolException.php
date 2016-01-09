<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidBoolException extends ArgumentException
{
    /**
     * @param string                               $variableName
     * @param array|float|int|null|resource|string $variableValue
     * @throws InvalidNotBoolException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_bool($variableValue)) {
            throw new InvalidNotBoolException($variableName);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "bool", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}