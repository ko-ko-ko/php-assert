<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\commands;

use index0h\validator\Cast;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CastBenchmarkCommand
 */
class CastBenchmarkCommand extends AbstractBenchmarkCommand
{
    const TYPE_CASTER = 'cast';

    const TYPE_CASTER_LIGHT = 'cast_light';

    protected $typeList = [self::TYPE_NATIVE, self::TYPE_CASTER_LIGHT, self::TYPE_CASTER];

    /**
     * @param mixed $var
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
        // Cache object
        Cast::assert('var', 'var');

        $this->setName('benchmark:cast')
            ->setDescription('Benchmark of Cast class');
    }

    /**
     * @param string $methodName
     * @param mixed  $value
     * @param array  $arguments
     */
    protected function runBenchmarkForCaster($methodName, $value, $arguments)
    {
        if (count($arguments) === 0) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Cast::assert($value, 'var')->{$methodName}()->getValue();
            }
            $this->stop($methodName, self::TYPE_CASTER);
        } elseif (count($arguments) === 1) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Cast::assert($value, 'var')->{$methodName}($arguments[0])->getValue();
            }
            $this->stop($methodName, self::TYPE_CASTER);
        } elseif (count($arguments) === 2) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                Cast::assert($value, 'var')->{$methodName}($arguments[0], $arguments[1])->getValue();
            }
            $this->stop($methodName, self::TYPE_CASTER);
        }
    }

    /**
     * @param string $methodName
     * @param mixed  $value
     * @param array  $arguments
     */
    protected function runBenchmarkForCasterLight($methodName, $value, $arguments)
    {
        $caster = Cast::assert($value, 'var');

        if (count($arguments) === 0) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $caster->{$methodName}()->getValue();
            }
            $this->stop($methodName, self::TYPE_CASTER_LIGHT);
        } elseif (count($arguments) === 1) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $caster->{$methodName}($arguments[0])->getValue();
            }
            $this->stop($methodName, self::TYPE_CASTER_LIGHT);
        } elseif (count($arguments) === 2) {
            $this->start();
            for ($i = 0; $i < self::COUNT_TEST; $i++) {
                $caster->{$methodName}($arguments[0], $arguments[1])->getValue();
            }
            $this->stop($methodName, self::TYPE_CASTER_LIGHT);
        }
    }

    /**
     * @param string $methodName
     * @param mixed  $value
     * @param array  $arguments
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
                // Cast light
                $this->runBenchmarkForCasterLight($method, $fixture['value'], $fixture['arguments']);
                // Cast
                $this->runBenchmarkForCaster($method, $fixture['value'], $fixture['arguments']);
            }
        }
    }
}
