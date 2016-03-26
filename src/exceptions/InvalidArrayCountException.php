<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidArrayCountException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param array  $variableValue
     * @param int    $count
     * @throws InvalidArrayException
     * @throws InvalidIntException
     * @throws InvalidNotEmptyException
     * @throws InvalidStringException
     * @throws NumberNotGreaterException
     */
    public function __construct($variableName, $variableValue, $count)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (!is_array($variableValue)) {
            throw new InvalidArrayException('variableValue', $variableValue);
        } elseif (!is_int($count)) {
            throw new InvalidIntException('count', $count);
        } elseif ($count < 0) {
            throw new NumberNotGreaterException('count', $count, 0);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must contain: "%d" elements, actual count: "%d"',
                $variableName,
                $count,
                count($variableValue)
            )
        );
    }
}
