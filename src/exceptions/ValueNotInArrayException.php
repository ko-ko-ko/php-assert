<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class ValueNotInArrayException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param mixed  $variableValue
     * @param array  $array
     * @throws InvalidArrayException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue, $array)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_array($array)) {
            throw new InvalidArrayException('array', $array);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "in array" {%s}, actual value: "%s"',
                $variableName,
                print_r($array, true),
                print_r($variableValue, true)
            )
        );
    }
}