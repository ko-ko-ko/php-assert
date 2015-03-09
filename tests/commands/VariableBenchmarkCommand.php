<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\commands;

use index0h\validator\Variable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class VariableBenchmarkCommand
 */
class VariableBenchmarkCommand extends Command
{
    const COUNT_TEST = 100000;
    const TYPE_NATIVE = 'native';
    const TYPE_VALIDATOR = 'validator';
    const TYPE_VALIDATOR_LIGHT = 'validator_light';
    const METRIC_TIME = 'time';
    const METRIC_MEMORY = 'memory';
    const TOTAL = 'TOTAL';

    /** @type array */
    private $countTests = [self::TOTAL => 0];

    /** @type array */
    private $fixtures;

    /** @type int */
    private $memory = 0;

    /** @type TableHelper */
    private $resultTable;

    /** @type array */
    private $results = [];

    /** @type float */
    private $time = 0;

    /**
     * @param string $var
     *
     * @return array
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
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param array $var
     *
     * @return array
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
     * @param bool $var
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     * @return array
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

            if (!(bool)json_decode($var)) {
                throw new \InvalidArgumentException('var must be json');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     *
     * @return array
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
     * @param string $var
     *
     * @return array
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
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     * @return array
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
     * @return array
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
     * @param array $var
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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

            if ((bool)json_decode($var)) {
                throw new \InvalidArgumentException('var must be not json');
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param string $var
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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
     *
     * @return array
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

    protected function configure()
    {
        $this->setName('benchmark')
            ->setDescription('Benchmark of Variable validator');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Cache object
        Variable::assert('var', 'var');

        $this->resultTable = $this->getHelper('table');
        $this->resultTable
            ->setHeaders(
                ['Test x{count}', 'Type', 'Time, ms', 'Time rate, curr/min', 'Memory, byte', 'Memory rate, curr/min']
            );

        $this->prepareResults();
        $this->runBenchmarks($output);
        $this->processTable();

        $this->resultTable->render($output);
    }

    /**
     * @return string[]
     */
    protected function getValidationMethods()
    {
        $result = [];

        $class = new \ReflectionClass($this);
        foreach ($class->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() === __CLASS__) {
                $result[] = $method->getName();
            }
        }

        sort($result);

        return $result;
    }

    protected function prepareResults()
    {
        $this->results = [];

        $methods = $this->getValidationMethods();
        $methods[] = self::TOTAL;
        foreach ($methods as $methodName) {
            foreach ([self::TYPE_NATIVE, self::TYPE_VALIDATOR, self::TYPE_VALIDATOR_LIGHT] as $type) {
                $this->results[$methodName][$type] = [self::METRIC_TIME => 0, self::METRIC_MEMORY => 0];
            }
        }
    }

    protected function processTable()
    {
        $this->countTests[self::TOTAL] = array_sum(array_values($this->countTests));

        foreach ($this->results as $methodName => $results) {
            $minTime = min(
                $results[self::TYPE_NATIVE][self::METRIC_TIME],
                $results[self::TYPE_VALIDATOR][self::METRIC_TIME],
                $results[self::TYPE_VALIDATOR_LIGHT][self::METRIC_TIME]
            );

            $minMemory = min(
                $results[self::TYPE_NATIVE][self::METRIC_MEMORY],
                $results[self::TYPE_VALIDATOR][self::METRIC_MEMORY],
                $results[self::TYPE_VALIDATOR_LIGHT][self::METRIC_MEMORY]
            );

            foreach ($results as $type => $values) {
                $testName = $methodName . ' x' . (self::COUNT_TEST * $this->countTests[$methodName]);
                $time = round($values[self::METRIC_TIME] * 1000);
                $rateTime = ($minTime > 0) ? 'x' . round($values[self::METRIC_TIME] / $minTime, 2) : '-';
                $rateMemory = ($minMemory > 0) ? 'x' . round($values[self::METRIC_MEMORY] / $minMemory, 2) : '-';

                $this->resultTable
                    ->addRow([$testName, $type, $time, $rateTime, $values[self::METRIC_MEMORY], $rateMemory]);
            }
            if ($methodName !== self::TOTAL) {
                $this->resultTable->addRows([new TableSeparator()]);
            }
        }
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
    protected function runBenchmarks($output)
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

    protected function start()
    {
        $this->time = microtime(true);
        $this->memory = memory_get_usage();
    }

    protected function stop($methodName, $type)
    {
        $time = microtime(true) - $this->time;
        $memory = memory_get_usage() - $this->memory;

        $this->results[$methodName][$type][self::METRIC_TIME] += $time;
        $this->results[$methodName][$type][self::METRIC_MEMORY] += $memory;

        $this->results[self::TOTAL][$type][self::METRIC_TIME] += $time;
        $this->results[self::TOTAL][$type][self::METRIC_MEMORY] += $memory;

        $this->time = 0;
        $this->memory = 0;
    }

    /**
     * @return array
     */
    private function getFixtures()
    {
        if (!is_null($this->fixtures)) {
            return $this->fixtures;
        }

        $this->fixtures = require_once __DIR__ . '/../_data/fixtures/variable.php';

        return $this->fixtures;
    }

    /**
     * @param string $methodName
     *
     * @return array
     */
    private function getFixturesForMethod($methodName)
    {
        $result = [];
        foreach ($this->getFixtures() as $fixture) {
            if (!isset($fixture['errors'][$methodName])) {
                continue;
            }

            if ($fixture['errors'][$methodName] > 0) {
                continue;
            }

            if (!isset($fixture['arguments'])) {
                $fixture['arguments'] = [];
            }

            $fixture['errors'] = $fixture['errors'][$methodName];

            $result[] = $fixture;
        }

        $this->countTests[$methodName] = count($result);

        return $result;
    }
}
