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

        if (($exceptionClass !== static::EXCEPTION_CLASS) && (!is_subclass_of($exceptionClass, '\Exception'))) {
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

        if ((bool)json_decode($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
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

        if (!((bool)json_decode($this->value))) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
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
     * @param string $exceptionClass
     *
     * @return Variable
     */
    public function setExceptionClass($exceptionClass = self::EXCEPTION_CLASS)
    {
        if (!is_string($exceptionClass)) {
            throw new \InvalidArgumentException('Param $exceptionClass must be string');
        }

        if (!is_subclass_of($exceptionClass, '\Exception')) {
            throw new \InvalidArgumentException('Param $exceptionClass must be subclass of \Exception');
        }

        $this->exceptionClass = $exceptionClass;

        return $this;
    }

    /**
     * @param bool $skipOnErrors
     *
     * @return Variable
     */
    public function setSkipOnErrors($skipOnErrors)
    {
        if (!is_bool($skipOnErrors)) {
            throw new \InvalidArgumentException('Param $skipOnErrors must be bool');
        }

        $this->skipOnErrors = $skipOnErrors;

        return $this;
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
