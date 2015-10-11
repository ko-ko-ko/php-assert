<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidEmptyException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidEmptyException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     * @throws \InvalidArgumentException
     * @throws \LogicException
     */
    public function __construct($variableName)
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
                'Variable "$%s" must be "empty"',
                $variableName
            )
        );
    }
}