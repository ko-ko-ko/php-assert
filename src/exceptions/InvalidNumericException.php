<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidNumericException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidNumericException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @param int    $variableValue
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
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "numeric", actual value: "%v"',
                $variableName,
                $variableValue
            )
        );
    }
}