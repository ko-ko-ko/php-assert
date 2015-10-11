<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidStringException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidStringException extends \InvalidArgumentException
{
    /**
     * @param string                             $variableName
     * @param array|bool|float|int|null|resource $variableValue
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
        } elseif (is_string($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be not "string"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "string", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}