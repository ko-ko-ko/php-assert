<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

namespace KoKoKo\assert;

use KoKoKo\assert\exceptions\InvalidArrayException;
use KoKoKo\assert\exceptions\InvalidBetweenException;
use KoKoKo\assert\exceptions\InvalidBoolException;
use KoKoKo\assert\exceptions\InvalidDigitException;
use KoKoKo\assert\exceptions\InvalidEmptyException;
use KoKoKo\assert\exceptions\InvalidFloatException;
use KoKoKo\assert\exceptions\InvalidGreaterException;
use KoKoKo\assert\exceptions\InvalidInArrayException;
use KoKoKo\assert\exceptions\InvalidIntOrFloatException;
use KoKoKo\assert\exceptions\InvalidLengthBetweenException;
use KoKoKo\assert\exceptions\InvalidLengthException;
use KoKoKo\assert\exceptions\InvalidLengthGreaterException;
use KoKoKo\assert\exceptions\InvalidLengthLessException;
use KoKoKo\assert\exceptions\InvalidLessException;
use KoKoKo\assert\exceptions\InvalidNotArrayException;
use KoKoKo\assert\exceptions\InvalidNotEmptyException;
use KoKoKo\assert\exceptions\InvalidNotObjectException;
use KoKoKo\assert\exceptions\InvalidRegexpPatternException;
use KoKoKo\assert\exceptions\InvalidStrictBetweenException;
use KoKoKo\assert\exceptions\InvalidStrictGreaterException;
use KoKoKo\assert\exceptions\InvalidStrictLessException;
use KoKoKo\assert\exceptions\InvalidIntException;
use KoKoKo\assert\exceptions\InvalidNegativeException;
use KoKoKo\assert\exceptions\InvalidNotNullException;
use KoKoKo\assert\exceptions\InvalidNullException;
use KoKoKo\assert\exceptions\InvalidNumericException;
use KoKoKo\assert\exceptions\InvalidPositiveException;
use KoKoKo\assert\exceptions\InvalidResourceException;
use KoKoKo\assert\exceptions\InvalidStringException;
use KoKoKo\assert\exceptions\InvalidStringRegExpMatching;

/**
 * Class Assert
 */
class Assert
{
    /** @var Assert */
    protected static $validator;

    /** @var string */
    protected $name;

    /** @var int|float|string|resource|array|null */
    protected $value;

    /** @var \Closure */
    protected $wrapper;

    /**
     * Creates validator instance for variable, first fail check will throw an exception
     *
     * @param int|float|string|resource|array|null $value
     * @param string                               $name
     *
     * @return static
     * @throws InvalidNotObjectException
     * @throws InvalidStringException
     */
    public static function assert($value, $name = 'value')
    {
        if (is_object($value)) {
            throw new InvalidNotObjectException($name, $value);
        } elseif (!is_string($name)) {
            throw new InvalidStringException('name', $name);
        }

        if (empty(self::$validator)) {
            self::$validator = new static;
        }

        $validator = clone self::$validator;

        $validator->name = $name;
        $validator->value = $value;

        return $validator;
    }

    /**
     * @param \Closure $wrapper
     *
     * @return $this
     */
    public function setWrapper(\Closure $wrapper)
    {
        $this->wrapper = $wrapper;

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
     * @param \Closure $callback (Assert $value)
     *
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
            if (!is_int($key)) {
                throw new InvalidIntException(sprintf("%s: key '%s'", $this->name, $key), $key);
            }

            $valueAssert->value = $value;
            $valueAssert->name = sprintf("%s['%s']", $this->name, $key);

            $callback($valueAssert);
        }

        return $this;
    }

    /**
     * @param \Closure $callback (Assert $key, Assert $value)
     *
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

        $keyAssert = clone self::$validator;
        $valueAssert = clone self::$validator;

        foreach ($this->value as $key => $value) {
            $keyAssert->value = $key;
            $valueAssert->value = $value;

            $keyAssert->name = sprintf("%s: key '%s'", $this->name, $key);
            $valueAssert->name = sprintf("%s['%s']", $this->name, $key);

            $callback($keyAssert, $valueAssert);
        }

        return $this;
    }

    /**
     * @param int $length
     *
     * @return $this
     * @throws InvalidIntException
     * @throws InvalidLengthException
     * @throws InvalidPositiveException
     * @throws InvalidStringException
     */
    public function length($length)
    {
        if (!is_int($length)) {
            throw new InvalidIntException('length', $length);
        } elseif ($length < 0) {
            throw new InvalidPositiveException('length', $length);
        }

        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
        } elseif (mb_strlen($this->value) !== $length) {
            throw new InvalidLengthException($this->name, $this->value, $length);
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
     * @throws InvalidIntException
     * @throws InvalidLengthBetweenException
     * @throws InvalidPositiveException
     * @throws InvalidStrictGreaterException
     * @throws InvalidStrictLessException
     * @throws InvalidStringException
     */
    public function lengthBetween($from, $to)
    {
        if (!is_int($from)) {
            throw new InvalidIntException('from', $from);
        } elseif (!is_int($to)) {
            throw new InvalidPositiveException('to', $to);
        } elseif ($from > $to) {
            throw new InvalidStrictLessException('from', $from, $to);
        } elseif ($from < 0) {
            throw new InvalidStrictGreaterException('from', $from, 0);
        }

        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
        }

        $length = mb_strlen($this->value);

        if ($length < $from || $length > $to) {
            throw new InvalidLengthBetweenException($this->name, $this->value, $from, $to);
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $length. Runs only after string validation
     *
     * @param int $length
     *
     * @return $this
     * @throws InvalidIntException
     * @throws InvalidLengthLessException
     * @throws InvalidPositiveException
     * @throws InvalidStringException
     */
    public function lengthLess($length)
    {
        if (!is_int($length)) {
            throw new InvalidIntException('length', $length);
        } elseif ($length < 0) {
            throw new InvalidPositiveException('length', $length);
        }

        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
        } elseif (mb_strlen($this->value) > $length) {
            throw new InvalidLengthLessException($this->name, $this->value, $length);
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $length. Runs only after notEmpty and string validations
     *
     * @param int $length
     *
     * @return $this
     * @throws InvalidIntException
     * @throws InvalidLengthGreaterException
     * @throws InvalidPositiveException
     * @throws InvalidStringException
     */
    public function lengthMore($length)
    {
        if (!is_int($length)) {
            throw new InvalidIntException('length', $length);
        } elseif ($length < 0) {
            throw new InvalidPositiveException('length', $length);
        }

        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
        } elseif (mb_strlen($this->value) < $length) {
            throw new InvalidLengthGreaterException($this->name, $this->value, $length);
        }

        return $this;
    }

    /**
     * Check if value is in array (in_array strict)
     *
     * @param array $range
     *
     * @return $this
     * @throws InvalidInArrayException
     */
    public function inArray(array $range)
    {
        if (!in_array($this->value, $range, true)) {
            throw new InvalidInArrayException($this->name, $this->value, $range);
        }

        return $this;
    }

    /**
     * Check if value is array
     *
     * @return $this
     * @throws InvalidArrayException
     */
    public function isArray()
    {
        if (!is_array($this->value)) {
            throw new InvalidArrayException($this->name, $this->value);
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
     * @throws InvalidBetweenException
     * @throws InvalidIntOrFloatException
     * @throws InvalidStrictLessException
     */
    public function between($from, $to)
    {
        if (!is_int($from) && !is_float($from)) {
            throw new InvalidIntOrFloatException('from', $from);
        } elseif (!is_int($to) && !is_float($to)) {
            throw new InvalidIntOrFloatException('to', $to);
        } elseif ($from > $to) {
            throw new InvalidStrictLessException('from', $from, $to);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value < $from || $this->value > $to) {
            throw new InvalidBetweenException($this->name, $this->value, $from, $to);
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
     * @throws InvalidIntOrFloatException
     * @throws InvalidStrictBetweenException
     * @throws InvalidStrictLessException
     */
    public function betweenStrict($from, $to)
    {
        if (!is_int($from) && !is_float($from)) {
            throw new InvalidIntOrFloatException('from', $from);
        } elseif (!is_int($to) && !is_float($to)) {
            throw new InvalidIntOrFloatException('to', $to);
        } elseif ($from > $to) {
            throw new InvalidStrictLessException('from', $from, $to);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value <= $from || $this->value >= $to) {
            throw new InvalidStrictBetweenException($this->name, $this->value, $from, $to);
        }

        return $this;
    }

    /**
     * Check if value is boolean (is_bool)
     *
     * @return $this
     * @throws InvalidBoolException
     */
    public function bool()
    {
        if (!is_bool($this->value)) {
            throw new InvalidBoolException($this->name, $this->value);
        }

        return $this;
    }

    /**
     * Check if value is digit (ctype_digit)
     *
     * @return $this
     * @throws InvalidDigitException
     * @throws InvalidStringException
     */
    public function digit()
    {
        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
        } elseif (!ctype_digit($this->value)) {
            throw new InvalidDigitException($this->name, $this->value);
        }

        return $this;
    }

    /**
     * Check if value is empty (empty)
     *
     * @return $this
     * @throws InvalidEmptyException
     */
    public function isEmpty()
    {
        if (!empty($this->value)) {
            throw new InvalidEmptyException($this->name);
        }

        return $this;
    }

    /**
     * Check if value is not empty (empty)
     *
     * @return $this
     * @throws InvalidNotEmptyException
     */
    public function notEmpty()
    {
        if (empty($this->value)) {
            throw new InvalidNotEmptyException($this->name);
        }

        return $this;
    }

    /**
     * Check if value is float (is_float)
     *
     * @return $this
     * @throws InvalidFloatException
     */
    public function float()
    {
        if (!is_float($this->value)) {
            throw new InvalidFloatException($this->name, $this->value);
        }

        return $this;
    }

    /**
     * Check if value is integer (is_int)
     *
     * @return $this
     * @throws InvalidIntException
     */
    public function int()
    {
        if (!is_int($this->value)) {
            throw new InvalidIntException($this->name, $this->value);
        }

        return $this;
    }

    /**
     * Soft check that value <= $max
     *
     * @param float|int $number
     *
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws InvalidLessException
     */
    public function less($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value > $number) {
            throw new InvalidLessException($this->name, $this->value, $number);
        }

        return $this;
    }

    /**
     * Soft check that value >= $min
     *
     * @param float|int $number
     *
     * @return $this
     * @throws InvalidGreaterException
     * @throws InvalidIntOrFloatException
     * @deprecated Will be removed in 0.4.0
     */
    public function more($number)
    {
        return $this->greater($number);
    }

    /**
     * Soft check that value >= $min
     *
     * @param float|int $number
     *
     * @return $this
     * @throws InvalidGreaterException
     * @throws InvalidIntOrFloatException
     */
    public function greater($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value < $number) {
            throw new InvalidGreaterException($this->name, $this->value, $number);
        }

        return $this;
    }

    /**
     * Strict check that value < $max
     *
     * @param float|int $number
     *
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws InvalidStrictLessException
     */
    public function lessStrict($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value >= $number) {
            throw new InvalidStrictLessException($this->name, $this->value, $number);
        }

        return $this;
    }

    /**
     * Strict check that value > $min
     *
     * @param float|int $number
     *
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws InvalidStrictGreaterException
     */
    public function moreStrict($number)
    {
        if (!is_int($number) && !is_float($number)) {
            throw new InvalidIntOrFloatException('number', $number);
        }

        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value <= $number) {
            throw new InvalidStrictGreaterException($this->name, $this->value, $number);
        }

        return $this;
    }

    /**
     * Check if value match regexp pattern
     *
     * @param string $pattern
     *
     * @return $this
     * @throws InvalidNotEmptyException
     * @throws InvalidRegexpPatternException
     * @throws InvalidStringException
     * @throws InvalidStringRegExpMatching
     */
    public function match($pattern)
    {
        if (!is_string($pattern)) {
            throw new InvalidStringException('pattern', $pattern);
        } elseif (empty($pattern)) {
            throw new InvalidNotEmptyException('pattern');
        }

        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
        }

        // God please sorry for this @
        $checkResult = @preg_match($pattern, $this->value);

        if ((preg_last_error() !== PREG_NO_ERROR) || ($checkResult === false)) {
            throw new InvalidRegExpPatternException('pattern', $pattern);
        }

        if ($checkResult === 0) {
            throw new InvalidStringRegExpMatching($this->name, $this->value, $pattern);
        }

        return $this;
    }

    /**
     * Check if value match glob pattern
     *
     * @param string $pattern
     *
     * @return $this
     * @throws InvalidNotEmptyException
     * @throws InvalidStringException
     * @throws InvalidStringRegExpMatching
     */
    public function glob($pattern)
    {
        if (!is_string($pattern)) {
            throw new InvalidStringException('pattern', $pattern);
        } elseif (empty($pattern)) {
            throw new InvalidNotEmptyException('pattern');
        }

        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
        } elseif (!fnmatch($pattern, $this->value)) {
            throw new InvalidStringRegExpMatching($this->name, $this->value, $pattern);
        }

        return $this;
    }

    /**
     * Check if value < 0
     *
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws InvalidNegativeException
     */
    public function negative()
    {
        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value >= 0) {
            throw new InvalidNegativeException($this->value, $this->value);
        }

        return $this;
    }

    /**
     * Check if value > 0
     *
     * @return $this
     * @throws InvalidIntOrFloatException
     * @throws InvalidPositiveException
     */
    public function positive()
    {
        if (!is_int($this->value) && !is_float($this->value)) {
            throw new InvalidIntOrFloatException($this->name, $this->value);
        } elseif ($this->value <= 0) {
            throw new InvalidPositiveException($this->value, $this->value);
        }

        return $this;
    }

    /**
     * Check if value is null
     *
     * @return $this
     * @throws InvalidNullException
     */
    public function isNull()
    {
        if (!is_null($this->value)) {
            throw new InvalidNullException($this->name, $this->value);
        }

        return $this;
    }

    /**
     * Check if value is not null
     *
     * @return $this
     * @throws InvalidNotNullException
     */
    public function notNull()
    {
        if (is_null($this->value)) {
            throw new InvalidNotNullException($this->name);
        }

        return $this;
    }

    /**
     * Check if value is numeric (is_numeric)
     *
     * @return $this
     * @throws InvalidNumericException
     */
    public function numeric()
    {
        if (!is_numeric($this->value)) {
            throw new InvalidNumericException($this->name, $this->value);
        }

        return $this;
    }

    /**
     * Check if value is resource (is_resource)
     *
     * @return $this
     * @throws InvalidResourceException
     */
    public function resource()
    {
        if (!is_resource($this->value)) {
            throw new InvalidResourceException($this->name, $this->value);
        }

        return $this;
    }

    /**
     * Check if value is string (is_string)
     *
     * @return $this
     * @throws InvalidStringException
     */
    public function string()
    {
        if (!is_string($this->value)) {
            throw new InvalidStringException($this->name, $this->value);
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
     */
    public function toFloat()
    {
        if (is_array($this->value)) {
            throw new InvalidNotArrayException($this->name, $this->value);
        }

        $this->value = (float) $this->value;

        return $this;
    }

    /**
     * Cast value to int. If it's not numeric - there will be fail cast
     *
     * @return $this
     * @throws InvalidNotArrayException
     */
    public function toInt()
    {
        if (is_array($this->value)) {
            throw new InvalidNotArrayException($this->name, $this->value);
        }

        $this->value = (int) $this->value;

        return $this;
    }

    /**
     * Cast value to string. If it's simple type or has no method __toString - there will be fail cast
     *
     * @return $this
     * @throws InvalidNotArrayException
     */
    public function toString()
    {
        if (is_array($this->value)) {
            throw new InvalidNotArrayException($this->name, $this->value);
        }

        $this->value = (string) $this->value;

        return $this;
    }
}
