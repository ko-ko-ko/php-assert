<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

class InvalidNotArrayException extends ArgumentException
{
    /**
     * @param string $variableName
     * @throws InvalidStringException
     */
    public function __construct($variableName)
    {
        if (!is_string($variableName)) {
            throw new InvalidStringException('variableName', $variableName);
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "not array"',
                $variableName
            )
        );
    }
}