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
    const EXCEPTION_VALUE_IN_ARRAY_NEGATIVE = '${{variable}} must be not {{value}}';

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
            throw new \InvalidArgumentException('$name must be string');
        }

        if (!is_subclass_of($exceptionClass, '\Exception')) {
            throw new \InvalidArgumentException('$exceptionClass must be subclass of \Exception');
        }

        $validator = new self;
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
     * @return Variable
     */
    public static function validate($value, $name, $skipOnError = true)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name must be string');
        }

        if (!is_bool($skipOnError)) {
            throw new \InvalidArgumentException('$skipOnError must be bool');
        }

        $validator = new self;
        $validator->skipOnErrors = $skipOnError;
        $validator->name = $name;
        $validator->value = $value;
        $validator->throwException = false;

        return $validator;
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
