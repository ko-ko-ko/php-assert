<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidNegativeException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidNegativeException extends \InvalidArgumentException
{
    /**
     * @param string    $variableName
     * @param int|float $variableValue
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
        } elseif (!is_int($variableValue) && !is_float($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be not "int" and not "float"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "negative", actual value: "%v"',
                $variableName,
                $variableValue
            )
        );
    }
}