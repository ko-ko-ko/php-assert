<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */
require_once __DIR__ . '/vendor/codeception/codeception/autoload.php';

use Symfony\Component\Console\Application;
use KoKoKo\assert\tests\commands\AssertBenchmarkCommand;
use KoKoKo\assert\tests\commands\RespectBenchmarkCommand;
use KoKoKo\assert\tests\commands\BeberleiBenchmarkCommand;

$app = new Application('Codeception', Codeception\Codecept::VERSION);
$app->add(new AssertBenchmarkCommand('benchmark:variable'));
$app->add(new RespectBenchmarkCommand('benchmark:respect'));
$app->add(new BeberleiBenchmarkCommand('benchmark:beberlei'));
$app->run();