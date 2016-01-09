<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class StringNotMatchGlobException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     * @param string $pattern
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue, $pattern)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_string($variableValue)) {
            throw new InvalidStringException('variableValue', $variableValue);
        } elseif (!is_string($pattern)) {
            throw new InvalidStringException('pattern', $pattern);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must match glob pattern "%s", actual value: "%s"',
                $variableName,
                $pattern,
                $variableValue
            )
        );
    }
}