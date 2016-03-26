<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidSameValueException extends ArgumentException
{
    /**
     * @param string                        $variableName
     * @param int|float|bool|resource|array $variableValue
     * @param int|float|bool|resource|array $anotherValue
     * @throws InvalidNotEmptyException
     * @throws InvalidStringException
     * @throws InvalidNotSameValueException
     */
    public function __construct($variableName, $variableValue, $anotherValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif ($variableValue === $anotherValue) {
            throw new InvalidNotSameValueException('variableValue', $variableValue);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be same as: "%s", actual value: "%s"',
                $variableName,
                print_r($anotherValue, true),
                print_r($variableValue, true)
            )
        );
    }
}
