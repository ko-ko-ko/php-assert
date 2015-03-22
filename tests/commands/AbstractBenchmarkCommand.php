<?php
/**
 * Created by PhpStorm.
 * User: index0h
 * Date: 22.03.15
 * Time: 18:03
 */

namespace index0h\validator\tests\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableHelper;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


abstract class AbstractBenchmarkCommand extends Command
{
    const COUNT_TEST = 1000;

    const METRIC_COUNT_TEST = 'count';

    const METRIC_MEMORY = 'memory';

    const METRIC_TIME = 'time';

    const TOTAL = 'TOTAL';

    const TYPE_NATIVE = 'native';

    const TYPE_VALIDATOR = 'validator';

    const TYPE_VALIDATOR_LIGHT = 'validator_light';

    /** @type array */
    protected $fixtures;

    /** @type int */
    protected $memory = 0;

    /** @type string[] */
    protected $metricList = [self::METRIC_TIME, self::METRIC_MEMORY, self::METRIC_COUNT_TEST];

    /** @type TableHelper */
    protected $resultTable;

    /** @type array */
    protected $results = [];

    /** @type float */
    protected $time = 0;

    /** @type string[] */
    protected $typeList = [];

    /**
     * @param OutputInterface $output
     */
    abstract protected function runBenchmarks(OutputInterface $output);

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->resultTable = $this->getHelper('table');
        $this->resultTable
            ->setHeaders(
                ['Test x{count}', 'Type', 'Time, ns/op', 'Time rate, curr/min', 'Memory, byte', 'Memory rate, curr/min']
            );

        $this->prepareResults();
        $this->runBenchmarks($output);
        $this->processResults();
        $this->processTable();

        $this->resultTable->render($output);
    }

    protected function getFixturesForMethod($methodName)
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

        return $result;
    }

    /**
     * @param string $methodName
     * @param string $metricName
     *
     * @return int|float
     */
    protected function getMinMetricForMethod($methodName, $metricName)
    {
        $result = PHP_INT_MAX;
        foreach ($this->results[$methodName] as $type => $value) {
            if ($result > $value[$metricName]) {
                $result = $value[$metricName];
            }
        }

        return $result;
    }

    /**
     * @return string[]
     */
    protected function getValidationMethods()
    {
        $result = [];

        $class = new \ReflectionClass($this);
        foreach ($class->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getDeclaringClass()->getName() === get_called_class()) {
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

        $emptyData = [self::METRIC_TIME => 0, self::METRIC_MEMORY => 0, self::METRIC_COUNT_TEST => 0];

        foreach ($methods as $methodName) {
            foreach ($this->typeList as $type) {
                $this->results[$methodName][$type] = $emptyData;
            }
        }
    }

    protected function processResults()
    {
        foreach ($this->results as $methodName => $results) {
            if ($methodName === self::TOTAL) {
                continue;
            }

            foreach ($this->typeList as $type) {
                foreach ($this->metricList as $metric) {
                    $this->results[self::TOTAL][$type][$metric] += $this->results[$methodName][$type][$metric];
                }
            }
        }
    }

    protected function processTable()
    {
        foreach ($this->results as $methodName => $results) {
            $minTime = $this->getMinMetricForMethod($methodName, self::METRIC_TIME);
            $minMemory = $this->getMinMetricForMethod($methodName, self::METRIC_MEMORY);

            foreach ($results as $type => $values) {
                $testName = $methodName . ' x' . $values[self::METRIC_COUNT_TEST];
                $time = ($values[self::METRIC_COUNT_TEST] > 0)
                    ? round($values[self::METRIC_TIME] / $values[self::METRIC_COUNT_TEST] * 1000000000)
                    : '-';
                $rateTime = ($minTime > 0) ? 'x' . round($values[self::METRIC_TIME] / $minTime, 2) : '-';

                $memory = ($values[self::METRIC_MEMORY] > 0) ? $values[self::METRIC_MEMORY] : '-';
                $rateMemory = ($minMemory > 0) ? 'x' . round($values[self::METRIC_MEMORY] / $minMemory, 2) : '-';

                $this->resultTable->addRow([$testName, $type, $time, $rateTime, $memory, $rateMemory]);
            }
            if ($methodName !== self::TOTAL) {
                $this->resultTable->addRows([new TableSeparator()]);
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
        $this->results[$methodName][$type][self::METRIC_COUNT_TEST] += self::COUNT_TEST;

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
}