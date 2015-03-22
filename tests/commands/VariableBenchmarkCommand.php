<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\commands;

use index0h\validator\Variable;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class VariableBenchmarkCommand
 */
class VariableBenchmarkCommand extends AbstractBenchmarkCommand
{
    const TYPE_NATIVE_ARGUMENTS = 'native_arguments';

    /** @type string[] */
    protected $typeList = [
        self::TYPE_NATIVE,
        self::TYPE_NATIVE_ARGUMENTS,
        self::TYPE_VALIDATOR_LIGHT,
        self::TYPE_VALIDATOR
    ];

    /**
     * @param string $var
     * @param array  $array
     */
    public function inArray($var, $array)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_array($array)) {
                throw new \InvalidArgumentException('argument must be an array');
            }

            if (!in_array($var, $array)) {
                throw new \InvalidArgumentException('var must be in array');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!in_array($var, $array)) {
                throw new \InvalidArgumentException('var must be in array');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param array $var
     */
    public function isArray($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!(
                is_array($var) ||
                ($var instanceof \ArrayAccess && $var instanceof \Traversable && $var instanceof \Countable)
            )
            ) {
                throw new \InvalidArgumentException('var must be array');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $from
     * @param int|float $to
     */
    public function isBetween($var, $from, $to)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($from) && !is_float($from)) {
                throw new \InvalidArgumentException('Param $from must be int or float');
            }

            if (!is_int($to) && !is_float($to)) {
                throw new \InvalidArgumentException('Param $to must be int or float');
            }

            if ($from > $to) {
                throw new \InvalidArgumentException('Param $from must be less than $to');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var < $from || $var > $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var < $from || $var > $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $from
     * @param int|float $to
     */
    public function isBetweenStrict($var, $from, $to)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($from) && !is_float($from)) {
                throw new \InvalidArgumentException('Param $from must be int or float');
            }

            if (!is_int($to) && !is_float($to)) {
                throw new \InvalidArgumentException('Param $to must be int or float');
            }

            if ($from > $to) {
                throw new \InvalidArgumentException('Param $from must be less than $to');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var <= $from || $var >= $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var <= $from || $var >= $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param bool $var
     */
    public function isBool($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_bool($var)) {
                throw new \InvalidArgumentException('var must be bool');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param callable $var
     */
    public function isCallable($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_callable($var)) {
                throw new \InvalidArgumentException('var must be callable');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isDigit($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!ctype_digit($var)) {
                throw new \InvalidArgumentException('var must be digit');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isEmail($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!filter_var($var, FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException('var must be email');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param array $var
     */
    public function isEmpty($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!empty($var)) {
                throw new \InvalidArgumentException('var must be empty');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param float $var
     */
    public function isFloat($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_float($var)) {
                throw new \InvalidArgumentException('var must be float');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isGraph($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!ctype_graph($var)) {
                throw new \InvalidArgumentException('var must be graph');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param int $var
     */
    public function isInt($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($var)) {
                throw new \InvalidArgumentException('var must be int');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isJson($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if (!(bool) json_decode($var)) {
                throw new \InvalidArgumentException('var must be json');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     * @param int    $from
     * @param int    $to
     *
     * @return array
     */
    public function isLengthBetween($var, $from, $to)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
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

            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            $length = mb_strlen($var);

            if ($length < $from || $length > $to) {
                throw new \InvalidArgumentException('var length must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            $length = mb_strlen($var);

            if ($length < $from || $length > $to) {
                throw new \InvalidArgumentException('var length must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     * @param int    $value
     */
    public function isLengthLess($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($value)) {
                throw new \InvalidArgumentException('Param $value must be int');
            }

            if ($value < 0) {
                throw new \InvalidArgumentException('Param $value must be more than 0');
            }

            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (mb_strlen($var) > $value) {
                throw new \InvalidArgumentException('var length must be less than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (mb_strlen($var) > $value) {
                throw new \InvalidArgumentException('var length must be less than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     * @param int    $value
     */
    public function isLengthMore($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($value)) {
                throw new \InvalidArgumentException('Param $value must be int');
            }

            if ($value < 0) {
                throw new \InvalidArgumentException('Param $value must be more than 0');
            }

            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (mb_strlen($var) < $value) {
                throw new \InvalidArgumentException('var length must be more than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (mb_strlen($var) < $value) {
                throw new \InvalidArgumentException('var length must be more than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $value
     */
    public function isLess($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($value) && !is_float($value)) {
                throw new \InvalidArgumentException('Param $value must be int or float');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var > $value) {
                throw new \InvalidArgumentException('var must be less than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var > $value) {
                throw new \InvalidArgumentException('var must be less than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $value
     */
    public function isLessStrict($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($value) && !is_float($value)) {
                throw new \InvalidArgumentException('Param $value must be int or float');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var >= $value) {
                throw new \InvalidArgumentException('var must be less than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var >= $value) {
                throw new \InvalidArgumentException('var must be less than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isMacAddress($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if (!preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $var)) {
                throw new \InvalidArgumentException('var must be MAC address');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $value
     */
    public function isMore($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($value) && !is_float($value)) {
                throw new \InvalidArgumentException('Param $value must be int or float');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var < $value) {
                throw new \InvalidArgumentException('var must be more than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var < $value) {
                throw new \InvalidArgumentException('var must be more than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $value
     */
    public function isMoreStrict($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($value) && !is_float($value)) {
                throw new \InvalidArgumentException('Param $value must be int or float');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var < $value) {
                throw new \InvalidArgumentException('var must be more than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var < $value) {
                throw new \InvalidArgumentException('var must be more than ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isNegative($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var > 0) {
                throw new \InvalidArgumentException('var must be negative');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isNumeric($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param object $var
     */
    public function isObject($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_object($var)) {
                throw new \InvalidArgumentException('var must be object');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isPositive($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var < 0) {
                throw new \InvalidArgumentException('var must be positive');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param resource $var
     */
    public function isResource($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_resource($var)) {
                throw new \InvalidArgumentException('var must be resource');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function isString($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    public function isSubClassOf($var, $className)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!(
                (is_object($var) && is_subclass_of($var, $className)) ||
                (is_string($var) && is_subclass_of($var, $className, true))
            )) {
                throw new \Exception('var must be sub class of ' . $className);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_string($className)) {
                throw new \InvalidArgumentException('Param $className must be string');
            }

            if (!(
                (is_object($var) && is_subclass_of($var, $className)) ||
                (is_string($var) && is_subclass_of($var, $className, true))
            )) {
                throw new \Exception('var must be sub class of ' . $className);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);
    }

    /**
     * @param bool $var
     *
     * @return array
     */
    public function notArray($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (
                is_array($var) ||
                ($var instanceof \ArrayAccess && $var instanceof \Traversable && $var instanceof \Countable)
            ) {
                throw new \InvalidArgumentException('var must be not array');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $from
     * @param int|float $to
     */
    public function notBetween($var, $from, $to)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($from) && !is_float($from)) {
                throw new \InvalidArgumentException('Param $from must be int or float');
            }

            if (!is_int($to) && !is_float($to)) {
                throw new \InvalidArgumentException('Param $to must be int or float');
            }

            if ($from > $to) {
                throw new \InvalidArgumentException('Param $from must be less than $to');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var > $from && $var < $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var > $from && $var < $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string    $var
     * @param int|float $from
     * @param int|float $to
     */
    public function notBetweenStrict($var, $from, $to)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($from) && !is_float($from)) {
                throw new \InvalidArgumentException('Param $from must be int or float');
            }

            if (!is_int($to) && !is_float($to)) {
                throw new \InvalidArgumentException('Param $to must be int or float');
            }

            if ($from > $to) {
                throw new \InvalidArgumentException('Param $from must be less than $to');
            }

            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var >= $from && $var <= $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_numeric($var)) {
                throw new \InvalidArgumentException('var must be numeric');
            }

            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }

            if ($var >= $from && $var <= $to) {
                throw new \InvalidArgumentException('var must be between ' . $from . ' and ' . $to);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param array $var
     */
    public function notBool($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_bool($var)) {
                throw new \InvalidArgumentException('var must be not bool');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notCallable($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_callable($var)) {
                throw new \InvalidArgumentException('var must be not callable');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param array $var
     */
    public function notDigit($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (ctype_digit($var)) {
                throw new \InvalidArgumentException('var must be not digit');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notEmail($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (filter_var($var, FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException('var must be not email');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notEmpty($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notFloat($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_float($var)) {
                throw new \InvalidArgumentException('var must be not float');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notGraph($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (ctype_graph($var)) {
                throw new \InvalidArgumentException('var must be not graph');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notInArray($var, $array)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_array($array)) {
                throw new \InvalidArgumentException('argument must be an array');
            }

            if (in_array($var, $array)) {
                throw new \InvalidArgumentException('var must be in not array');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notInt($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_int($var)) {
                throw new \InvalidArgumentException('var must be not int');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notJson($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if ((bool) json_decode($var)) {
                throw new \InvalidArgumentException('var must be not json');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notMacAddress($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (empty($var)) {
                throw new \InvalidArgumentException('var must be not empty');
            }

            if (preg_match('/^(([0-9a-fA-F]{2}-){5}|([0-9a-fA-F]{2}:){5})[0-9a-fA-F]{2}$/', $var)) {
                throw new \InvalidArgumentException('var must be not MAC address');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notNumeric($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_numeric($var)) {
                throw new \InvalidArgumentException('var must be not numeric');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notObject($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_object($var)) {
                throw new \InvalidArgumentException('var must be not object');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     */
    public function notResource($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_resource($var)) {
                throw new \InvalidArgumentException('var must be not resource');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param array $var
     */
    public function notString($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    public function notSubClassOf($var, $className)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!(
                (is_object($var) && !is_subclass_of($var, $className)) ||
                (is_string($var) && !is_subclass_of($var, $className, true))
            )) {
                throw new \Exception('var must be sub class of ' . $className);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_string($className)) {
                throw new \InvalidArgumentException('Param $className must be string');
            }

            if (!(
                (is_object($var) && !is_subclass_of($var, $className)) ||
                (is_string($var) && !is_subclass_of($var, $className, true))
            )) {
                throw new \Exception('var must be sub class of ' . $className);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);
    }

    protected function configure()
    {
        $this->setName('benchmark:variable')
            ->setDescription('Benchmark of Variable validator');

        // Cache object
        Variable::assert('var', 'var');
    }

    protected function processResults()
    {
        foreach ($this->results as $methodName => $results) {
            if (($results[self::TYPE_NATIVE_ARGUMENTS][self::METRIC_COUNT_TEST] > 0)) {
                continue;
            }

            $this->results[$methodName][self::TYPE_NATIVE_ARGUMENTS] = $this->results[$methodName][self::TYPE_NATIVE];
        }

        parent::processResults();
    }

    /**
     * @param string $methodName
     * @param        $value
     * @param        $arguments
     */
    protected function runBenchmarkForNative($methodName, $value, $arguments)
    {
        if (count($arguments) === 0) {
            $this->{$methodName}($value);
        } elseif (count($arguments) === 1) {
            $this->{$methodName}($value, $arguments[0]);
        } elseif (count($arguments) === 2) {
            $this->{$methodName}($value, $arguments[0], $arguments[1]);
        }
    }

    /**
     * @param string $methodName
     * @param        $value
     * @param        $arguments
     */
    protected function runBenchmarkForValidator($methodName, $value, $arguments)
    {
        if (count($arguments) === 0) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Variable::assert($value, 'var')->{$methodName}();
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        } elseif (count($arguments) === 1) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Variable::assert($value, 'var')->{$methodName}($arguments[0]);
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        } elseif (count($arguments) === 2) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Variable::assert($value, 'var')->{$methodName}($arguments[0], $arguments[1]);
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        }
    }

    /**
     * @param string $methodName
     * @param        $value
     * @param        $arguments
     */
    protected function runBenchmarkForValidatorLight($methodName, $value, $arguments)
    {
        $validator = Variable::assert($value, 'var');

        if (count($arguments) === 0) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $validator->{$methodName}();
            }
            $this->stop($methodName, self::TYPE_VALIDATOR_LIGHT);
        } elseif (count($arguments) === 1) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $validator->{$methodName}($arguments[0]);
            }
            $this->stop($methodName, self::TYPE_VALIDATOR_LIGHT);
        } elseif (count($arguments) === 2) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $validator->{$methodName}($arguments[0], $arguments[1]);
            }
            $this->stop($methodName, self::TYPE_VALIDATOR_LIGHT);
        }
    }

    /**
     * @param OutputInterface $output
     */
    protected function runBenchmarks(OutputInterface $output)
    {
        $methods = $this->getValidationMethods();

        foreach ($methods as $method) {
            $output->writeln('<info>process tests for: ' . $method . '</info>');
            $fixtures = $this->getFixturesForMethod($method);
            foreach ($fixtures as $fixture) {
                // Native
                $this->runBenchmarkForNative($method, $fixture['value'], $fixture['arguments']);
                // Validator light
                $this->runBenchmarkForValidatorLight($method, $fixture['value'], $fixture['arguments']);
                // Validator
                $this->runBenchmarkForValidator($method, $fixture['value'], $fixture['arguments']);
            }
        }
    }
}
