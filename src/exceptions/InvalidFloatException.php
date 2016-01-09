<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidFloatException extends ArgumentException
{
    /**
     * @param string                              $variableName
     * @param array|bool|int|null|resource|string $variableValue
     * @throws InvalidNotFloatException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_float($variableValue)) {
            throw new InvalidNotFloatException('variableValue');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "float", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}