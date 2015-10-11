<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidInArrayException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidInArrayException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @param mixed  $variableValue
     * @param array  $array
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($variableName, $variableValue, $array)
    {
        if (!is_string($variableName)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableName" must be "string", actual type: "%s"',
                    gettype($variableName)
                )
            );
        } elseif (!is_array($array)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$array" must be "array", actual type: "%s"',
                    gettype($array)
                )
            );
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