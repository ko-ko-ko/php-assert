<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidGreaterException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidGreaterException extends \InvalidArgumentException
{
    /**
     * @param string    $variableName
     * @param int|float $variableValue
     * @param int|float $number
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($variableName, $variableValue, $number)
    {
        if (!is_string($variableName)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableName" must be "string", actual type: "%s"',
                    gettype($variableName)
                )
            );
        } elseif (!is_int($variableValue) && !is_float($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be "int" and "float"');
        } elseif (!is_int($number) && !is_float($number)) {
            throw new \InvalidArgumentException('Variable "$number" must be "int" or "float"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be greater than "%v", actual value: "%v"',
                $variableName,
                $number,
                $variableValue
            )
        );
    }
}