<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;
use index0h\validator\Variable;
use index0h\validator\request\AbstractRequest;

/**
 * Class RequestAbstractRequest
 */
abstract class RequestAbstractRequest
{
    const TEST_REQUEST_CLASS = '';

    /**
     * @param \UnitTester $I
     */
    public function get(\UnitTester $I)
    {
        $var = 'var';
        $aspect = test::double(static::TEST_REQUEST_CLASS, ['getParam' => $var]);

        /** @var AbstractRequest $req */
        $req = $aspect->make();

        $validator = $req->get('var');

        $I->assertEquals('index0h\validator\Variable', get_class($validator));
        $I->assertEquals($validator->get(), $var);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function getWrongVarName(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS)->make()->get(0);
            $I->fail('Wrong variable name');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toBool(\UnitTester $I)
    {
        $expected = true;

        $aspectCast = test::double('index0h\validator\Variable');
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => $expected]);

        /** @var AbstractRequest $req */
        $req = $aspectRequest->make();

        $actual = $req->toBool('var', $expected, $req->getExceptionClass())->get();

        $aspectCast->verifyInvokedOnce('assert');
        $aspectCast->verifyInvokedOnce('toBool');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toBoolWrongDefaultType(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS, ['getParam' => null])->make()->toBool('var', 'WRONG_TYPE');
            $I->fail('Wrong variable type');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toBoolWrongVarName(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS)->make()->toBool(0);
            $I->fail('Wrong variable name');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloat(\UnitTester $I)
    {
        $expected = 100.5;

        $aspectCast = test::double('index0h\validator\Variable');
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => $expected]);

        /** @var AbstractRequest $req */
        $req = $aspectRequest->make();

        $actual = $req->toFloat('var', $expected, $req->getExceptionClass())->get();

        $aspectCast->verifyInvokedOnce('assert');
        $aspectCast->verifyInvokedOnce('toFloat');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloatWrongDefaultType(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS, ['getParam' => null])->make()->toFloat('var', 'WRONG_TYPE');
            $I->fail('Wrong variable type');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloatWrongVarName(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS, ['getParam' => null])->make()->toFloat(0);
            $I->fail('Wrong variable name');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toInt(\UnitTester $I)
    {
        $expected = 100;

        $aspectCast = test::double('index0h\validator\Variable');
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => $expected]);

        /** @var AbstractRequest $req */
        $req = $aspectRequest->make();

        $actual = $req->toInt('var', $expected, $req->getExceptionClass())->get();

        $aspectCast->verifyInvokedOnce('assert');
        $aspectCast->verifyInvokedOnce('toInt');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toIntWrongDefaultType(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS, ['getParam' => null])->make()->toInt('var', 'WRONG_TYPE');
            $I->fail('Wrong variable type');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toIntWrongVarName(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS)->make()->toInt(0);
            $I->fail('Wrong variable name');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toString(\UnitTester $I)
    {
        $expected = 'var';

        $aspectCast = test::double('index0h\validator\Variable');
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => $expected]);

        /** @var AbstractRequest $req */
        $req = $aspectRequest->make();

        $actual = $req->toString('var', $expected, $req->getExceptionClass())->get();

        $aspectCast->verifyInvokedOnce('assert');
        $aspectCast->verifyInvokedOnce('toString');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toStringWrongDefaultType(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS, ['getParam' => null])->make()->toString('var', false);
            $I->fail('Wrong variable type');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toStringWrongVarName(\UnitTester $I)
    {
        try {
            test::double(static::TEST_REQUEST_CLASS)->make()->toString(0);
            $I->fail('Wrong variable name');
        } catch (\InvalidArgumentException $error) {
        }

        test::clean();
    }
}