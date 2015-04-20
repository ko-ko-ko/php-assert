<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\commands;

use Assert as beberlei;
use index0h\validator\Variable;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BeberleiBenchmarkCommand
 */
class BeberleiBenchmarkCommand extends AbstractBenchmarkCommand
{
    const TYPE_BEBERLEI = 'beberlei_assert';

    /** @var string[] */
    protected $typeList = [
        self::TYPE_VALIDATOR,
        self::TYPE_BEBERLEI,
    ];

    /**
     * @param string $var
     * @param int    $length
     *
     * @throws \InvalidArgumentException
     */
    public function hasLength($var, $length)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            beberlei\that($var)->length($length);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
    }

    /**
     * @param string $var
     * @param int    $from
     * @param int    $to
     *
     * @throws \InvalidArgumentException
     */
    public function hasLengthBetween($var, $from, $to)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            beberlei\that($var)->betweenLength($from, $to);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
    }

    /**
     * @param string $var
     * @param int    $value
     *
     * @throws \InvalidArgumentException
     */
    public function hasLengthLess($var, $value)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            beberlei\that($var)->maxLength($value);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
    }

    /**
     * @param string $var
     * @param int    $value
     *
     * @throws \InvalidArgumentException
     */
    public function hasLengthMore($var, $value)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            beberlei\that($var)->minLength($value);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->isArray();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->min($from)->max($to);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->boolean();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->digit();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->float();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
    }

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
            beberlei\that($var)->inArray($array);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->integer();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            beberlei\that($var)->max($value);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            beberlei\that($var)->min($value);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->max(0);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
    }

    /**
     * @param mixed $var
     *
     * @throws \InvalidArgumentException
     */
    public function isNotNull($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            beberlei\that($var)->notNull();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->numeric();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->min(0);
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
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
            beberlei\that($var)->string();
        }
        $this->stop(__FUNCTION__, self::TYPE_BEBERLEI);
    }

    protected function configure()
    {
        $this->setName('benchmark:beberlei')
            ->setDescription('Benchmark of Variable validator vs Beberlei Assert');

        // Cache object
        Variable::assert('var', 'var');
    }

    /**
     * @param string                               $methodName
     * @param int|float|string|resource|array|null $value
     * @param array                                $arguments
     *
     * @throws \InvalidArgumentException
     */
    protected function runBenchmarkForRespect($methodName, $value, $arguments)
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
     * @param OutputInterface $output
     */
    protected function runBenchmarks(OutputInterface $output)
    {
        $methods = $this->getValidationMethods();

        foreach ($methods as $method) {
            $output->writeln('<info>process tests for: ' . $method . '</info>');
            $fixtures = $this->getFixturesForMethod($method);

            $respectOk = true;
            $validatorOk = true;

            foreach ($fixtures as $fixture) {
                if ($respectOk) {
                    try {
                        // Respect
                        $this->runBenchmarkForRespect($method, $fixture['value'], $fixture['arguments']);
                    } catch (\Exception $error) {
                        $respectOk = false;
                        $output->writeln(
                            sprintf(
                                '<error>BEBERLEI: error in method: %s with fixture: %s</error>',
                                $method,
                                $fixture ['comment']
                            )
                        );
                    }
                }

                if ($validatorOk) {
                    try {
                        // Validator
                        $this->runBenchmarkForValidator($method, $fixture['value'], $fixture['arguments']);
                    } catch (\Exception $error) {
                        $validatorOk = false;
                        $output->writeln(
                            sprintf(
                                '<error>VALIDATOR: error in method: %s with fixture: %s</error>',
                                $method,
                                $fixture ['comment']
                            )
                        );
                    }
                }
            }

            if (!$respectOk) {
                $this->results[$method][self::TYPE_BEBERLEI][self::METRIC_TIME] = 0;
                $this->results[$method][self::TYPE_BEBERLEI][self::METRIC_MEMORY] = 0;
                $this->results[$method][self::TYPE_BEBERLEI][self::METRIC_COUNT_TEST] = 0;
            }

            if (!$validatorOk) {
                $this->results[$method][self::TYPE_VALIDATOR][self::METRIC_TIME] = 0;
                $this->results[$method][self::TYPE_VALIDATOR][self::METRIC_MEMORY] = 0;
                $this->results[$method][self::TYPE_VALIDATOR][self::METRIC_COUNT_TEST] = 0;
            }
        }
    }
}
