<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */
namespace KoKoKo\assert\tests\commands;

use KoKoKo\assert\Assert;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AssertBenchmarkCommand
 */
class AssertBenchmarkCommand extends AbstractBenchmarkCommand
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
     * @param int    $value
     *
     * @throws \InvalidArgumentException
     */
    public function length($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_int($value)) {
                throw new \InvalidArgumentException('Param $value must be int');
            }

            if ($value < 0) {
                throw new \InvalidArgumentException('Param $value must be more than 0');
            }

            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (mb_strlen($var) !== $value) {
                throw new \InvalidArgumentException('var length must be ' . $value);
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

            if (mb_strlen($var) !== $value) {
                throw new \InvalidArgumentException('var length must be ' . $value);
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
    public function lengthBetween($var, $from, $to)
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
    public function lengthLess($var, $value)
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
    public function lengthMore($var, $value)
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
    public function between($var, $from, $to)
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
    public function betweenStrict($var, $from, $to)
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
    public function bool($var)
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
    public function digit($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }

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
    public function float($var)
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
     * @param array  $array
     *
     * @throws \InvalidArgumentException
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
     * @param int $var
     *
     * @throws \InvalidArgumentException
     */
    public function int($var)
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
     * @param string    $var
     * @param int|float $value
     *
     * @throws \InvalidArgumentException
     */
    public function less($var, $value)
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
    public function lessStrict($var, $value)
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
     * @param string $value
     *
     * @throws \InvalidArgumentException
     */
    public function glob($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (empty($value)) {
                throw new \InvalidArgumentException('Param $value must be not empty');
            }

            if (!is_string($value)) {
                throw new \InvalidArgumentException('Param $value must be string');
            }

            if (!fnmatch($value, $var)) {
                throw new \InvalidArgumentException('var must apply glob pattern');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            if (!fnmatch($value, $var)) {
                throw new \InvalidArgumentException('var must apply glob pattern');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     * @param string $value
     *
     * @throws \InvalidArgumentException
     */
    public function match($var, $value)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (empty($value)) {
                throw new \InvalidArgumentException('Param $value must be not empty');
            }

            if (!is_string($value)) {
                throw new \InvalidArgumentException('Param $value must be string');
            }

            // God please sorry for this @
            $checkResult = @preg_match($value, $var);

            if ((preg_last_error() !== PREG_NO_ERROR) || ($checkResult === false)) {
                throw new \InvalidArgumentException('Param $value must be correct RegExp');
            }

            if ($checkResult === 0) {
                throw new \InvalidArgumentException('var must apply RegExp pattern');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE_ARGUMENTS);

        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            // God please sorry for this @
            $checkResult = @preg_match($value, $var);

            if ((preg_last_error() !== PREG_NO_ERROR) || ($checkResult === false)) {
                throw new \InvalidArgumentException('Param $value must be correct RegExp');
            }

            if ($checkResult === 0) {
                throw new \InvalidArgumentException('var must apply RegExp pattern');
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
    public function more($var, $value)
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
    public function moreStrict($var, $value)
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
    public function negative($var)
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
     *
     * @throws \InvalidArgumentException
     */
    public function notNull($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (is_null($var)) {
                throw new \InvalidArgumentException('var must be not null');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     *
     * @throws \InvalidArgumentException
     */
    public function isNull($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_null($var)) {
                throw new \InvalidArgumentException('var must be null');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     *
     * @throws \InvalidArgumentException
     */
    public function numeric($var)
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
    public function positive($var)
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
    public function resource($var)
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
    public function string($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            if (!is_string($var)) {
                throw new \InvalidArgumentException('var must be string');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    protected function configure()
    {
        $this->setName('benchmark:variable')
            ->setDescription('Benchmark of Assert validator');

        // Cache object
        Assert::assert('var', 'var');
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
     *
     * @throws \InvalidArgumentException
     */
    protected function runBenchmarkForValidator($methodName, $value, $arguments)
    {
        if (count($arguments) === 0) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Assert::assert($value, 'var')->{$methodName}();
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        } elseif (count($arguments) === 1) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Assert::assert($value, 'var')->{$methodName}($arguments[0]);
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        } elseif (count($arguments) === 2) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Assert::assert($value, 'var')->{$methodName}($arguments[0], $arguments[1]);
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        }
    }

    /**
     * @param string                               $methodName
     * @param int|float|string|resource|array|null $value
     * @param array                                $arguments
     *
     * @throws \InvalidArgumentException
     */
    protected function runBenchmarkForValidatorLight($methodName, $value, $arguments)
    {
        $validator = Assert::assert($value, 'var');

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
