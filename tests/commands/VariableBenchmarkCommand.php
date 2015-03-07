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

    /** @var array */
    private $fixtures;

    /** @var int */
    private $memory = 0;

    /** @var TableHelper */
    private $resultTable;

    /** @var float */
    private $time = 0;

    /** @var array */
    private $totalNative = ['time' => 0, 'memory' => 0];

    /** @var array */
    private $totalWithObjectCreation = ['time' => 0, 'memory' => 0];

    /** @var array */
    private $totalWithoutObjectCreation = ['time' => 0, 'memory' => 0];

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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
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
        return $this->stop();
    }

    /**
     * @param string $type
     * @param array  $results
     */
    protected function addTotal($type, $results)
    {
        $this->{$type}['time'] += $results['time'];
        $this->{$type}['memory'] += $results['memory'];
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

        $methods = $this->getValidationMethods();

        $this->resultTable = $this->getHelper('table');
        $this->resultTable
            ->setHeaders(
                [
                    'Test x' . self::COUNT_TEST,
                    'Type',
                    'Time, ms',
                    'Time rate, curr/min',
                    'Memory, byte',
                    'Memory rate, curr/min'
                ]
            );

        foreach ($methods as $method) {
            $this->processGroup($method);
        }
        $this->processTotal();

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

    /**
     * @param string $methodName
     */
    protected function processGroup($methodName)
    {
        $fixture = $this->getFixture($methodName);

        $native = $this->{$methodName}($fixture);
        $withoutObjectCreation = $this->processTestWithoutObjectCreation($methodName, $fixture);
        $withObjectCreation = $this->processTestWithObjectCreation($methodName, $fixture);

        $this->addTotal('totalNative', $native);
        $this->addTotal('totalWithoutObjectCreation', $withoutObjectCreation);
        $this->addTotal('totalWithObjectCreation', $withObjectCreation);

        $minTime = min($native['time'], $withObjectCreation['time'], $withoutObjectCreation['time']);
        $minMemory = min($native['memory'], $withObjectCreation['memory'], $withoutObjectCreation['memory']);

        $this->processRow($methodName, 'native', $native, $minTime, $minMemory);
        $this->processRow($methodName, 'validator (light)', $withoutObjectCreation, $minTime, $minMemory);
        $this->processRow($methodName, 'validator', $withObjectCreation, $minTime, $minMemory);

        $this->resultTable->addRows([new TableSeparator()]);
    }

    /**
     * @param string $methodName
     * @param string $type
     * @param array  $result
     * @param float  $minTime
     * @param int    $minMemory
     */
    protected function processRow($methodName, $type, $result, $minTime, $minMemory)
    {
        $this->resultTable->addRow(
            [
                $methodName,
                $type,
                round($result['time'] * 1000),
                'x' . round($result['time'] / $minTime, 2),
                $result['memory'],
                'x' . round($result['memory'] / $minMemory, 2)
            ]
        );
    }

    /**
     * @param string $methodName
     * @param mixed  $fixture
     *
     * @return array
     */
    protected function processTestWithObjectCreation($methodName, $fixture)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            Variable::assert($fixture, 'var')->{$methodName}();
        }
        return $this->stop();
    }

    /**
     * @param string $methodName
     * @param mixed  $fixture
     *
     * @return array
     */
    protected function processTestWithoutObjectCreation($methodName, $fixture)
    {
        $validator = Variable::assert($fixture, 'var');

        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            $validator->{$methodName}();
        }
        return $this->stop();
    }

    protected function processTotal()
    {
        $minTime = min(
            $this->totalNative['time'],
            $this->totalWithObjectCreation['time'],
            $this->totalWithoutObjectCreation['time']
        );
        $minMemory = min(
            $this->totalNative['memory'],
            $this->totalWithObjectCreation['memory'],
            $this->totalWithoutObjectCreation['memory']
        );

        $this->processRow('TOTAL', 'native', $this->totalNative, $minTime, $minMemory);
        $this->processRow('TOTAL', 'validator (light)', $this->totalWithoutObjectCreation, $minTime, $minMemory);
        $this->processRow('TOTAL', 'validator', $this->totalWithObjectCreation, $minTime, $minMemory);
    }

    protected function start()
    {
        $this->time = microtime(true);
        $this->memory = memory_get_usage();
    }

    /**
     * @return array
     */
    protected function stop()
    {
        $result = [
            'time' => (microtime(true) - $this->time),
            'memory' => (memory_get_usage() - $this->memory),
        ];
        $this->time = 0;
        $this->memory = 0;

        return $result;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    private function getFixture($name)
    {
        if (is_null($this->fixtures)) {
            $this->fixtures = [
                //
                'isArray' => [],
                'notArray' => false,
                //
                'isBool' => true,
                'notBool' => [],
                //
                'isCallable' => function () {
                },
                'notCallable' => '10',
                //
                'isDigit' => '50',
                'notDigit' => [],
                //
                'isFloat' => 10.15,
                'notFloat' => 'A',
                //
                'isEmail' => 'some_email@example.com',
                'notEmail' => 'not_email',
                //
                'isEmpty' => [],
                'notEmpty' => 'not_empty',
                //
                'isGraph' => 'a',
                'notGraph' => "\n",
                //
                'isInt' => 10,
                'notInt' => "A",
                //
                'isJson' => '{"a":"b"}',
                'notJson' => "-----",
                //
                'isNumeric' => '123',
                'notNumeric' => "-----",
                //
                'isMacAddress' => '01:02:03:a1:a2:a3',
                'notMacAddress' => "-----",
                //
                'isObject' => new \StdClass,
                'notObject' => 'A',
                //
                'isResource' => tmpfile(),
                'notResource' => 'A',
                //
                'isString' => 'A',
                'notString' => [],
            ];
        }

        return $this->fixtures[$name];
    }
}
