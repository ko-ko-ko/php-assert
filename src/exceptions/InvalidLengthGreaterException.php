<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidLengthGreaterException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidLengthGreaterException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     * @param int    $length
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($variableName, $variableValue, $length)
    {
        if (!is_string($variableName)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableName" must be "string", actual type: "%s"',
                    gettype($variableName)
                )
            );
        } elseif (!is_string($variableValue)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableValue" must be "string", actual type: "%s"',
                    gettype($variableValue)
                )
            );
        } elseif (!is_int($length)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$length" must be "int", actual type: "%s"',
                    gettype($length)
                )
            );
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must have length greater than "%d", actual length: "%d"',
                $variableName,
                $length,
                mb_strlen($variableValue)
            )
        );
    }
}