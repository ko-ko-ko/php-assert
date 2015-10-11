<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidDigitException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidDigitException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     *
     * @throws \InvalidArgumentException
     * @throws \LogicException
     */
    public function __construct($variableName, $variableValue)
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
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "digit", actual value: "%s"',
                $variableName,
                $variableValue
            )
        );
    }
}