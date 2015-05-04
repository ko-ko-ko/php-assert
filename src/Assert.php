<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert;

/**
 * Class Assert
 */
class Assert
{
    const EXCEPTION_CLASS = '\InvalidArgumentException';

    const EXCEPTION_LENGTH_TEXT_POSITIVE = '${{variable}} must have length {{value}}';

    const EXCEPTION_TYPE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{type}}';

    const EXCEPTION_TYPE_TEXT_POSITIVE = 'Param ${{variable}} must be {{type}}';

    const EXCEPTION_VALUE_IN_ARRAY_POSITIVE = '${{variable}} out of range {{value}}';

    const EXCEPTION_VALUE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{value}}';

    const EXCEPTION_VALUE_TEXT_POSITIVE = 'Param ${{variable}} must be {{value}}';

    const EXCEPTION_VALUE_PATTERN_POSITIVE = 'Param ${{variable}} must apply pattern {{pattern}}';

    /** @var Assert */
    protected static $validator;

    /** @var string */
    protected $exceptionClass;

    /** @var string */
    protected $name;

    /** @var int|float|string|resource|array|null */
    protected $value;

    protected function __construct()
    {
    }

    /**
     * Creates validator instance for variable, first fail check will throw an exception
     *
     * @param int|float|string|resource|array|null $value
     * @param string                               $name
     * @param string                               $exceptionClass
     *
     * @return static
     * @throws \InvalidArgumentException
     */
    public static function assert($value, $name, $exceptionClass = self::EXCEPTION_CLASS)
    {
        if (is_object($value)) {
            throw new \InvalidArgumentException('Param $value must be not object');
        }

        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (empty(self::$validator)) {
            self::$validator = new static;
            self::$validator->exceptionClass = self::EXCEPTION_CLASS;
        }

        $validator = clone self::$validator;

        if ($exceptionClass !== static::EXCEPTION_CLASS) {
            $validator->setExceptionClass($exceptionClass);
        }

        $validator->name = $name;
        $validator->value = $value;

        return $validator;
    }

    /**
     * Return class of exception, which will be thrown on fail test
     *
     * @return string
     */
    public function getExceptionClass()
    {
        return $this->exceptionClass;
    }

    /**
     * Update default exception class
     *
     * @param string $exceptionClass
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setExceptionClass($exceptionClass)
    {
        if (!is_string($exceptionClass)) {
            throw new \InvalidArgumentException('Param $exceptionClass must be string');
        }

        if (!is_a($exceptionClass, '\Exception', true)) {
            throw new \InvalidArgumentException('Param $exceptionClass must be subclass of \Exception');
        }

        $this->exceptionClass = $exceptionClass;

        return $this;
    }

    /**
     * Return current validation value
     *
     * @return int|float|string|resource|array
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * @param int $length
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function length($length)
    {
        if (!is_int($length)) {
            throw new \InvalidArgumentException('Param $length must be int');
        }

        if ($length < 0) {
            throw new \InvalidArgumentException('Param $length must be more than 0');
        }

        if (!is_string($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
        }

        if (mb_strlen($this->value) !== $length) {
            throw $this->buildException(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => $length]);
        }

        return $this;
    }

    /**
     * Soft check if value has length $from <= $length <= to. Runs only after string validation
     *
     * @param int $from
     * @param int $to
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function lengthBetween($from, $to)
    {
        if (!is_int($from)) {
            throw new \InvalidArgumentException('Param $from must be int');
        }

        if (!is_int($to)) {
            throw new \InvalidArgumentException('Param $to must be int');
        }

        if ($from > $to) {
            throw new \InvalidArgumentException('Param $from must be less than $to');
        }

        if ($from < 0) {
            throw new \InvalidArgumentException('Param $from must be more than 0');
        }

        if (!is_string($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
        }

        $length = mb_strlen($this->value);

        if ($length < $from || $length > $to) {
            throw $this->buildException(
                self::EXCEPTION_LENGTH_TEXT_POSITIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $length. Runs only after string validation
     *
     * @param int $length
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function lengthLess($length)
    {
        if (!is_int($length)) {
            throw new \InvalidArgumentException('Param $length must be int');
        }

        if ($length < 0) {
            throw new \InvalidArgumentException('Param $length must be more than 0');
        }

        if (!is_string($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
        }

        if (mb_strlen($this->value) > $length) {
            throw $this->buildException(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $length]);
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $length. Runs only after notEmpty and string validations
     *
     * @param int $length
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function lengthMore($length)
    {
        if (!is_int($length)) {
            throw new \InvalidArgumentException('Param $length must be int');
        }

        if ($length < 0) {
            throw new \InvalidArgumentException('Param $length must be more than 0');
        }

        if (!is_string($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
        }

        if (mb_strlen($this->value) < $length) {
            throw $this->buildException(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $length]);
        }

        return $this;
    }

    /**
     * Check if value is in array (in_array strict)
     *
     * @param array $range
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function inArray(array $range)
    {
        if (!in_array($this->value, $range, true)) {
            throw $this->buildException(self::EXCEPTION_VALUE_IN_ARRAY_POSITIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Check if value is array
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function isArray()
    {
        if (!is_array($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Soft check that $from <= value <= $to
     *
     * @param float|int $from
     * @param float|int $to
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function between($from, $to)
    {
        if (!is_int($from) && !is_float($from)) {
            throw new \InvalidArgumentException('Param $from must be int or float');
        }

        if (!is_int($to) && !is_float($to)) {
            throw new \InvalidArgumentException('Param $to must be int or float');
        }

        if ($from > $to) {
            throw new \InvalidArgumentException('Param $from must be less than $to');
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value < $from || $this->value > $to) {
            throw $this->buildException(
                self::EXCEPTION_VALUE_TEXT_POSITIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }

    /**
     * Strict check that $from < value < $to
     *
     * @param float|int $from
     * @param float|int $to
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function betweenStrict($from, $to)
    {
        if (!is_int($from) && !is_float($from)) {
            throw new \InvalidArgumentException('Param $from must be int or float');
        }

        if (!is_int($to) && !is_float($to)) {
            throw new \InvalidArgumentException('Param $to must be int or float');
        }

        if ($from > $to) {
            throw new \InvalidArgumentException('Param $from must be less than $to');
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value <= $from || $this->value >= $to) {
            throw $this->buildException(
                self::EXCEPTION_VALUE_TEXT_POSITIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }

    /**
     * Check if value is boolean (is_bool)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function bool()
    {
        if (!is_bool($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'bool']);
        }

        return $this;
    }

    /**
     * Check if value is digit (ctype_digit)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function digit()
    {
        if (!is_string($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
        }

        if (!ctype_digit($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'digit']);
        }

        return $this;
    }

    /**
     * Check if value is empty (empty)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function isEmpty()
    {
        if (!empty($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'empty']);
        }

        return $this;
    }

    /**
     * Check if value is not empty (empty)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function notEmpty()
    {
        if (empty($this->value)) {
            throw $this->buildException(self::EXCEPTION_VALUE_TEXT_NEGATIVE, ['{{type}}' => 'empty']);
        }

        return $this;
    }

    /**
     * Check if value is float (is_float)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function float()
    {
        if (!is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'float']);
        }

        return $this;
    }

    /**
     * Check if value is integer (is_int)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function int()
    {
        if (!is_int($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int']);
        }

        return $this;
    }

    /**
     * Soft check that value <= $max
     *
     * @param float|int $number
     *
     * @return $this
     * @throws \Exception
     * @throws \InvalidArgumentException
     */
    public function less($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new \InvalidArgumentException('Param $number must be int or float');
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value > $number) {
            throw $this->buildException(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $number]);
        }

        return $this;
    }

    /**
     * Soft check that value >= $min
     *
     * @param float|int $number
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function more($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new \InvalidArgumentException('Param $number must be int or float');
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value < $number) {
            throw $this->buildException(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $number]);
        }

        return $this;
    }

    /**
     * Strict check that value < $max
     *
     * @param float|int $number
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function lessStrict($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new \InvalidArgumentException('Param $number must be int or float');
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value >= $number) {
            throw $this->buildException(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $number]);
        }

        return $this;
    }

    /**
     * Strict check that value > $min
     *
     * @param float|int $number
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function moreStrict($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new \InvalidArgumentException('Param $number must be int or float');
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value <= $number) {
            throw $this->buildException(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $number]);
        }

        return $this;
    }

    /**
     * Check if value match regexp pattern
     *
     * @param string $pattern
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function match($pattern)
    {
        if (empty($pattern)) {
            throw new \InvalidArgumentException('Param $pattern must be not empty');
        }

        if (!is_string($pattern)) {
            throw new \InvalidArgumentException('Param $pattern must be string');
        }

        // God please sorry for this @
        $checkResult = @preg_match($pattern, $this->value);

        if ((preg_last_error() !== PREG_NO_ERROR) || ($checkResult === false)) {
            throw new \InvalidArgumentException('Param $pattern must be correct RegExp');
        }

        if ($checkResult === 0) {
            throw $this->buildException(self::EXCEPTION_VALUE_PATTERN_POSITIVE, ['{{pattern}}' => $pattern]);
        }

        return $this;
    }

    /**
     * Check if value match glob pattern
     *
     * @param string $pattern
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function glob($pattern)
    {
        if (empty($pattern)) {
            throw new \InvalidArgumentException('Param $pattern must be not empty');
        }

        if (!is_string($pattern)) {
            throw new \InvalidArgumentException('Param $pattern must be string');
        }

        if (!fnmatch($pattern, $this->value)) {
            throw $this->buildException(self::EXCEPTION_VALUE_PATTERN_POSITIVE, ['{{pattern}}' => $pattern]);
        }

        return $this;
    }

    /**
     * Check if value < 0
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function negative()
    {
        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value >= 0) {
            throw $this->buildException(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'negative']);
        }

        return $this;
    }

    /**
     * Check if value > 0
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function positive()
    {
        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int or float']);
        }

        if ($this->value <= 0) {
            throw $this->buildException(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'positive']);
        }

        return $this;
    }

    /**
     * Check if value is null
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function isNull()
    {
        if (!is_null($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'null']);
        }

        return $this;
    }

    /**
     * Check if value is not null
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function notNull()
    {
        if (is_null($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'null']);
        }

        return $this;
    }

    /**
     * Check if value is numeric (is_numeric)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function numeric()
    {
        if (!is_numeric($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'numeric']);
        }

        return $this;
    }

    /**
     * Check if value is resource (is_resource)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function resource()
    {
        if (!is_resource($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'resource']);
        }

        return $this;
    }

    /**
     * Check if value is string (is_string)
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function string()
    {
        if (!is_string($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
        }

        return $this;
    }

    /**
     * Cast value to bool
     *
     * @return $this
     */
    public function toBool()
    {
        $this->value = (bool) $this->value;

        return $this;
    }

    /**
     * Cast value to float. If it's not numeric - there will be fail cast
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function toFloat()
    {
        if (is_array($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'array']);
        }

        $this->value = (float) $this->value;

        return $this;
    }

    /**
     * Cast value to int. If it's not numeric - there will be fail cast
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function toInt()
    {
        if (is_array($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'array']);
        }

        $this->value = (int) $this->value;

        return $this;
    }

    /**
     * Cast value to string. If it's simple type or has no method __toString - there will be fail cast
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function toString()
    {
        if (is_array($this->value)) {
            throw $this->buildException(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'array']);
        }

        $this->value = (string) $this->value;

        return $this;
    }

    /**
     * Process fail validation
     *
     * @param string $pattern
     * @param array  $placeholders
     *
     * @return \InvalidArgumentException
     */
    protected function buildException($pattern, $placeholders = [])
    {
        $placeholders['{{variable}}'] = $this->name;
        $placeholders['{{value}}'] = print_r($this->value, true);

        return new $this->exceptionClass(strtr($pattern, $placeholders));
    }
}
