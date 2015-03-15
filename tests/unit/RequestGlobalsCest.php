<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;
use index0h\validator\request\Globals;

/**
 * Class RequestGlobalsCest
 */
class RequestGlobalsCest extends RequestAbstractRequest
{
    const TEST_REQUEST_CLASS = '\index0h\validator\request\Globals';

    /**
     * @param \UnitTester $I
     */
    public function getParam(\UnitTester $I)
    {
        $var = 'SOME_TEST_VAR';
        $_GET[$var] = $var;

        $req = new Globals;

        $I->assertEquals($var, $req->get($var)->getValue());

        try {
            $class = new \ReflectionClass($req);
            $method = $class->getMethod('getParam');
            $method->setAccessible(true);

            $method->invokeArgs($req, ['name' => []]);

            $I->fail('Argument must be string');
        } catch (\InvalidArgumentException $error) {
        }
    }
}