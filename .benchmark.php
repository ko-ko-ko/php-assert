<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
require_once __DIR__ . '/vendor/codeception/codeception/autoload.php';

use Symfony\Component\Console\Application;
use index0h\validator\tests\commands\VariableBenchmarkCommand;
use index0h\validator\tests\commands\CastBenchmarkCommand;
use index0h\validator\tests\commands\RespectBenchmarkCommand;

$app = new Application('Codeception', Codeception\Codecept::VERSION);
$app->add(new VariableBenchmarkCommand('benchmark:variable'));
$app->add(new CastBenchmarkCommand('benchmark:cast'));
$app->add(new RespectBenchmarkCommand('benchmark:respect'));
$app->run();