<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidFloatException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidFloatException extends \InvalidArgumentException
{
    /**
     * @param string                              $variableName
     * @param array|bool|int|null|resource|string $variableValue
     *
     * @throws \InvalidArgumentException
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
        } elseif (is_float($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be not "float"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be float, actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}