<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidNotObjectException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidNotObjectException extends \InvalidArgumentException
{
    /**
     * @param string $variableName
     *
     * @throws \InvalidArgumentException
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
                'Variable "$%s" must be "not object"',
                $variableName
            )
        );
    }
}