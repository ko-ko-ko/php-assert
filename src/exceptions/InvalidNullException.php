<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidNullException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidNullException extends \InvalidArgumentException
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
        } elseif (!is_null($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be "null"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "null", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}