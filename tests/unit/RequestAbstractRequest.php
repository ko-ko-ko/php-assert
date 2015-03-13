<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;
use index0h\validator\Cast;
use index0h\validator\request\AbstractRequest;

/**
 * Class RequestAbstractRequest
 */
abstract class RequestAbstractRequest
{
    const CAST_CLASS_NAME = 'index0h\validator\Cast';

    const TEST_REQUEST_CLASS = '';

    /**
     * @param \UnitTester $I
     */
    public function getWithSoft(\UnitTester $I)
    {
        $var = 'var';
        $aspect = test::double(static::TEST_REQUEST_CLASS, ['getParam' => $var]);

        /** @type AbstractRequest $req */
        $req = $aspect->make()->setSoft();

        $validator = $req->get('var');

        $I->assertEquals('index0h\validator\Cast', get_class($validator));
        $I->assertEquals($validator->getValue(), $var);
        $I->assertFalse($validator->getThrowException());

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function getWithStrict(\UnitTester $I)
    {
        $var = 'var';
        $aspect = test::double(static::TEST_REQUEST_CLASS, ['getParam' => $var]);

        /** @type AbstractRequest $req */
        $req = $aspect->make()->setStrict();

        $validator = $req->get('var');

        $I->assertEquals('index0h\validator\Cast', get_class($validator));
        $I->assertEquals($validator->getValue(), $var);
        $I->assertTrue($validator->getThrowException());

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
    public function setSoft(\UnitTester $I)
    {
        /** @type AbstractRequest $req */
        $req = test::double(static::TEST_REQUEST_CLASS)->make();

        try {
            $req->setSoft('var');
            $I->fail('Wrong variable type');
        } catch (\InvalidArgumentException $error) {
        }

        $req->setStrict();

        $req->setSoft(false);
        $I->assertFalse($req->getSkipOnErrors());
        $I->assertFalse($req->getThrowException());

        $req->setSoft();
        $I->assertFalse($req->getThrowException());
        $I->assertTrue($req->getSkipOnErrors());

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function setStrict(\UnitTester $I)
    {
        /** @type AbstractRequest $req */
        $req = test::double(static::TEST_REQUEST_CLASS)->make();

        try {
            $req->setStrict('var');
            $I->fail('Wrong variable type');
        } catch (\InvalidArgumentException $error) {
        }

        $req->setSoft();

        $req->setStrict('\DomainException');
        $I->assertEquals('\DomainException', $req->getExceptionClass());
        $I->assertTrue($req->getThrowException());

        $req->setSoft();

        $req->setStrict();
        $I->assertEquals(Cast::EXCEPTION_CLASS, $req->getExceptionClass());
        $I->assertTrue($req->getThrowException());

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toBoolSoft(\UnitTester $I)
    {
        $expected = true;

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setSoft();

        $actual = $req->toBool('var', $expected)->getValue();

        $aspectCast->verifyInvokedOnce('validate');
        $aspectCast->verifyInvokedOnce('toBool');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toBoolStrict(\UnitTester $I)
    {
        $expected = true;

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setStrict();

        $actual = $req->toBool('var', $expected)->getValue();

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
    public function toFloatSoft(\UnitTester $I)
    {
        $expected = 100.5;

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setSoft();

        $actual = $req->toFloat('var', $expected)->getValue();

        $aspectCast->verifyInvokedOnce('validate');
        $aspectCast->verifyInvokedOnce('toFloat');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloatStrict(\UnitTester $I)
    {
        $expected = 100.5;

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setStrict();

        $actual = $req->toFloat('var', $expected)->getValue();

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
    public function toIntSoft(\UnitTester $I)
    {
        $expected = 100;

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setSoft();

        $actual = $req->toInt('var', $expected)->getValue();

        $aspectCast->verifyInvokedOnce('validate');
        $aspectCast->verifyInvokedOnce('toInt');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toIntStrict(\UnitTester $I)
    {
        $expected = 100;

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setStrict();

        $actual = $req->toInt('var', $expected)->getValue();

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
    public function toStringSoft(\UnitTester $I)
    {
        $expected = 'var';

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setSoft();

        $actual = $req->toString('var', $expected)->getValue();

        $aspectCast->verifyInvokedOnce('validate');
        $aspectCast->verifyInvokedOnce('toString');
        $I->assertEquals($expected, $actual);

        test::clean();
    }

    /**
     * @param \UnitTester $I
     */
    public function toStringStrict(\UnitTester $I)
    {
        $expected = 'var';

        $aspectCast = test::double(self::CAST_CLASS_NAME);
        $aspectRequest = test::double(static::TEST_REQUEST_CLASS, ['getParam' => null]);

        /** @type AbstractRequest $req */
        $req = $aspectRequest->make()->setStrict();

        $actual = $req->toString('var', $expected)->getValue();

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