<?php

namespace KoKoKo\assert\exceptions;

/**
 * Class InvalidNotArrayException
 *
 * @package KoKoKo\assert\exceptions
 */
class InvalidNotArrayException extends \InvalidArgumentException
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
                'Variable "$%s" must be "not array"',
                $variableName
            )
        );
    }
}