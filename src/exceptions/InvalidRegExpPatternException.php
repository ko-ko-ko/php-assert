<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidRegExpPatternException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_string($variableValue)) {
            throw new InvalidStringException('variableValue', $variableValue);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "correct RegExp pattern", actual value: "%s"',
                $variableName,
                $variableValue
            )
        );
    }
}