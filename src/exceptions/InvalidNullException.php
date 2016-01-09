<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidNullException extends ArgumentException
{
    /**
     * @param string $variableName
     * @param int    $variableValue
     * @throws InvalidNotNullException
     * @throws InvalidStringException
     */
    public function __construct($variableName, $variableValue)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        } elseif (is_null($variableValue)) {
            throw new InvalidNotNullException('variableValue');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "null", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}