<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert;

use KoKoKo\assert\exceptions\ArgumentException;
use KoKoKo\assert\exceptions\ArrayKeyNotExistsException;
use KoKoKo\assert\exceptions\InvalidArrayCountException;
use KoKoKo\assert\exceptions\InvalidArrayException;
use KoKoKo\assert\exceptions\InvalidBoolException;
use KoKoKo\assert\exceptions\InvalidDigitException;
use KoKoKo\assert\exceptions\InvalidEmptyException;
use KoKoKo\assert\exceptions\InvalidFloatException;
use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidIntOrFloatOrStringException;
use KoKoKo\assert\exceptions\InvalidIntOrStringException;
use KoKoKo\assert\exceptions\InvalidNotArrayException;
use KoKoKo\assert\exceptions\InvalidNotEmptyException;
use KoKoKo\assert\exceptions\InvalidNotNullException;
use KoKoKo\assert\exceptions\InvalidNotObjectException;
use KoKoKo\assert\exceptions\InvalidNotSameValueException;
use KoKoKo\assert\exceptions\InvalidNullException;
use KoKoKo\assert\exceptions\InvalidNumericException;
use KoKoKo\assert\exceptions\InvalidRegExpPatternException;
use KoKoKo\assert\exceptions\InvalidResourceException;
use KoKoKo\assert\exceptions\InvalidSameValueException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\InvalidStringLengthException;
use KoKoKo\assert\exceptions\LengthNotBetweenException;
use KoKoKo\assert\exceptions\LengthNotGreaterException;
use KoKoKo\assert\exceptions\LengthNotLessException;
use KoKoKo\assert\exceptions\NumberNotBetweenException;
use KoKoKo\assert\exceptions\NumberNotBetweenStrictlyException;
use KoKoKo\assert\exceptions\NumberNotGreaterException;
use KoKoKo\assert\exceptions\NumberNotGreaterStrictlyException;
use KoKoKo\assert\exceptions\NumberNotLessException;
use KoKoKo\assert\exceptions\NumberNotLessStrictlyException;
use KoKoKo\assert\exceptions\NumberNotNegativeException;
use KoKoKo\assert\exceptions\NumberNotPositiveException;
use KoKoKo\assert\exceptions\StringNotMatchGlobException;
use KoKoKo\assert\exceptions\StringNotMatchRegExpException;
use KoKoKo\assert\exceptions\ValueNotInArrayException;

class Assert
{
    /** @var Assert */
    protected static $validator;

    /** @var string */
    protected static $exceptionClass;

    /** @var string */
    protected $name;

    /** @var int|float|bool|string|resource|array|null */
    protected $value;

    /**
     * Creates validator instance for variable, first fail check will throw an exception
     *
     * @param int|float|string|resource|array|null $value
     * @param string                               $name
     * @param null|string                          $exceptionClass
     * @return static
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public static function assert($value, $name = 'value', $exceptionClass = null)
    {
        if (is_object($value)) {
            throw new InvalidNotObjectException($name);
        }

        if (!is_string($name)) {
            throw new InvalidStringException('name', $name);
        }

        if ($exceptionClass!== null && !is_string($exceptionClass)) {
            throw new InvalidStringException('exceptionClass', $exceptionClass);
        }

        if (empty(self::$validator)) {
            self::$validator = new static;
        }

        self::$validator->name  = $name;
        self::$validator->value = $value;
        self::$validator->setExceptionClass($exceptionClass);

        return self::$validator;
    }

    /**
     * Return current validation value
     *
     * @return int|float|bool|string|resource|array
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * @param \Closure $callback (Assert $value)
     * @return $this
     * @throws InvalidArrayException
     * @throws InvalidIntException
     */
    public function forList(\Closure $callback)
    {
        if (!is_array($this->value)) {
            throw new InvalidArrayException($this->name, $this->value);
        }

        if (empty($this->value)) {
            return $this;
        }

        $valueAssert = clone self::$validator;

        foreach ($this->value as $key => $value) {
            $valueAssert->value = $value;
            $valueAssert->name  = sprintf("%s[%s]", $this->name, $key);

            $callback($valueAssert);
        }

        return $this;
    }

    /**
     * @param \Closure $callback (Assert $key, Assert $value)
     * @return $this
     * @throws InvalidArrayException
     */
    public function forMap(\Closure $callback)
    {
        if (!is_array($this->value)) {
            throw new InvalidArrayException($this->name, $this->value);
        }

        if (empty($this->value)) {
            return $this;
        }

        $keyAssert   = clone self::$validator;
        $valueAssert = clone self::$validator;

        foreach ($this->value as $key => $value) {
            $keyAssert->value   = $key;
            $valueAssert->value = $value;

            $keyAssert->name   = sprintf("%s: key '%s'", $this->name, $key);
            $valueAssert->name = sprintf("%s['%s']", $this->name, $key);

            $callback($keyAssert, $valueAssert);
        }

        return $this;
    }

    /**
     * @param int $length
     * @return $this
     * @throws InvalidIntException
     * @throws InvalidStringLengthException
     * @throws NumberNotPositiveException
     * @throws InvalidStringException
     * @throws \Exception|\Throwable
     */
    public function length($length)
    {
        if (!is_int($length)) {
            throw new InvalidIntException('length', $length);
        } elseif ($length < 0) {
            throw new NumberNotPositiveException('length', $length);
        }

        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
        } elseif (strlen($this->value) !== $length) {
            throw $this->buildException(new InvalidStringLengthException($this->name, $this->value, $length));
        }

        return $this;
    }

    /**
     * Soft check if value has length $from <= $length <= to. Runs only after string validation
     *
     * @param int $from
     * @param int $to
     * @return $this
     * @throws InvalidIntException
     * @throws LengthNotBetweenException
     * @throws NumberNotPositiveException
     * @throws NumberNotGreaterException
     * @throws NumberNotLessException
     * @throws InvalidStringException
     * @throws \Exception|\Throwable
     */
    public function lengthBetween($from, $to)
    {
        if (!is_int($from)) {
            throw new InvalidIntException('from', $from);
        } elseif (!is_int($to)) {
            throw new InvalidIntException('to', $to);
        } elseif ($from > $to) {
            throw new NumberNotLessException('from', $from, $to);
        } elseif ($from < 0) {
            throw new NumberNotGreaterException('from', $from, 0);
        }

        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
        }

        $length = strlen($this->value);

        if ($length < $from || $length > $to) {
            throw $this->buildException(new LengthNotBetweenException($this->name, $this->value, $from, $to));
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $length. Runs only after string validation
     *
     * @param int $length
     * @return $this
     * @throws InvalidIntException
     * @throws LengthNotLessException
     * @throws NumberNotPositiveException
     * @throws InvalidStringException
     * @throws \Exception|\Throwable
     */
    public function lengthLess($length)
    {
        if (!is_int($length)) {
            throw new InvalidIntException('length', $length);
        } elseif ($length < 0) {
            throw new NumberNotPositiveException('length', $length);
        }

        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
        } elseif (strlen($this->value) > $length) {
            throw $this->buildException(new LengthNotLessException($this->name, $this->value, $length));
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $length. Runs only after notEmpty and string validations
     *
     * @param int $length
     * @return $this
     * @throws InvalidIntException
     * @throws LengthNotGreaterException
     * @throws NumberNotPositiveException
     * @throws InvalidStringException
     * @throws \Exception|\Throwable
     */
    public function lengthGreater($length)
    {
        if (!is_int($length)) {
            throw new InvalidIntException('length', $length);
        } elseif ($length < 0) {
            throw new NumberNotPositiveException('length', $length);
        }

        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
        } elseif (strlen($this->value) < $length) {
            throw $this->buildException(new LengthNotGreaterException($this->name, $this->value, $length));
        }

        return $this;
    }

    /**
     * Check if value is in array (in_array strict)
     *
     * @param array $range
     * @return $this
     * @throws InvalidArrayException
     * @throws InvalidNotEmptyException
     * @throws ValueNotInArrayException
     * @throws \Exception|\Throwable
     */
    public function inArray($range)
    {
        if (!is_array($range)) {
            throw new InvalidArrayException('range', $range);
        } elseif (empty($range)) {
            throw new InvalidNotEmptyException('range');
        }

        if (!in_array($this->value, $range, true)) {
            throw $this->buildException(new ValueNotInArrayException($this->name, $this->value, $range));
        }

        return $this;
    }

    /**
     * Check if value is array
     *
     * @return $this
     * @throws InvalidArrayException
     * @throws \Exception|\Throwable
     */
    public function isArray()
    {
        if (!is_array($this->value)) {
            throw $this->buildException(new InvalidArrayException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if array key exists
     *
     * @param string|int $key
     * @return $this
     * @throws ArrayKeyNotExistsException
     * @throws InvalidArrayException
     * @throws InvalidIntOrStringException
     * @throws \Exception|\Throwable
     */
    public function hasKey($key)
    {
        if (!is_string($key) && !is_int($key)) {
            throw new InvalidIntOrStringException('key', $key);
        }

        if (!is_array($this->value)) {
            throw $this->buildException(new InvalidArrayException($this->name, $this->value));
        }

        if (!array_key_exists($key, $this->value)) {
            throw $this->buildException(new ArrayKeyNotExistsException($this->name, $key));
        }

        return $this;
    }

    /**
     * Check if array elements count is same as $count
     *
     * @param int $count
     * @return $this
     * @throws InvalidArrayCountException
     * @throws InvalidArrayException
     * @throws InvalidIntException
     * @throws NumberNotGreaterException
     * @throws \Exception|\Throwable
     */
    public function count($count)
    {
        if (!is_int($count)) {
            throw new InvalidIntException('count', $count);
        } elseif ($count < 0) {
            throw new NumberNotGreaterException('count', $count, 0);
        }

        if (!is_array($this->value)) {
            throw $this->buildException(new InvalidArrayException($this->name, $this->value));
        }

        if (count($this->value) !== $count) {
            throw $this->buildException(new InvalidArrayCountException($this->name, $this->value, $count));
        }

        return $this;
    }

    /**
     * Soft check that $from <= value <= $to
     *
     * @param float|int $from
     * @param float|int $to
     * @return $this
     * @throws NumberNotBetweenException
     * @throws InvalidIntOrFloatException
     * @throws NumberNotLessStrictlyException
     * @throws \Exception|\Throwable
     */
    public function between($from, $to)
    {
        if (!is_int($from) && !is_float($from)) {
            throw new InvalidIntOrFloatException('from', $from);
        } elseif (!is_int($to) && !is_float($to)) {
            throw new InvalidIntOrFloatException('to', $to);
        } elseif ($from > $to) {
            throw new NumberNotLessStrictlyException('from', $from, $to);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value < $from || $this->value > $to) {
            throw $this->buildException(new NumberNotBetweenException($this->name, $this->value, $from, $to));
        }

        return $this;
    }

    /**
     * Strict check that $from < value < $to
     *
     * @param float|int $from
     * @param float|int $to
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws NumberNotBetweenStrictlyException
     * @throws NumberNotLessStrictlyException
     * @throws \Exception|\Throwable
     */
    public function betweenStrict($from, $to)
    {
        if (!is_int($from) && !is_float($from)) {
            throw new InvalidIntOrFloatException('from', $from);
        } elseif (!is_int($to) && !is_float($to)) {
            throw new InvalidIntOrFloatException('to', $to);
        } elseif ($from > $to) {
            throw new NumberNotLessStrictlyException('from', $from, $to);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value <= $from || $this->value >= $to) {
            throw $this->buildException(new NumberNotBetweenStrictlyException($this->name, $this->value, $from, $to));
        }

        return $this;
    }

    /**
     * Check if value is boolean (is_bool)
     *
     * @return $this
     * @throws InvalidBoolException
     * @throws \Exception|\Throwable
     */
    public function bool()
    {
        if (!is_bool($this->value)) {
            throw $this->buildException(new InvalidBoolException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is digit (ctype_digit)
     *
     * @return $this
     * @throws InvalidDigitException
     * @throws InvalidStringException
     * @throws \Exception|\Throwable
     */
    public function digit()
    {
        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
        } elseif (!ctype_digit($this->value)) {
            throw $this->buildException(new InvalidDigitException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is empty (empty)
     *
     * @return $this
     * @throws InvalidEmptyException
     * @throws \Exception|\Throwable
     */
    public function isEmpty()
    {
        if (!empty($this->value)) {
            throw $this->buildException(new InvalidEmptyException($this->name));
        }

        return $this;
    }

    /**
     * Check if value is not empty (empty)
     *
     * @return $this
     * @throws InvalidNotEmptyException
     * @throws \Exception|\Throwable
     */
    public function notEmpty()
    {
        if (empty($this->value)) {
            throw $this->buildException(new InvalidNotEmptyException($this->name));
        }

        return $this;
    }

    /**
     * Check if value is float (is_float)
     *
     * @return $this
     * @throws InvalidFloatException
     * @throws \Exception|\Throwable
     */
    public function float()
    {
        if (!is_float($this->value)) {
            throw $this->buildException(new InvalidFloatException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is integer (is_int)
     *
     * @return $this
     * @throws InvalidIntException
     * @throws \Exception|\Throwable
     */
    public function int()
    {
        if (!is_int($this->value)) {
            throw $this->buildException(new InvalidIntException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Soft check that value <= $max
     *
     * @param float|int $number
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws NumberNotLessException
     * @throws \Exception|\Throwable
     */
    public function less($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value > $number) {
            throw $this->buildException(new NumberNotLessException($this->name, $this->value, $number));
        }

        return $this;
    }

    /**
     * Soft check that value >= $min
     *
     * @param float|int $number
     * @return $this
     * @throws NumberNotGreaterException
     * @throws InvalidIntOrFloatException
     * @throws \Exception|\Throwable
     */
    public function greater($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value < $number) {
            throw $this->buildException(new NumberNotGreaterException($this->name, $this->value, $number));
        }

        return $this;
    }

    /**
     * Strict check that value < $max
     *
     * @param float|int $number
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws NumberNotLessStrictlyException
     * @throws \Exception|\Throwable
     */
    public function lessStrict($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value >= $number) {
            throw $this->buildException(new NumberNotLessStrictlyException($this->name, $this->value, $number));
        }

        return $this;
    }

    /**
     * Strict check that value > $min
     *
     * @param float|int $number
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws NumberNotGreaterStrictlyException
     * @throws \Exception|\Throwable
     */
    public function greaterStrict($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value <= $number) {
            throw $this->buildException(new NumberNotGreaterStrictlyException($this->name, $this->value, $number));
        }

        return $this;
    }

    /**
     * Check if value match regexp pattern
     *
     * @param string $pattern
     * @return $this
     * @throws InvalidNotEmptyException
     * @throws InvalidRegexpPatternException
     * @throws InvalidStringException
     * @throws StringNotMatchRegExpException
     * @throws \Exception|\Throwable
     */
    public function match($pattern)
    {
        if (!is_string($pattern)) {
            throw new InvalidStringException('pattern', $pattern);
        } elseif (empty($pattern)) {
            throw new InvalidNotEmptyException('pattern');
        }

        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
        }

        // God please sorry for this @
        $checkResult = @preg_match($pattern, $this->value);

        if ((preg_last_error() !== PREG_NO_ERROR) || ($checkResult === false)) {
            throw $this->buildException(new InvalidRegExpPatternException('pattern', $pattern));
        }

        if ($checkResult === 0) {
            throw $this->buildException(new StringNotMatchRegExpException($this->name, $this->value, $pattern));
        }

        return $this;
    }

    /**
     * Check if value match glob pattern
     *
     * @param string $pattern
     * @return $this
     * @throws InvalidNotEmptyException
     * @throws InvalidStringException
     * @throws StringNotMatchGlobException
     * @throws \Exception|\Throwable
     */
    public function glob($pattern)
    {
        if (!is_string($pattern)) {
            throw new InvalidStringException('pattern', $pattern);
        } elseif (empty($pattern)) {
            throw new InvalidNotEmptyException('pattern');
        }

        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
        } elseif (!fnmatch($pattern, $this->value)) {
            throw $this->buildException(new StringNotMatchGlobException($this->name, $this->value, $pattern));
        }

        return $this;
    }

    /**
     * Check if value < 0
     *
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws NumberNotNegativeException
     * @throws \Exception|\Throwable
     */
    public function negative()
    {
        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value >= 0) {
            throw $this->buildException(new NumberNotNegativeException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value > 0
     *
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws NumberNotPositiveException
     * @throws \Exception|\Throwable
     */
    public function positive()
    {
        if (!is_int($this->value) && !is_float($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatException($this->name, $this->value));
        } elseif ($this->value <= 0) {
            throw $this->buildException(new NumberNotPositiveException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is same as $anotherValue
     *
     * @param int|float|bool|string|resource|array|null $anotherValue
     * @return $this
     * @throws InvalidNotObjectException
     * @throws InvalidSameValueException
     * @throws \Exception|\Throwable
     */
    public function isSame($anotherValue)
    {
        if (is_object($anotherValue)) {
            throw new InvalidNotObjectException('anotherValue');
        }

        if ($this->value !== $anotherValue) {
            throw $this->buildException(new InvalidSameValueException($this->name, $this->value, $anotherValue));
        }

        return $this;
    }

    /**
     * Check if value is not same as $anotherValue
     *
     * @param int|float|bool|string|resource|array|null $anotherValue
     * @return $this
     * @throws InvalidNotObjectException
     * @throws InvalidNotSameValueException
     * @throws \Exception|\Throwable
     */
    public function notSame($anotherValue)
    {
        if (is_object($anotherValue)) {
            throw new InvalidNotObjectException('anotherValue');
        }

        if ($this->value === $anotherValue) {
            throw $this->buildException(new InvalidNotSameValueException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is null
     *
     * @return $this
     * @throws InvalidNullException
     * @throws \Exception|\Throwable
     */
    public function isNull()
    {
        if (!is_null($this->value)) {
            throw $this->buildException(new InvalidNullException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is not null
     *
     * @return $this
     * @throws InvalidNotNullException
     * @throws \Exception|\Throwable
     */
    public function notNull()
    {
        if (is_null($this->value)) {
            throw $this->buildException(new InvalidNotNullException($this->name));
        }

        return $this;
    }

    /**
     * Check if value is numeric (is_numeric)
     *
     * @return $this
     * @throws InvalidIntOrFloatOrStringException
     * @throws InvalidNumericException
     * @throws \Exception|\Throwable
     */
    public function numeric()
    {
        if (!is_int($this->value) && !is_float($this->value) && !is_string($this->value)) {
            throw $this->buildException(new InvalidIntOrFloatOrStringException($this->name, $this->value));
        } elseif (!is_numeric($this->value)) {
            throw $this->buildException(new InvalidNumericException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is resource (is_resource)
     *
     * @return $this
     * @throws InvalidResourceException
     * @throws \Exception|\Throwable
     */
    public function resource()
    {
        if (!is_resource($this->value)) {
            throw $this->buildException(new InvalidResourceException($this->name, $this->value));
        }

        return $this;
    }

    /**
     * Check if value is string (is_string)
     *
     * @return $this
     * @throws InvalidStringException
     * @throws \Exception|\Throwable
     */
    public function string()
    {
        if (!is_string($this->value)) {
            throw $this->buildException(new InvalidStringException($this->name, $this->value));
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
     * @throws InvalidNotArrayException
     * @throws InvalidNumericException
     */
    public function toFloat()
    {
        if (is_array($this->value)) {
            throw new InvalidNotArrayException($this->name);
        } elseif (!empty($this->value) && !is_numeric($this->value)) {
            throw new InvalidNumericException($this->name, $this->value);
        }

        $this->value = (float) $this->value;

        return $this;
    }

    /**
     * Cast value to int. If it's not numeric - there will be fail cast
     *
     * @return $this
     * @throws InvalidNotArrayException
     * @throws InvalidNumericException
     */
    public function toInt()
    {
        if (is_array($this->value)) {
            throw new InvalidNotArrayException($this->name);
        } elseif (!empty($this->value) && !is_numeric($this->value)) {
            throw new InvalidNumericException($this->name, $this->value);
        }

        $this->value = (int) $this->value;

        return $this;
    }

    /**
     * Cast value to string. If it's array - there will be fail cast
     *
     * @return $this
     * @throws InvalidNotArrayException
     */
    public function toString()
    {
        if (is_array($this->value)) {
            throw new InvalidNotArrayException($this->name);
        }

        $this->value = (string) $this->value;

        return $this;
    }

    /**
     * Process fail validation
     *
     * @param \InvalidArgumentException $originalException
     *
     * @return \InvalidArgumentException|\Exception|\Throwable
     */
    protected function buildException(\InvalidArgumentException $originalException)
    {
        if (self::$exceptionClass) {
            return new self::$exceptionClass(
                $originalException->getMessage(),
                $originalException->getCode(),
                $originalException
            );
        }
        return $originalException;
    }

    /**
     * Return class of exception, which will be thrown on fail test
     *
     * @return string
     * @deprecated Method will be removed
     */
    public function getExceptionClass()
    {
        return self::$exceptionClass ?: ArgumentException::class;
    }

    /**
     * Update default exception class
     *
     * @param string $exceptionClass
     *
     * @return $this
     * @throws InvalidStringException|ArgumentException
     * @deprecated Method will be removed
     */
    public function setExceptionClass($exceptionClass)
    {
        if (!is_string($exceptionClass)) {
            throw new InvalidStringException('Param $exceptionClass must be string', $exceptionClass);
        }
        if (!is_a($exceptionClass, '\Exception', true) || !is_a($exceptionClass, '\Throwable', true)) {
            throw new ArgumentException('Param $exceptionClass must be subclass of \Exception or \Throwable');
        }
        self::$exceptionClass = $exceptionClass;
        return self::$validator;
    }

    /**
     * Soft check that value >= $min
     *
     * @param float|int $number
     * @return $this
     * @throws NumberNotGreaterException
     * @throws InvalidIntOrFloatException
     * @throws \Exception|\Throwable
     * @deprecated Method will be removed
     */
    public function more($number)
    {
        return $this->greater($number);
    }

    /**
     * Strict check that value > $min
     *
     * @param float|int $number
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws NumberNotGreaterStrictlyException
     * @throws \Exception|\Throwable
     * @deprecated Method will be removed
     */
    public function moreStrict($number)
    {
        return $this->greaterStrict($number);
    }

    /**
     * Soft check if value has length less than $length. Runs only after notEmpty and string validations
     *
     * @param int $length
     * @return $this
     * @throws InvalidIntException
     * @throws LengthNotGreaterException
     * @throws NumberNotPositiveException
     * @throws InvalidStringException
     * @throws \Exception|\Throwable
     * @deprecated Method will be removed
     */
    public function lengthMore($length)
    {
        return $this->lengthGreater($length);
    }
}
