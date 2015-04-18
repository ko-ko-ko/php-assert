<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */

namespace index0h\validator;

/**
 * Class Variable
 */
class Variable
{
    const EXCEPTION_CAST_TEXT = 'Can not cast ${{variable}} to {{type}}';

    const EXCEPTION_CLASS = '\InvalidArgumentException';

    const EXCEPTION_LENGTH_TEXT_NEGATIVE = '${{variable}} must have not length {{value}}';

    const EXCEPTION_LENGTH_TEXT_POSITIVE = '${{variable}} must have length {{value}}';

    const EXCEPTION_TYPE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{type}}';

    const EXCEPTION_TYPE_TEXT_POSITIVE = 'Param ${{variable}} must be {{type}}';

    const EXCEPTION_VALUE_IN_ARRAY_NEGATIVE = '${{variable}} must be not in range {{value}}';

    const EXCEPTION_VALUE_IN_ARRAY_POSITIVE = '${{variable}} out of range {{value}}';

    const EXCEPTION_VALUE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{value}}';

    const EXCEPTION_VALUE_TEXT_POSITIVE = 'Param ${{variable}} must be {{value}}';

    /** @var Variable */
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
     * @return Variable
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
     * Check if value is in array (in_array strict)
     *
     * @param array $range
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isInArray(array $range)
    {
        if (!in_array($this->value, $range, true)) {
            $this->processError(self::EXCEPTION_VALUE_IN_ARRAY_POSITIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Check if value is not in array (in_array strict)
     *
     * @param array $range
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotInArray(array $range)
    {
        if (in_array($this->value, $range, true)) {
            $this->processError(self::EXCEPTION_VALUE_IN_ARRAY_NEGATIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Check if value is array
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isArray()
    {
        if (!is_array($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Check if value is not an array
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotArray()
    {
        if (is_array($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Soft check that $from <= value <= $to
     *
     * @param float|int $from
     * @param float|int $to
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isBetween($from, $to)
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

        $this->isNumeric()->isNotString();

        if ($this->value < $from || $this->value > $to) {
            $this->processError(
                self::EXCEPTION_VALUE_TEXT_POSITIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }

    /**
     * Soft check that value $from >= or $to <= value
     *
     * @param float|int $from
     * @param float|int $to
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotBetween($from, $to)
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

        $this->isNumeric()->isNotString();

        if ($this->value > $from && $this->value < $to) {
            $this->processError(
                self::EXCEPTION_VALUE_TEXT_NEGATIVE,
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
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isBetweenStrict($from, $to)
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

        $this->isNumeric()->isNotString();

        if ($this->value <= $from || $this->value >= $to) {
            $this->processError(
                self::EXCEPTION_VALUE_TEXT_POSITIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }


    /**
     * Soft check that value $from > or $to < value
     *
     * @param float|int $from
     * @param float|int $to
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotBetweenStrict($from, $to)
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

        $this->isNumeric()->isNotString();

        if ($this->value >= $from && $this->value <= $to) {
            $this->processError(
                self::EXCEPTION_VALUE_TEXT_NEGATIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }

    /**
     * Check if value is boolean (is_bool)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isBool()
    {
        if (!is_bool($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'bool']);
        }

        return $this;
    }

    /**
     * Check if value is not boolean (is_bool)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotBool()
    {
        if (is_bool($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'bool']);
        }

        return $this;
    }

    /**
     * Check if value is digit (ctype_digit)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isDigit()
    {
        if (!ctype_digit($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'digit']);
        }

        return $this;
    }

    /**
     * Check if value is not digit (ctype_digit)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotDigit()
    {
        if (ctype_digit($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'digit']);
        }

        return $this;
    }

    /**
     * Check if value is empty (empty)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isEmpty()
    {
        if (!empty($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'empty']);
        }

        return $this;
    }

    /**
     * Check if value is not empty (empty)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotEmpty()
    {
        if (empty($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'empty']);
        }

        return $this;
    }

    /**
     * Check if value is float (is_float)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isFloat()
    {
        if (!is_float($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'float']);
        }

        return $this;
    }

    /**
     * Check if value is not float (is_float)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotFloat()
    {
        if (is_float($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'float']);
        }

        return $this;
    }

    /**
     * Check if value is integer (is_int)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isInt()
    {
        if (!is_int($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int']);
        }

        return $this;
    }

    /**
     * Check if value is not integer (is_int)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotInt()
    {
        if (is_int($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'int']);
        }

        return $this;
    }

    /**
     * Check if value is json. Run only after isNotEmpty and isString validators
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isJson()
    {
        $this->isString();

        json_decode($this->value);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
        }

        return $this;
    }

    /**
     * Check if value is not json. Run only after isNotEmpty and isString validators
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotJson()
    {
        $this->isNotEmpty()->isString();

        json_decode($this->value);

        if (json_last_error() === JSON_ERROR_NONE) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
        }

        return $this;
    }

    /**
     * Soft check if value has length $from <= $length <= to. Runs only after isString validation
     *
     * @param int $from
     * @param int $to
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isLengthBetween($from, $to)
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

        $this->isString();

        $length = mb_strlen($this->value);

        if ($length < $from || $length > $to) {
            $this->processError(
                self::EXCEPTION_LENGTH_TEXT_POSITIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }

    /**
     * Soft check if value has length $length <= $from or $length >= to. Runs only after isString validation
     *
     * @param int $from
     * @param int $to
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isLengthNotBetween($from, $to)
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

        $this->isString();

        $length = mb_strlen($this->value);

        if ($length > $from && $length < $to) {
            $this->processError(
                self::EXCEPTION_LENGTH_TEXT_NEGATIVE,
                ['{{value}}' => 'between ' . $from . ' and ' . $to]
            );
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $maxLength. Runs only after isString validation
     *
     * @param int $maxLength
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isLengthLess($maxLength)
    {
        if (!is_int($maxLength)) {
            throw new \InvalidArgumentException('Param $maxLength must be int');
        }

        if ($maxLength < 0) {
            throw new \InvalidArgumentException('Param $maxLength must be more than 0');
        }

        $this->isString();

        if (mb_strlen($this->value) > $maxLength) {
            $this->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $maxLength]);
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $minLength. Runs only after isNotEmpty and isString validations
     *
     * @param int $minLength
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isLengthMore($minLength)
    {
        if (!is_int($minLength)) {
            throw new \InvalidArgumentException('Param $minLength must be int');
        }

        if ($minLength < 0) {
            throw new \InvalidArgumentException('Param $minLength must be more than 0');
        }

        $this->isNotEmpty()->isString();

        if (mb_strlen($this->value) < $minLength) {
            $this->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $minLength]);
        }

        return $this;
    }

    /**
     * Soft check that value <= $max
     *
     * @param float|int $max
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isLess($max)
    {
        if (!is_int($max) && !is_float($max)) {
            throw new \InvalidArgumentException('Param $max must be int or float');
        }

        $this->isNumeric()->isNotString();

        if ($this->value > $max) {
            $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $max]);
        }

        return $this;
    }

    /**
     * Soft check that value >= $min
     *
     * @param float|int $min
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isMore($min)
    {
        if (!is_int($min) && !is_float($min)) {
            throw new \InvalidArgumentException('Param $min must be int or float');
        }

        $this->isNumeric()->isNotString();

        if ($this->value < $min) {
            $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $min]);
        }

        return $this;
    }

    /**
     * Strict check that value < $max
     *
     * @param float|int $max
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isLessStrict($max)
    {
        if (!is_int($max) && !is_float($max)) {
            throw new \InvalidArgumentException('Param $max must be int or float');
        }

        $this->isNumeric()->isNotString();

        if ($this->value >= $max) {
            $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $max]);
        }

        return $this;
    }

    /**
     * Strict check that value > $min
     *
     * @param float|int $min
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isMoreStrict($min)
    {
        if (!is_int($min) && !is_float($min)) {
            throw new \InvalidArgumentException('Param $min must be int or float');
        }

        $this->isNumeric()->isNotString();

        if ($this->value <= $min) {
            $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $min]);
        }

        return $this;
    }

    /**
     * Check if value < 0
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNegative()
    {
        $this->isNumeric()->isNotString();

        if ($this->value >= 0) {
            $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'negative']);
        }

        return $this;
    }

    /**
     * Check if value > 0
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isPositive()
    {
        $this->isNumeric()->isNotString();

        if ($this->value <= 0) {
            $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'positive']);
        }

        return $this;
    }

    /**
     * Check if value is numeric (is_numeric)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNumeric()
    {
        if (!is_numeric($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'numeric']);
        }

        return $this;
    }

    /**
     * Check if value is not numeric (is_numeric)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotNumeric()
    {
        if (is_numeric($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'numeric']);
        }

        return $this;
    }

    /**
     * Check if value is resource (is_resource)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isResource()
    {
        if (!is_resource($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'resource']);
        }

        return $this;
    }

    /**
     * Check if value is not resource (is_resource)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotResource()
    {
        if (is_resource($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'resource']);
        }

        return $this;
    }

    /**
     * Check if value is string (is_string)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isString()
    {
        if (!is_string($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
        }

        return $this;
    }

    /**
     * Check if value is not string (is_string)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isNotString()
    {
        if (is_string($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'string']);
        }

        return $this;
    }

    /**
     * Cast value to bool
     *
     * @return Variable
     */
    public function toBool()
    {
        $this->value = boolval($this->value);

        return $this;
    }

    /**
     * Cast value to float. If it's not numeric - there will be fail cast
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toFloat()
    {
        $this->value = floatval($this->value);

        return $this;
    }

    /**
     * Cast value to int. If it's not numeric - there will be fail cast
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toInt()
    {
        $this->value = intval($this->value);

        return $this;
    }

    /**
     * Cast value to string. If it's simple type or has no method __toString - there will be fail cast
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toString()
    {
        $this->value = strval($this->value);

        return $this;
    }

    /**
     * Process fail validation
     *
     * @param string $pattern
     * @param array  $placeholders
     *
     * @throws \InvalidArgumentException
     */
    protected function processError($pattern, $placeholders = [])
    {
        $placeholders['{{variable}}'] = $this->name;
        $placeholders['{{value}}'] = print_r($this->value, true);

        throw new $this->exceptionClass(strtr($pattern, $placeholders));
    }
}
