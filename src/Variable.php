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
    const EXCEPTION_CLASS = '\InvalidArgumentException';

    const EXCEPTION_LENGTH_TEXT_NEGATIVE = '${{variable}} must have not length {{value}}';

    const EXCEPTION_LENGTH_TEXT_POSITIVE = '${{variable}} must have length {{value}}';

    const EXCEPTION_TYPE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{type}}';

    const EXCEPTION_TYPE_TEXT_POSITIVE = 'Param ${{variable}} must be {{type}}';

    const EXCEPTION_VALUE_IN_ARRAY_NEGATIVE = '${{variable}} must be not in range {{value}}';

    const EXCEPTION_VALUE_IN_ARRAY_POSITIVE = '${{variable}} out of range {{value}}';

    const EXCEPTION_VALUE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{value}}';

    const EXCEPTION_VALUE_TEXT_POSITIVE = 'Param ${{variable}} must be {{value}}';

    /** @type string[] */
    protected $errors = [];

    /** @type string */
    protected $exceptionClass;

    /** @type string */
    protected $name;

    /** @type bool */
    protected $skipOnErrors;

    /** @type bool */
    protected $throwException = true;

    /** @type mixed */
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

        if (($exceptionClass !== static::EXCEPTION_CLASS) && (!is_a($exceptionClass, '\Exception', true))) {
            throw new \InvalidArgumentException('Param $exceptionClass must be subclass of \Exception');
        }

        $validator = new static;
        $validator->exceptionClass = $exceptionClass;
        $validator->name = $name;
        $validator->value = $value;

        return $validator;
    }

    /**
     * Creates validator instance for variable, without throwing an exception
     *
     * If $skipOnError = false - it'll run all of validations, else - skip them
     * Found errors you can see by getErrors() method call
     *
     * @param mixed  $value
     * @param string $name
     * @param bool   $skipOnError
     *
     * @return static
     * @throws \InvalidArgumentException
     */
    public static function validate($value, $name, $skipOnError = true)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_bool($skipOnError)) {
            throw new \InvalidArgumentException('Param $skipOnError must be bool');
        }

        $validator = new static;
        $validator->skipOnErrors = $skipOnError;

        $validator->name = $name;
        $validator->value = $value;
        $validator->throwException = false;

        return $validator;
    }

    /**
     * Clear of errors array
     *
     * @return Variable
     */
    public function clearErrors()
    {
        $this->errors = [];

        return $this;
    }

    /**
     * Return an array of found errors
     *
     * @return string[]
     */
    public function getErrors()
    {
        return $this->errors;
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
     * Return option of skipping an error on fail validation
     *
     * @return bool
     */
    public function getSkipOnErrors()
    {
        return $this->skipOnErrors;
    }

    /**
     * Set of skipping an error on fail validation
     *
     * @param bool $skipOnErrors
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function setSkipOnErrors($skipOnErrors = true)
    {
        if (!is_bool($skipOnErrors)) {
            throw new \InvalidArgumentException('Param $skipOnErrors must be bool');
        }

        $this->skipOnErrors = $skipOnErrors;

        return $this;
    }

    /**
     * Return an exception class
     *
     * @return bool
     */
    public function getThrowException()
    {
        return $this->throwException;
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
     * Does validation had errors
     *
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * Check if value is in array (in_array strict)
     *
     * @param array $range
     *
     * @return Variable
     */
    public function inArray(array $range)
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (in_array($this->value, $range, true)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_IN_ARRAY_POSITIVE, ['{{type}}' => 'array']);
    }

    /**
     * Check if value is array or implements array interfaces
     *
     * @return Variable
     */
    public function isArray()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (
            is_array($this->value) || (
                $this->value instanceof \ArrayAccess &&
                $this->value instanceof \Traversable &&
                $this->value instanceof \Countable
            )
        ) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'array']);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value >= $from && $this->value <= $to) {
            return $this;
        }

        return $this
            ->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'between ' . $from . ' and ' . $to]);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value > $from && $this->value < $to) {
            return $this;
        }

        return $this
            ->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'between ' . $from . ' and ' . $to]);
    }

    /**
     * Check if value is boolean (is_bool)
     *
     * @return Variable
     */
    public function isBool()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_bool($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'bool']);
    }

    /**
     * Check if value is callable (is_callable)
     *
     * @return Variable
     */
    public function isCallable()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_callable($this->value, false)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'callable']);
    }

    /**
     * Check if value is digit (ctype_digit)
     *
     * @return Variable
     */
    public function isDigit()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (ctype_digit($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'digit']);
    }

    /**
     * Check if value is email (filter_var)
     *
     * @return Variable
     */
    public function isEmail()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'email']);
    }

    /**
     * Check if value is empty (empty)
     *
     * @return Variable
     */
    public function isEmpty()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (empty($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'empty']);
    }

    /**
     * Check if value is float (is_float)
     *
     * @return Variable
     */
    public function isFloat()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_float($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'float']);
    }

    /**
     * Check if value is graph (ctype_graph)
     *
     * @return Variable
     */
    public function isGraph()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (ctype_graph($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'graph']);
    }

    /**
     * Check if value is integer (is_int)
     *
     * @return Variable
     */
    public function isInt()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_int($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'int']);
    }

    /**
     * Check if value is json. Run only after notEmpty and isString validators
     *
     * @return Variable
     */
    public function isJson()
    {
        $this->notEmpty()->isString();

        if (!empty($this->errors)) {
            return $this;
        }

        if ((bool) json_decode($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
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

        if (!empty($this->errors)) {
            return $this;
        }

        $length = mb_strlen($this->value);

        if ($length >= $from && $length <= $to) {
            return $this;
        }

        return $this
            ->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'between ' . $from . ' and ' . $to]);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if (mb_strlen($this->value) <= $maxLength) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $maxLength]);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if (mb_strlen($this->value) >= $minLength) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $minLength]);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value <= $max) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $max]);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value < $max) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $max]);
    }

    /**
     * Check if value is MAC address
     *
     * Allowed formats:
     *
     *  * ff:ff:ff:ff:ff:ff
     *  * FF:FF:FF:FF:FF:FF
     *  * ff-ff-ff-ff-ff-ff
     *  * FF-FF-FF-FF-FF-FF
     *
     * @return Variable
     */
    public function isMacAddress()
    {
        $this->notEmpty()->isString();

        if (!empty($this->errors)) {
            return $this;
        }

        if (preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'MAC Address']);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value >= $min) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $min]);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value > $min) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $min]);
    }

    /**
     * Check if value < 0
     *
     * @return Variable
     */
    public function isNegative()
    {
        $this->isNumeric()->notString();

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value < 0) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'negative']);
    }

    /**
     * Check if value is numeric (is_numeric)
     *
     * @return Variable
     */
    public function isNumeric()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_numeric($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'numeric']);
    }

    /**
     * Check if value is object (is_object)
     *
     * @return Variable
     */
    public function isObject()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_object($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'object']);
    }

    /**
     * Check if value > 0
     *
     * @return Variable
     */
    public function isPositive()
    {
        $this->isNumeric()->notString();

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value > 0) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'positive']);
    }

    /**
     * Check if value is resource (is_resource)
     *
     * @return Variable
     */
    public function isResource()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_resource($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'resource']);
    }

    /**
     * Check if value is string (is_string)
     *
     * @return Variable
     */
    public function isString()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (is_string($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'string']);
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

        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (
            (is_object($this->value) && is_subclass_of($this->value, $className)) ||
            (is_string($this->value) && is_subclass_of($this->value, $className, true))
        ) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'subclass of ' . $className]);
    }

    /**
     * Check if value is not an array and not implements array interfaces
     *
     * @return Variable
     */
    public function notArray()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!(
            is_array($this->value) || (
                $this->value instanceof \ArrayAccess &&
                $this->value instanceof \Traversable &&
                $this->value instanceof \Countable
            )
        )) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'array']);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value <= $from || $this->value >= $to) {
            return $this;
        }

        return $this
            ->processError(self::EXCEPTION_VALUE_TEXT_NEGATIVE, ['{{value}}' => 'between ' . $from . ' and ' . $to]);
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

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value < $from || $this->value > $to) {
            return $this;
        }

        return $this
            ->processError(self::EXCEPTION_VALUE_TEXT_NEGATIVE, ['{{value}}' => 'between ' . $from . ' and ' . $to]);
    }

    /**
     * Check if value is not boolean (is_bool)
     *
     * @return Variable
     */
    public function notBool()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_bool($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'bool']);
    }

    /**
     * Check if value is not callable (is_callable)
     *
     * @return Variable
     */
    public function notCallable()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_callable($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'callable']);
    }

    /**
     * Check if value is not digit (ctype_digit)
     *
     * @return Variable
     */
    public function notDigit()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!ctype_digit($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'digit']);
    }

    /**
     * Check if value is not email (filter_var)
     *
     * @return Variable
     */
    public function notEmail()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'email']);
    }

    /**
     * Check if value is not empty (empty)
     *
     * @return Variable
     */
    public function notEmpty()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!empty($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'empty']);
    }

    /**
     * Check if value is not float (is_float)
     *
     * @return Variable
     */
    public function notFloat()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_float($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'float']);
    }

    /**
     * Check if value is not graph (ctype_graph)
     *
     * @return Variable
     */
    public function notGraph()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!ctype_graph($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'graph']);
    }

    /**
     * Check if value is not in array (in_array strict)
     *
     * @param array $range
     *
     * @return Variable
     */
    public function notInArray(array $range)
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!in_array($this->value, $range, true)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_IN_ARRAY_NEGATIVE, ['{{type}}' => 'array']);
    }

    /**
     * Check if value is not integer (is_int)
     *
     * @return Variable
     */
    public function notInt()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_int($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'int']);
    }

    /**
     * Check if value is not json. Run only after notEmpty and isString validators
     *
     * @return Variable
     */
    public function notJson()
    {
        $this->notEmpty()->isString();

        if (!empty($this->errors)) {
            return $this;
        }

        if (!((bool) json_decode($this->value))) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
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

        if (!empty($this->errors)) {
            return $this;
        }

        $length = mb_strlen($this->value);

        if ($length <= $from || $length >= $to) {
            return $this;
        }

        return $this
            ->processError(self::EXCEPTION_LENGTH_TEXT_NEGATIVE, ['{{value}}' => 'between ' . $from . ' and ' . $to]);
    }

    /**
     * Check if value is MAC address
     *
     * Disallowed formats:
     *
     *  * ff:ff:ff:ff:ff:ff
     *  * FF:FF:FF:FF:FF:FF
     *  * ff-ff-ff-ff-ff-ff
     *  * FF-FF-FF-FF-FF-FF
     *
     * @return Variable
     */
    public function notMacAddress()
    {
        $this->isString()->notEmpty();

        if (!empty($this->errors)) {
            return $this;
        }

        if (!preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'MAC Address']);
    }

    /**
     * Check if value is not numeric (is_numeric)
     *
     * @return Variable
     */
    public function notNumeric()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_numeric($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'numeric']);
    }

    /**
     * Check if value is not object (is_object)
     *
     * @return Variable
     */
    public function notObject()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_object($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'object']);
    }

    /**
     * Check if value is not resource (is_resource)
     *
     * @return Variable
     */
    public function notResource()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_resource($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'resource']);
    }

    /**
     * Check if value is not string (is_string)
     *
     * @return Variable
     */
    public function notString()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_string($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'string']);
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

        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (
            (is_object($this->value) && !is_subclass_of($this->value, $className)) ||
            (is_string($this->value) && !is_subclass_of($this->value, $className, true))
        ) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'subclass of ' . $className]);
    }

    /**
     * set option of throw exception on fail validation
     *
     * @param bool $throwException
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    public function setThrowErrors($throwException)
    {
        if (!is_bool($throwException)) {
            throw new \InvalidArgumentException('Param $throwException must be bool');
        }

        $this->throwException = $throwException;

        return $this;
    }

    /**
     * Process fail validation
     *
     * @param string $pattern
     * @param array  $placeholders
     *
     * @return Variable
     * @throws \InvalidArgumentException
     */
    protected function processError($pattern, $placeholders = [])
    {
        $placeholders['{{variable}}'] = $this->name;
        $placeholders['{{value}}'] = print_r($this->value, true);

        $this->errors[] = strtr($pattern, $placeholders);

        if ($this->throwException) {
            throw new $this->exceptionClass(implode("\n", $this->errors));
        }

        return $this;
    }
}
