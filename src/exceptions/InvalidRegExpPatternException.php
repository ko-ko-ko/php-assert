<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidRegExpPatternException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidRegExpPatternException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
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
                'Variable "$%s" must be "correct RegExp pattern", actual value: "%s"',
                $variableName,
                $variableValue
            )
        );
    }
}