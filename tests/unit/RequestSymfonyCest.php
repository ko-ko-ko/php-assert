<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;

/**
 * Class RequestSymfonyCest
 */
class RequestSymfonyCest extends RequestAbstractRequest
{
    const TEST_REQUEST_CLASS = '\index0h\validator\request\Symfony';
}