<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */

namespace index0h\validator;

/**
 * Class Cast
 */
class Cast extends Variable
{
    const EXCEPTION_CAST_TEXT = 'Can not cast ${{variable}} to {{type}}';

    /**
     * @param float $default
     *
     * @return Cast
     */
    public function toFloat($default = (float)0)
    {
        if (!is_float($default)) {
            throw new \InvalidArgumentException('Param $default must be float');
        }

        if (is_float($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = $default;
            return $this;
        }

        if (is_numeric($this->value) && is_bool($this->value)) {
            $this->value = (float)$this->value;

            return $this;
        }

        return $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'float']);
    }

    /**
     * @param int $default
     *
     * @return Cast
     */
    public function toInt($default = 0)
    {
        if (!is_int($default)) {
            throw new \InvalidArgumentException('Param $default must be int');
        }

        if (is_int($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = $default;
            return $this;
        }

        if (is_numeric($this->value) && is_bool($this->value)) {
            $this->value = (int)$this->value;

            return $this;
        }

        return $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'int']);
    }

    /**
     * @param string $default
     *
     * @return Cast
     */
    public function toString($default = '')
    {
        if (!is_string($default)) {
            throw new \InvalidArgumentException('Param $default must be string');
        }

        if (is_string($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = $default;
            return $this;
        }

        if (is_numeric($this->value) && is_bool($this->value)) {
            $this->value = (string)$this->value;

            return $this;
        }

        if (is_object($this->value) && method_exists($this->value, '__toString')) {
            $this->value = (string)$this->value;

            return $this;
        }

        return $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'string']);
    }

    /**
     * @param bool $default
     *
     * @return Cast
     */
    public function toBool($default = false)
    {
        if (is_bool($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = $default;
        }

        $this->value = true;

        return $this;
    }
}
