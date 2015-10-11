<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidArrayException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidArrayException extends \InvalidArgumentException
{
    /**
     * @param string                              $variableName
     * @param bool|float|int|null|resource|string $variableValue
     *
     * @throws \InvalidArgumentException
     * @throws \LogicException
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
        } elseif (is_array($variableValue)) {
            throw new \InvalidArgumentException('Variable "$variableValue" must be not "array"');
        }

        parent::__construct(
            sprintf(
                'Variable "$%s" must be "array", actual type: "%s"',
                $variableName,
                gettype($variableValue)
            )
        );
    }
}