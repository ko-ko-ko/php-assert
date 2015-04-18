<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\commands;

use index0h\validator\Variable;
use Respect\Validation\Validator as respect;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RespectBenchmarkCommand
 */
class RespectBenchmarkCommand extends AbstractBenchmarkCommand
{
    const TYPE_RESPECT = 'respect';

    /** @var string[] */
    protected $typeList = [
        self::TYPE_VALIDATOR,
        self::TYPE_RESPECT,
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
            respect::length($length, $length)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::length($from, $to)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::length(null, $value)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::length($value, null)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     * @param int    $length
     *
     * @throws \InvalidArgumentException
     */
    public function hasLengthNot($var, $length)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::not(respect::length($length, $length))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     * @param int    $from
     * @param int    $to
     *
     * @throws \InvalidArgumentException
     */
    public function hasLengthNotBetween($var, $from, $to)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::not(respect::length($from, $to))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::arr()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::between($from, $to, true)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::between($from, $to)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::bool()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::digit()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::float()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::in($array)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::int()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::json()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::max($value, true)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::max($value)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::min($value, true)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::min($value)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::negative()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::not(respect::between($from, $to))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::not(respect::between($from, $to, true))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::bool())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::digit())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::notEmpty()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::float())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::in($array))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::int())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::json())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     *
     * @throws \InvalidArgumentException
     */
    public function isNotNull($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::nullValue())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::numeric())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::type('resource'))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::not(respect::string())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::nullValue()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::numeric()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::positive()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::type('resource')->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
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
            respect::string()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    protected function configure()
    {
        $this->setName('benchmark:respect')
            ->setDescription('Benchmark of Variable validator vs Respect Validation');

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
                                '<error>RESPECT: error in method: %s with fixture: %s</error>',
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
                $this->results[$method][self::TYPE_RESPECT][self::METRIC_TIME] = 0;
                $this->results[$method][self::TYPE_RESPECT][self::METRIC_MEMORY] = 0;
                $this->results[$method][self::TYPE_RESPECT][self::METRIC_COUNT_TEST] = 0;
            }

            if (!$validatorOk) {
                $this->results[$method][self::TYPE_VALIDATOR][self::METRIC_TIME] = 0;
                $this->results[$method][self::TYPE_VALIDATOR][self::METRIC_MEMORY] = 0;
                $this->results[$method][self::TYPE_VALIDATOR][self::METRIC_COUNT_TEST] = 0;
            }
        }
    }
}
