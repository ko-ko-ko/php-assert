<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidNotSameValueException extends ArgumentException
{
    /**
     * @param string                        $variableName
     * @param int|float|bool|resource|array $variableValue
     * @throws InvalidNotEmptyException
     * @throws InvalidNotIntException
     * @throws InvalidNotStringException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be not same as: "%s"',
                $variableName,
                print_r($variableValue, true)
            )
        );
    }
}
