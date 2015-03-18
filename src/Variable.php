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
     * @param mixed  $value
     * @param string $name
     * @param string $exceptionClass
     *
     * @return static
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
     * @param mixed  $value
     * @param string $name
     * @param bool   $skipOnError
     *
     * @return static
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
     * @return Variable
     */
    public function clearErrors()
    {
        $this->errors = [];

        return $this;
    }

    /**
     * @return string[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getExceptionClass()
    {
        return $this->exceptionClass;
    }

    /**
     * @param string $exceptionClass
     *
     * @return Variable
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
     * @return bool
     */
    public function getSkipOnErrors()
    {
        return $this->skipOnErrors;
    }

    /**
     * @param bool $skipOnErrors
     *
     * @return Variable
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
     * @return bool
     */
    public function getThrowException()
    {
        return $this->throwException;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
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
     * @return Variable
     */
    public function isArray()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if ($this->validateArray()) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_POSITIVE, ['{{type}}' => 'array']);
    }

    /**
     * @param float|int $from
     * @param float|int $to
     *
     * @return Variable
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
     * @param float|int $from
     * @param float|int $to
     *
     * @return Variable
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
     * @param int $from
     * @param int $to
     *
     * @return Variable
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
     * @param int $value
     *
     * @return Variable
     */
    public function isLengthLess($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException('Param $value must be int');
        }

        if ($value < 0) {
            throw new \InvalidArgumentException('Param $value must be more than 0');
        }

        $this->notEmpty()->isString();

        if (!empty($this->errors)) {
            return $this;
        }

        if (mb_strlen($this->value) <= $value) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $value]);
    }

    /**
     * @param int $value
     *
     * @return Variable
     */
    public function isLengthMore($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException('Param $value must be int');
        }

        if ($value < 0) {
            throw new \InvalidArgumentException('Param $value must be more than 0');
        }

        $this->notEmpty()->isString();

        if (!empty($this->errors)) {
            return $this;
        }

        if (mb_strlen($this->value) >= $value) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_LENGTH_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $value]);
    }

    /**
     * @param float|int $value
     *
     * @return Variable
     */
    public function isLess($value)
    {
        if (!is_int($value) && !is_float($value)) {
            throw new \InvalidArgumentException('Param $value must be int or float');
        }

        $this->isNumeric()->notString();

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value <= $value) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $value]);
    }

    /**
     * @param float|int $value
     *
     * @return Variable
     */
    public function isLessStrict($value)
    {
        if (!is_int($value) && !is_float($value)) {
            throw new \InvalidArgumentException('Param $value must be int or float');
        }

        $this->isNumeric()->notString();

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value < $value) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'less than ' . $value]);
    }

    /**
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
     * @param float|int $value
     *
     * @return Variable
     */
    public function isMore($value)
    {
        if (!is_int($value) && !is_float($value)) {
            throw new \InvalidArgumentException('Param $value must be int or float');
        }

        $this->isNumeric()->notString();

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value >= $value) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $value]);
    }

    /**
     * @param float|int $value
     *
     * @return Variable
     */
    public function isMoreStrict($value)
    {
        if (!is_int($value) && !is_float($value)) {
            throw new \InvalidArgumentException('Param $value must be int or float');
        }

        $this->isNumeric()->notString();

        if (!empty($this->errors)) {
            return $this;
        }

        if ($this->value > $value) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_TEXT_POSITIVE, ['{{value}}' => 'more than ' . $value]);
    }

    /**
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
     * @return Variable
     */
    public function notArray()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!$this->validateArray()) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'array']);
    }

    /**
     * @param float|int $from
     * @param float|int $to
     *
     * @return Variable
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
     * @param float|int $from
     * @param float|int $to
     *
     * @return Variable
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
     * @param array $range
     *
     * @return Variable
     */
    public function notInArray(array $range)
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!in_array($this->value, $range)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_IN_ARRAY_NEGATIVE, ['{{type}}' => 'array']);
    }

    /**
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
     * @param int $from
     * @param int $to
     *
     * @return Variable
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
     * @param bool $throwException
     *
     * @return Variable
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
     * @param string $pattern
     * @param array  $placeholders
     *
     * @return Variable
     */
    protected function processError($pattern, $placeholders = [])
    {
        $placeholders['{{variable}}'] = $this->name;
        $placeholders['{{value}}'] = var_export($this->value, true);

        $this->errors[] = strtr($pattern, $placeholders);

        if ($this->throwException) {
            throw new $this->exceptionClass(implode("\n", $this->errors));
        }

        return $this;
    }

    /**
     * @return bool
     */
    protected function validateArray()
    {
        return (
            is_array($this->value) || (
                $this->value instanceof \ArrayAccess
                && $this->value instanceof \Traversable
                && $this->value instanceof \Countable
            )
        );
    }
}
