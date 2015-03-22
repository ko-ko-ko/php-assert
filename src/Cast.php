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
    const DEFAULT_CAST_BOOL = false;

    const DEFAULT_CAST_FLOAT = 0.0;

    const DEFAULT_CAST_INT = 0;

    const DEFAULT_CAST_STRING = '';

    const EXCEPTION_CAST_TEXT = 'Can not cast ${{variable}} to {{type}}';

    /**
     * Cast value to boll. If it's not empty and not bool - result will be true
     *
     * @param bool $default
     *
     * @return Cast
     */
    public function toBool($default = self::DEFAULT_CAST_BOOL)
    {
        if (!is_bool($default)) {
            throw new \InvalidArgumentException('Param $default must be bool');
        }

        if (is_bool($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = $default;
        }

        $this->value = true;

        return $this;
    }

    /**
     * Cast value to float. If it's not numeric - there will be fail cast
     *
     * @param float $default
     *
     * @return Cast
     */
    public function toFloat($default = self::DEFAULT_CAST_FLOAT)
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

        if (is_numeric($this->value) || is_bool($this->value)) {
            $this->value = (float) $this->value;

            return $this;
        }

        return $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'float']);
    }

    /**
     * Cast value to int. If it's not numeric - there will be fail cast
     *
     * @param int $default
     *
     * @return Cast
     */
    public function toInt($default = self::DEFAULT_CAST_INT)
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

        if (is_numeric($this->value) || is_bool($this->value)) {
            $this->value = (int) $this->value;

            return $this;
        }

        return $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'int']);
    }

    /**
     * Cast value to string. If it's simple type or has no method __toString - there will be fail cast
     *
     * @param string $default
     *
     * @return Cast
     */
    public function toString($default = self::DEFAULT_CAST_STRING)
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

        if (is_numeric($this->value) || is_bool($this->value)) {
            $this->value = (string) $this->value;

            return $this;
        }

        if (is_object($this->value) && method_exists($this->value, '__toString')) {
            $this->value = (string) $this->value;

            return $this;
        }

        return $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'string']);
    }
}
