<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidResourceException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidResourceException extends \InvalidArgumentException
{
    /**
     * @param string                           $variableName
     * @param array|bool|float|int|null|string $variableValue
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
        } elseif (is_resource($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be not "resource"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "resource", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}