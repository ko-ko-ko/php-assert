<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\commands;

use index0h\validator\Cast;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CastBenchmarkCommand
 */
class CastBenchmarkCommand extends Command
{
    const COUNT_TEST = 100000;

    const METRIC_MEMORY = 'memory';

    const METRIC_TIME = 'time';

    const TOTAL = 'TOTAL';

    const TYPE_NATIVE = 'native';

    const TYPE_VALIDATOR = 'cast';

    const TYPE_VALIDATOR_LIGHT = 'cast_light';

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
     * @param mixed $var
     *
     * @return array
     */
    public function toBool($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            if (!is_bool($tmpVar)) {
                if (empty($tmpVar)) {
                    $tmpVar = Cast::DEFAULT_CAST_BOOL;
                }
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param mixed $var
     *
     * @return array
     */
    public function toFloat($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            if (!is_float($tmpVar)) {
                if (empty($tmpVar)) {
                    $tmpVar = Cast::DEFAULT_CAST_FLOAT;
                } elseif (is_numeric($tmpVar) || is_bool($tmpVar)) {
                    $tmpVar = (float) $tmpVar;
                } else {
                    throw new \InvalidArgumentException('Can not cast $var to float');
                }
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param mixed $var
     *
     * @return array
     */
    public function toInt($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            if (!is_int($tmpVar)) {
                if (empty($tmpVar)) {
                    $tmpVar = Cast::DEFAULT_CAST_INT;
                } elseif (is_numeric($tmpVar) || is_bool($tmpVar)) {
                    $tmpVar = (int) $tmpVar;
                } else {
                    throw new \InvalidArgumentException('Can not cast $var to int');
                }
            }
        }
        $this->stop(__FUNCTION__, self::TYPE_NATIVE);
    }

    /**
     * @param mixed $var
     *
     * @return array
     */
    public function toString($var)
    {
        $this->start();
        for ($i = 0, $tmpVar = $var; $i < self::COUNT_TEST; $i++, $tmpVar = $var) {
            if (!is_string($tmpVar)) {
                if (empty($tmpVar)) {
                    $tmpVar = Cast::DEFAULT_CAST_STRING;
                } elseif (is_numeric($tmpVar) || is_bool($tmpVar)) {
                    $tmpVar = (string) $tmpVar;
                } elseif (is_object($tmpVar) && method_exists($tmpVar, '__toString')) {
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
        $this->setName('benchmark:cast')
            ->setDescription('Benchmark of Cast class');
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
        Cast::assert('var', 'var');

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
                Cast::assert($value, 'var')->{$methodName}()->getValue();
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        } elseif (count($arguments) === 1) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Cast::assert($value, 'var')->{$methodName}($arguments[0])->getValue();
            }
            $this->stop($methodName, self::TYPE_VALIDATOR);
        } elseif (count($arguments) === 2) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Cast::assert($value, 'var')->{$methodName}($arguments[0], $arguments[1])->getValue();
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
        $validator = Cast::assert($value, 'var');

        if (count($arguments) === 0) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $validator->{$methodName}()->getValue();
            }
            $this->stop($methodName, self::TYPE_VALIDATOR_LIGHT);
        } elseif (count($arguments) === 1) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $validator->{$methodName}($arguments[0])->getValue();
            }
            $this->stop($methodName, self::TYPE_VALIDATOR_LIGHT);
        } elseif (count($arguments) === 2) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $validator->{$methodName}($arguments[0], $arguments[1])->getValue();
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
                // Cast light
                $this->runBenchmarkForValidatorLight($method, $fixture['value'], $fixture['arguments']);
                // Cast
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
