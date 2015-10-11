<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidLengthBetweenException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidLengthBetweenException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @param string $variableValue
     * @param int    $from
     * @param int    $to
     *
     * @throws \InvalidArgumentException
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
        } elseif (!is_string($variableValue)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$variableValue" must be "string", actual type: "%s"',
                    gettype($variableValue)
                )
            );
        } elseif (!is_int($from)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$from" must be "int", actual type: "%s"',
                    gettype($from)
                )
            );
        } elseif (!is_int($to)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Variable "$to" must be "int", actual type: "%s"',
                    gettype($to)
                )
            );
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must have length between "%d" and "%d", actual length: "%d"',
                $variableName,
                $from,
                $to,
                mb_strlen($variableValue)
            )
        );
    }
}