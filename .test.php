<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */

require_once __DIR__ . '/vendor/codeception/codeception/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application('Codeception', Codeception\Codecept::VERSION);
$app->add(new Codeception\Command\Run('run'));
$app->run();