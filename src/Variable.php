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

    const EXCEPTION_TYPE_TEXT_POSITIVE = 'Param ${{variable}} must be {{type}}';
    const EXCEPTION_TYPE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{type}}';

    const EXCEPTION_VALUE_TEXT_POSITIVE = 'Param ${{variable}} must be {{value}}';
    const EXCEPTION_VALUE_TEXT_NEGATIVE = 'Param ${{variable}} must be not {{value}}';

    const EXCEPTION_VALUE_IN_ARRAY_POSITIVE = '${{variable}} out of range {{value}}';
    const EXCEPTION_VALUE_IN_ARRAY_NEGATIVE = '${{variable}} must be not in range {{value}}';

    /** @var Variable */
    private static $validator;

    /** @var string[] */
    protected $errors = [];

    /** @var string */
    protected $exceptionClass;

    /** @var string */
    protected $name;

    /** @var bool */
    protected $skipOnErrors;

    /** @var bool */
    protected $throwException = true;

    /** @var mixed */
    protected $value;

    protected function __construct()
    {
    }

    /**
     * @param mixed  $value
     * @param string $name
     * @param string $exceptionClass
     *
     * @return Variable
     */
    public static function assert($value, $name, $exceptionClass = self::EXCEPTION_CLASS)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (($exceptionClass !== self::EXCEPTION_CLASS) && (!is_subclass_of($exceptionClass, '\Exception'))) {
            throw new \InvalidArgumentException('Param $exceptionClass must be subclass of \Exception');
        }

        if (is_null(self::$validator)) {
            self::$validator = new self;
        }

        self::$validator->exceptionClass = $exceptionClass;
        self::$validator->name = $name;
        self::$validator->value = $value;
        self::$validator->errors = [];
        self::$validator->throwException = true;

        return self::$validator;
    }

    /**
     * @param mixed  $value
     * @param string $name
     * @param bool   $skipOnError
     *
     * @return Variable
     */
    public static function validate($value, $name, $skipOnError = true)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('Param $name must be string');
        }

        if (!is_bool($skipOnError)) {
            throw new \InvalidArgumentException('Param $skipOnError must be bool');
        }

        if (is_null(self::$validator)) {
            self::$validator = new self;
        }

        self::$validator->skipOnErrors = $skipOnError;
        self::$validator->name = $name;
        self::$validator->value = $value;
        self::$validator->errors = [];
        self::$validator->throwException = false;

        return self::$validator;
    }

    /**
     * @return $this
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
     * @return bool
     */
    public function hasErrors()
    {
        return empty($this->errors);
    }

    /**
     * @param array $range
     *
     * @return $this|Variable
     */
    public function inArray(array $range)
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (in_array($this->value, $range)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_VALUE_IN_ARRAY_POSITIVE, ['{{type}}' => 'array']);
    }

    /**
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
     */
    public function isJson()
    {
        $this->isString()->notEmpty();

        if (!empty($this->errors)) {
            return $this;
        }

        if ((bool)json_decode($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
    }

    /**
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
     */
    public function notJson()
    {
        $this->isString()->notEmpty();

        if (!empty($this->errors)) {
            return $this;
        }

        if (!((bool)json_decode($this->value))) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'json']);
    }

    /**
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
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
     * @return $this|Variable
     */
    public function notString()
    {
        if (!empty($this->errors) && $this->skipOnErrors) {
            return $this;
        }

        if (!is_string($this->value)) {
            return $this;
        }

        return $this->processError(self::EXCEPTION_TYPE_TEXT_NEGATIVE, ['{{type}}' => 'int']);
    }

    /**
     * @param string $exceptionClass
     *
     * @return $this
     */
    public function setExceptionClass($exceptionClass = self::EXCEPTION_CLASS)
    {
        if (!is_subclass_of($exceptionClass, '\Exception')) {
            throw new \InvalidArgumentException('Param $exceptionClass must be subclass of \Exception');
        }

        $this->exceptionClass = $exceptionClass;

        return $this;
    }

    /**
     * @param bool $skipOnErrors
     *
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    protected function processError($pattern, $placeholders = [])
    {
        $placeholders['{{variable}}'] = $this->name;
        $placeholders['{{value}}'] = var_export($this->value, true);

        if ($this->throwException) {
            $exception = new $this->exceptionClass(implode("\n", $this->errors));
            throw $exception;
        }

        $this->errors[] = strtr($pattern, $placeholders);

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
