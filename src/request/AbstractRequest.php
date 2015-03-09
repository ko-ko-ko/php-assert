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

    /** @type bool */
    protected $skipOnErrors;

    /** @type bool */
    protected $throwException = true;

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

        if ($this->throwException) {
            return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass);
        }

        return Cast::validate($this->getParam($name, $default), $name, $this->skipOnErrors);
    }

    /**
     * @param bool $skipOnError
     */
    public function setSoft($skipOnError = true)
    {
        if (!is_bool($skipOnError)) {
            throw new \InvalidArgumentException('Param $skipOnError must be bool');
        }

        $this->throwException = false;
        $this->skipOnErrors = $skipOnError;
    }

    /**
     * @param string $exceptionClass
     */
    public function setStrict($exceptionClass = Cast::EXCEPTION_CLASS)
    {
        if (($exceptionClass !== Cast::EXCEPTION_CLASS) && (!is_subclass_of($exceptionClass, '\Exception'))) {
            throw new \InvalidArgumentException('Param $exceptionClass must be subclass of \Exception');
        }

        $this->throwException = true;
        $this->exceptionClass = $exceptionClass;
    }

    /**
     * @param string $name
     * @param bool   $default
     *
     * @return $this|Cast
     */
    public function toBool($name, $default = false)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_bool($default)) {
            throw new \InvalidArgumentException('Param $default must be bool');
        }

        if ($this->throwException) {
            return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toBool($default);
        }

        return Cast::validate($this->getParam($name, $default), $name, $this->skipOnErrors)->toBool($default);
    }

    /**
     * @param string $name
     * @param float  $default
     *
     * @return Cast
     */
    public function toFloat($name, $default = (float)0)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_bool($default)) {
            throw new \InvalidArgumentException('Param $default must be bool');
        }

        if ($this->throwException) {
            return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toFloat($default);
        }

        return Cast::validate($this->getParam($name, $default), $name, $this->skipOnErrors)->toFloat($default);
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

        if ($this->throwException) {
            return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toInt($default);
        }

        return Cast::validate($this->getParam($name, $default), $name, $this->skipOnErrors)->toInt($default);
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

        if ($this->throwException) {
            return Cast::assert($this->getParam($name, $default), $name, $this->exceptionClass)->toString($default);
        }

        return Cast::validate($this->getParam($name, $default), $name, $this->skipOnErrors)->toString($default);
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return null
     */
    abstract protected function getParam($name, $default = null);
}
