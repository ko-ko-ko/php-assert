<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\request;

use index0h\validator\Cast;

/**
 * Class AbstractRequest
 */
abstract class AbstractRequest implements RequestInterface
{
    /** @type string */
    protected $exceptionClass = Cast::EXCEPTION_CLASS;

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return null
     */
    abstract protected function getParam($name, $default = null);

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return Cast
     */
    public function get($name, $default = null)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass);
    }

    /**
     * @return string
     */
    public function getExceptionClass()
    {
        return $this->exceptionClass;
    }

    /**
     * @param string $name
     * @param bool   $default
     *
     * @return Cast
     */
    public function toBool($name, $default = false)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_bool($default)) {
            throw new \InvalidArgumentException('Param $default must be bool');
        }

        return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toBool($default);
    }

    /**
     * @param string $name
     * @param float  $default
     *
     * @return Cast
     */
    public function toFloat($name, $default = 0.0)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_float($default)) {
            throw new \InvalidArgumentException('Param $default must be bool');
        }

        return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toFloat($default);
    }

    /**
     * @param string $name
     * @param int    $default
     *
     * @return Cast
     */
    public function toInt($name, $default = 0)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_int($default)) {
            throw new \InvalidArgumentException('Param $default must be int');
        }

        return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toInt($default);
    }

    /**
     * @param string $name
     * @param string $default
     *
     * @return Cast
     */
    public function toString($name, $default = '')
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_string($default)) {
            throw new \InvalidArgumentException('Param $default must be string');
        }

        return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toString($default);
    }
}
