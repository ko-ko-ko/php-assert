<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidBetweenException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidBetweenException extends \InvalidArgumentException
{
    /**
     * @param string    $variableName
     * @param int|float $variableValue
     * @param int|float $from
     * @param int|float $to
     *
     * @throws \InvalidArgumentException
     * @throws \LogicException
     */
    public function __construct($variableName, $variableValue, $from, $to)
    {
        if (!is_string($variableName)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableName" must be "string", actual type: "%s"',
                    gettype($variableName)
                )
            );
        } elseif (!is_int($variableValue) && !is_float($variableValue)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableValue" must be "int" or "float", actual type: "%s"',
                    gettype($variableName)
                )
            );
        } elseif (!is_int($from) && !is_float($from)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$from" must be "int" or "float", actual type: "%s"',
                    gettype($from)
                )
            );
        } elseif (!is_int($to) && !is_float($to)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$to" must be "int" or "float", actual type: "%s"',
                    gettype($to)
                )
            );
        }


        parent::__construct(
            sprintf(
                'Variable "$%s" must be between "%s" and "%s", actual value: "%s"',
                $variableName,
                strval($from),
                strval($to),
                strval($variableValue)
            )
        );
    }
}