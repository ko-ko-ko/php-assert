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
    const DEFAULT_CAST_BOOL = false;

    const DEFAULT_CAST_FLOAT = 0.0;

    const DEFAULT_CAST_INT = 0;

    const DEFAULT_CAST_STRING = '';

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

    /** @var mixed */
    protected $value;

    protected function __construct()
    {
    }

    /**
     * Creates validator instance for variable, first fail check will throw an exception
     *
     * @param mixed  $value
     * @param string $name
     * @param string $exceptionClass
     *
     * @return static
     * @throws \InvalidArgumentException
     */
    public static function assert($value, $name, $exceptionClass = self::EXCEPTION_CLASS)
    {
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
    public function setExceptionClass($exceptionClass = self::EXCEPTION_CLASS)
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
     * @return mixed
     */
    public function getValue()
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
    public function inArray(array $range)
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
    public function notInArray(array $range)
    {
        if (in_array($this->value, $range, true)) {
            $this->processError(self::EXCEPTION_VALUE_IN_ARRAY_NEGATIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Check if value is array or implements array interfaces
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isArray()
    {
        if (!(
            is_array($this->value) || (
                $this->value instanceof \ArrayAccess &&
                $this->value instanceof \Traversable &&
                $this->value instanceof \Countable
            )
        )) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'array']);
        }

        return $this;
    }

    /**
     * Check if value is not an array and not implements array interfaces
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notArray()
    {
        if (
            is_array($this->value) || (
                $this->value instanceof \ArrayAccess &&
                $this->value instanceof \Traversable &&
                $this->value instanceof \Countable
            )
        ) {
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

        $this->isNumeric()->notString();

        if (!($this->value >= $from && $this->value <= $to)) {
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
    public function notBetween($from, $to)
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

        $this->isNumeric()->notString();

        if (!($this->value <= $from || $this->value >= $to)) {
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

        $this->isNumeric()->notString();

        if (!($this->value > $from && $this->value < $to)) {
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
    public function notBetweenStrict($from, $to)
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

        $this->isNumeric()->notString();

        if (!($this->value < $from || $this->value > $to)) {
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
    public function notBool()
    {
        if (is_bool($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'bool']);
        }

        return $this;
    }

    /**
     * Check if value is callable (is_callable)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isCallable()
    {
        if (!is_callable($this->value, false)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'callable']);
        }

        return $this;
    }

    /**
     * Check if value is not callable (is_callable)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notCallable()
    {
        if (is_callable($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'callable']);
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
    public function notDigit()
    {
        if (ctype_digit($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'digit']);
        }

        return $this;
    }

    /**
     * Check if value is email (filter_var)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isEmail()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'email']);
        }

        return $this;
    }

    /**
     * Check if value is not email (filter_var)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notEmail()
    {
        if (filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'email']);
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
    public function notEmpty()
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
    public function notFloat()
    {
        if (is_float($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'float']);
        }

        return $this;
    }

    /**
     * Check if value is graph (ctype_graph)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isGraph()
    {
        if (!ctype_graph($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'graph']);
        }

        return $this;
    }

    /**
     * Check if value is not graph (ctype_graph)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notGraph()
    {
        if (ctype_graph($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'graph']);
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
    public function notInt()
    {
        if (is_int($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'int']);
        }

        return $this;
    }

    /**
     * Check if value is json. Run only after notEmpty and isString validators
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isJson()
    {
        $this->notEmpty()->isString();

        if (!json_decode($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
        }

        return $this;
    }

    /**
     * Check if value is not json. Run only after notEmpty and isString validators
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notJson()
    {
        $this->notEmpty()->isString();

        if (json_decode($this->value)) {
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

        if (!($length >= $from && $length <= $to)) {
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
    public function notLengthBetween($from, $to)
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

        if (!($length <= $from || $length >= $to)) {
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

        if (!(mb_strlen($this->value) <= $maxLength)) {
            $this->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $maxLength]);
        }

        return $this;
    }

    /**
     * Soft check if value has length less than $minLength. Runs only after notEmpty and isString validations
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

        $this->notEmpty()->isString();

        if (!(mb_strlen($this->value) >= $minLength)) {
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

        $this->isNumeric()->notString();

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

        $this->isNumeric()->notString();

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

        $this->isNumeric()->notString();

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

        $this->isNumeric()->notString();

        if ($this->value <= $min) {
            $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $min]);
        }

        return $this;
    }

    /**
     * Check if value is MAC address
     * Allowed formats:
     *  * ff:ff:ff:ff:ff:ff
     *  * FF:FF:FF:FF:FF:FF
     *  * ff-ff-ff-ff-ff-ff
     *  * FF-FF-FF-FF-FF-FF
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isMacAddress()
    {
        $this->notEmpty()->isString();

        if (!preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'MAC Address']);
        }

        return $this;
    }

    /**
     * Check if value is MAC address
     * Disallowed formats:
     *  * ff:ff:ff:ff:ff:ff
     *  * FF:FF:FF:FF:FF:FF
     *  * ff-ff-ff-ff-ff-ff
     *  * FF-FF-FF-FF-FF-FF
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notMacAddress()
    {
        $this->isString()->notEmpty();

        if (preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'MAC Address']);
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
        $this->isNumeric()->notString();

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
        $this->isNumeric()->notString();

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
    public function notNumeric()
    {
        if (is_numeric($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'numeric']);
        }

        return $this;
    }

    /**
     * Check if value is object (is_object)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isObject()
    {
        if (!is_object($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'object']);
        }

        return $this;
    }

    /**
     * Check if value is not object (is_object)
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notObject()
    {
        if (is_object($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'object']);
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
    public function notResource()
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
    public function notString()
    {
        if (is_string($this->value)) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'string']);
        }

        return $this;
    }

    /**
     * Check if value is subclass of $className (is_subclass_of)
     *
     * @param string $className
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function isSubClassOf($className)
    {
        if (!is_string($className)) {
            throw new \InvalidArgumentException('Param $className must be string');
        }

        if (!(
            (is_object($this->value) && is_subclass_of($this->value, $className)) ||
            (is_string($this->value) && is_subclass_of($this->value, $className, true))
        )) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'subclass of ' . $className]);
        }

        return $this;
    }

    /**
     * Check if value is not subclass of $className (is_subclass_of)
     *
     * @param string $className
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function notSubClassOf($className)
    {
        if (!is_string($className)) {
            throw new \InvalidArgumentException('Param $className must be string');
        }

        if (!(
            (is_object($this->value) && !is_subclass_of($this->value, $className)) ||
            (is_string($this->value) && !is_subclass_of($this->value, $className, true))
        )) {
            $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'subclass of ' . $className]);
        }

        return $this;
    }

    /**
     * Cast value to boll
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toBool()
    {
        if (is_bool($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = self::DEFAULT_CAST_BOOL;
        }

        $this->value = true;

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
        if (is_float($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = self::DEFAULT_CAST_FLOAT;
            return $this;
        }

        if (is_numeric($this->value) || is_bool($this->value)) {
            $this->value = (float) $this->value;

            return $this;
        }

        $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'float']);
    }

    /**
     * Cast value to int. If it's not numeric - there will be fail cast
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toInt()
    {
        if (is_int($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = self::DEFAULT_CAST_INT;
            return $this;
        }

        if (is_numeric($this->value) || is_bool($this->value)) {
            $this->value = (int) $this->value;

            return $this;
        }

        $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'int']);
    }

    /**
     * Cast value to string. If it's simple type or has no method __toString - there will be fail cast
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function toString()
    {
        if (is_string($this->value)) {
            return $this;
        }

        if (empty($this->value)) {
            $this->value = self::DEFAULT_CAST_STRING;
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

        $this->processError(self::EXCEPTION_CAST_TEXT, ['{{type}}' => 'string']);
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
