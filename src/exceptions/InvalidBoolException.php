<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidBoolException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidBoolException extends \InvalidArgumentException
{
    /**
     * @param string                               $variableName
     * @param array|float|int|null|resource|string $variableValue
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
        } elseif (is_bool($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be not "bool"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "bool", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}