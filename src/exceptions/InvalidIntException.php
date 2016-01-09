<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidIntException extends ArgumentException
{
    /**
     * @param string                                $variableName
     * @param array|bool|float|null|resource|string $variableValue
     * @throws InvalidNotIntException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_int($variableValue)) {
            throw new InvalidNotIntException('variableValue');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "int", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}