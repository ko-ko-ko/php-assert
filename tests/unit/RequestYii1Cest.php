<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;
use index0h\validator\request\Yii1;

/**
 * Class RequestYii1Cest
 */
class RequestYii1Cest extends RequestAbstractRequest
{
    const TEST_REQUEST_CLASS = '\index0h\validator\request\Yii1';

    /**
     * @param \UnitTester $I
     */
    public function getParam(\UnitTester $I)
    {
        $var = 'SOME_TEST_VAR';
        $_GET[$var] = $var;

        $req = new Yii1(new \CHttpRequest);

        $I->assertEquals($var, $req->get($var)->get());

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