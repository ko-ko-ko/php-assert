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

    /** @type string[] */
    protected $typeList = [
        self::TYPE_VALIDATOR,
        self::TYPE_RESPECT,
    ];

    /**
     * @param string $var
     * @param array  $array
     */
    public function inArray($var, $array)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::in($array)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param array $var
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
     * @param callable $var
     */
    public function isCallable($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::type('callable')->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
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
     * @param string $var
     */
    public function isEmail($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::email()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param float $var
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
     */
    public function isGraph($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::graph()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param int $var
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
     * @param string $var
     * @param int    $from
     * @param int    $to
     *
     * @return array
     */
    public function isLengthBetween($var, $from, $to)
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
     */
    public function isLengthLess($var, $value)
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
     */
    public function isLengthMore($var, $value)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::length($value, null)->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string    $var
     * @param int|float $value
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
     * @param string $var
     */
    public function isMacAddress($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::macAddress()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string    $var
     * @param int|float $value
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
     * @param string $var
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
     * @param object $var
     */
    public function isObject($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::object()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
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
     */
    public function isString($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::string()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string    $var
     * @param int|float $from
     * @param int|float $to
     */
    public function notBetween($var, $from, $to)
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
     */
    public function notBetweenStrict($var, $from, $to)
    {
        $this->start();
        for ($j = 0; $j < self::COUNT_TEST; $j++) {
            respect::not(respect::between($from, $to, true))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param array $var
     */
    public function notBool($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::bool())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notCallable($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::type('callable'))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param array $var
     */
    public function notDigit($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::digit())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notEmail($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::email())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notEmpty($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::notEmpty()->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notFloat($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::float())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notGraph($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::graph())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notInArray($var, $array)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::in($array))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notInt($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::int())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notJson($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::json())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notMacAddress($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::macAddress())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notNumeric($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::numeric())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notObject($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::object())->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param string $var
     */
    public function notResource($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::type('resource'))->assert($var);
        }
        $this->stop(__FUNCTION__, self::TYPE_RESPECT);
    }

    /**
     * @param array $var
     */
    public function notString($var)
    {
        $this->start();
        for ($i = 0; $i < self::COUNT_TEST; $i++) {
            respect::not(respect::string())->assert($var);
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
     * @param string $methodName
     * @param        $value
     * @param        $arguments
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
     * @param OutputInterface $output
     */
    protected function runBenchmarks(OutputInterface $output)
    {
        $methods = $this->getValidationMethods();

        foreach ($methods as $method) {
            $output->writeln('<info>process tests for: ' . $method . '</info>');
            $fixtures = $this->getFixturesForMethod($method);
            foreach ($fixtures as $fixture) {
                try {
                    // Respect
                    $this->runBenchmarkForRespect($method, $fixture['value'], $fixture['arguments']);
                } catch (\Exception $error) {
                    $output->writeln(
                        sprintf(
                            '<error>RESPECT: error in method: %s with fixture: %s</error>',
                            $method,
                            $fixture ['comment']
                        )
                    );
                }
                try {
                    // Validator
                    $this->runBenchmarkForValidator($method, $fixture['value'], $fixture['arguments']);
                } catch (\Exception $error) {
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
    }
}
