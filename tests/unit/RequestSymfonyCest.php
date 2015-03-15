<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;
use index0h\validator\request\Symfony as Req;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestSymfonyCest
 */
class RequestSymfonyCest extends RequestAbstractRequest
{
    const TEST_REQUEST_CLASS = '\index0h\validator\request\Symfony';

    /**
     * @param \UnitTester $I
     */
    public function getParam(\UnitTester $I)
    {
        $var = 'SOME_TEST_VAR';
        $req = new Req(new Request([$var => $var], [$var => $var]));

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