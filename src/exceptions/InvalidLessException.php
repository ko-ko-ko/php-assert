<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidLessException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidLessException extends \InvalidArgumentException
{
    /**
     * @param string    $variableName
     * @param int|float $variableValue
     * @param int|float $number
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($variableName, $variableValue, $number)
    {
        if (!is_string($variableName)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableName" must be "string", actual type: "%s"',
                    gettype($variableName)
                )
            );
        } elseif (!is_int($variableValue) && !is_float($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be "int" and "float"');
        } elseif (!is_int($number) && !is_float($number)) {
            throw new \InvalidArgumentException('Variable "$number" must be "int" or "float"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be less than "%v", actual value: "%v"',
                $variableName,
                $number,
                $variableValue
            )
        );
    }
}