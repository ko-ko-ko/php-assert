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

    /** @var string[] */
    protected $typeList = [
        self::TYPE_NATIVE,
        self::TYPE_NATIVE_ARGUMENTS,
        self::TYPE_VALIDATOR_LIGHT,
        self::TYPE_VALIDATOR
    ];

    /**
     * @param string $var
     * @param array  $array
     *
     * @throws \InvalidArgumentException
     */
    public function isInArray($var, $array)
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     * @param string $var
     *
     * @throws \InvalidArgumentException
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
     * @param array $var
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     * @param int $var
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     * @param string    $var
     * @param int|float $value
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     * @param string $var
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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
     *
     * @throws \InvalidArgumentException
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

    /**
     * @param bool $var
     *
     * @return array
     * @throws \InvalidArgumentException
     */
    public function isNotArray($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotBetween($var, $from, $to)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotBetweenStrict($var, $from, $to)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotBool($var)
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
     * @param array $var
     *
     * @throws \InvalidArgumentException
     */
    public function isNotDigit($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotEmpty($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotFloat($var)
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
     * @param array  $array
     *
     * @throws \InvalidArgumentException
     */
    public function isNotInArray($var, $array)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotInt($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotJson($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotNumeric($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotResource($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function isNotString($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_string($var)) {
                throw new \InvalidArgumentException('var must be not string');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param int|float|string|resource|array|null $var
     */
    public function toBool($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            $tmpVar = (bool) $tmpVar;
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param int|float|string|resource|array|null $var
     *
     * @throws \InvalidArgumentException
     */
    public function toFloat($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            if (!is_float($tmpVar)) {
                if (empty($tmpVar)) {
                    $tmpVar = 0.0;
                } elseif (is_numeric($tmpVar) || is_bool($tmpVar) || is_resource($tmpVar)) {
                    $tmpVar = (float) $tmpVar;
                } else {
                    throw new \InvalidArgumentException('Can not cast $var to float');
                }
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param int|float|string|resource|array|null $var
     *
     * @throws \InvalidArgumentException
     */
    public function toInt($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            if (!is_int($tmpVar)) {
                if (empty($tmpVar)) {
                    $tmpVar = 0;
                } elseif (is_numeric($tmpVar) || is_bool($tmpVar) || is_resource($tmpVar)) {
                    $tmpVar = (int) $tmpVar;
                } else {
                    throw new \InvalidArgumentException('Can not cast $var to int');
                }
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param int|float|string|resource|array|null $var
     *
     * @throws \InvalidArgumentException
     */
    public function toString($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            if (!is_string($tmpVar)) {
                if (empty($tmpVar)) {
                    $tmpVar = '';
                } elseif (
                    is_numeric($tmpVar) ||
                    is_bool($tmpVar) ||
                    is_resource($tmpVar) ||
                    (is_object($tmpVar) && method_exists($tmpVar, '__toString'))
                ) {
                    $tmpVar = (string) $tmpVar;
                } else {
                    throw new \InvalidArgumentException('Can not cast $var to string');
                }
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
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
     * @param string                               $methodName
     * @param int|float|string|resource|array|null $value
     * @param array                                $arguments
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
     * @param string                               $methodName
     * @param int|float|string|resource|array|null $value
     * @param array                                $arguments
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
     * @param string                               $methodName
     * @param int|float|string|resource|array|null $value
     * @param array                                $arguments
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
