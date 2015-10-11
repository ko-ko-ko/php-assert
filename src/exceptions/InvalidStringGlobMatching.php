<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidStringGlobMatching
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidStringGlobMatching extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     * @param string $pattern
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($variableName, $variableValue, $pattern)
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
                    gettype($variableName)
                )
            );
        } elseif (!is_string($pattern)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$pattern" must be "string", actual type: "%s"',
                    gettype($pattern)
                )
            );
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must match glob pattern: "%s", actual value: "%s"',
                $variableName,
                $pattern,
                $variableValue
            )
        );
    }
}