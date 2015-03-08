<?php
use AspectMock\Test as test;
use index0h\validator\Variable;

/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
class VariableCest
{

    /** @var array */
    private static $fixtures;

    /**
     * @param UnitTester $I
     */
    public function clearErrors(\UnitTester $I)
    {
        $validator = Variable::validate('var', 'var');

        $property = new ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, ['some-error']);

        $I->assertEquals(get_class($validator), get_class($validator->clearErrors()));
        $I->assertEquals([], $validator->getErrors());
    }

    /**
     * @param UnitTester $I
     */
    public function getErrors(\UnitTester $I)
    {
        $errors = ['some-error'];

        $validator = Variable::validate('var', 'var');

        $property = new ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, $errors);

        $I->assertEquals($errors, $validator->getErrors());
    }

    /**
     * @param UnitTester $I
     */
    public function hasErrors(\UnitTester $I)
    {
        $validator = Variable::validate('var', 'var');

        $I->assertFalse($validator->hasErrors());

        $property = new ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, ['some-error']);

        $I->assertTrue($validator->hasErrors());
    }

    /**
     * @param UnitTester $I
     */
    public function isArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isCallable(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isEmail(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isFloat(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isGraph(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isJson(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isMacAddress(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isNegative(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isNumeric(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isObject(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isPositive(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notCallable(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notEmail(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notFloat(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notGraph(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notJson(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notMacAddress(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notNumeric(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notObject(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     * @param string     $methodName
     */
    private function check(\UnitTester $I, $methodName)
    {
        $I->wantToTest($methodName);
        $fixtures = $this->getFixturesForMethod($methodName);

        foreach ($fixtures as $fixture) {
            $I->amGoingTo('check with fixture: ' . $fixture['comment']);

            $validator = Variable::validate($fixture['value'], 'var', false);

            $aspect = test::double($validator);

            $validator->{$methodName}();

            $aspect->verifyInvokedMultipleTimes('processError', $fixture['errors']);

            test::clean();
        }
    }

    /**
     * @param UnitTester $I
     * @param string     $methodName
     */
    private function checkSkipErrors(\UnitTester $I, $methodName)
    {
        $I->amGoingTo('check with skipErrors');

        $validator = Variable::validate('var', 'var', true);

        $property = new ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, ['some-error']);

        $aspect = test::double($validator);

        $validator->{$methodName}();

        $aspect->verifyNeverInvoked('processError');

        test::clean();
    }

    /**
     * @return array
     */
    private function getFixtures()
    {
        if (!is_null(self::$fixtures)) {
            return self::$fixtures;
        }

        self::$fixtures = [
// []
            [
                'comment' => '[]',
                'value' => [],
                'errors' => [
                    //
                    'isArray' => 0,
                    'notArray' => 1,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 0,
                    'notEmpty' => 1,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 2,
                    'notJson' => 2,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 2,
                    'notMacAddress' => 2,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// new \ArrayIterator
            [
                'comment' => 'ArrayIterator',
                'value' => new \ArrayIterator,
                'errors' => [
                    //
                    'isArray' => 0,
                    'notArray' => 1,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 0,
                    'notObject' => 1,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// new \SplMinHeap
            [
                'comment' => 'SplMinHeap',
                'value' => new \SplMinHeap,
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 0,
                    'notObject' => 1,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// true
            [
                'comment' => 'true',
                'value' => true,
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 0,
                    'notBool' => 1,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// 10
            [
                'comment' => '10',
                'value' => 10,
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 0,
                    'notInt' => 1,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 0,
                    'notNumeric' => 1,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 0,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// '10'
            [
                'comment' => '"10"',
                'value' => '10',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 0,
                    'notDigit' => 1,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 0,
                    'notGraph' => 1,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 0,
                    'notJson' => 1,
                    //
                    'isNumeric' => 0,
                    'notNumeric' => 1,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 0,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// '10.25'
            [
                'comment' => '"10.25"',
                'value' => '10.25',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 0,
                    'notGraph' => 1,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 0,
                    'notJson' => 1,
                    //
                    'isNumeric' => 0,
                    'notNumeric' => 1,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 0,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// tmpfile()
            [
                'comment' => 'tmpfile()',
                'value' => tmpfile(),
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 0,
                    'notResource' => 1,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// 'some_string'
            [
                'comment' => '"some_string"',
                'value' => 'some_string',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 0,
                    'notGraph' => 1,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 0,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 0,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 2,
                    'isNegative' => 2,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// 'email@example.com'
            [
                'comment' => '"email@example.com"',
                'value' => 'email@example.com',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 0,
                    'notEmail' => 1,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 0,
                    'notGraph' => 1,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 0,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 0,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 2,
                    'isNegative' => 2,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// "a\t\r\n"
            [
                'comment' => '"a\t\r\n"',
                'value' => "a\t\r\n",
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 0,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 0,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 2,
                    'isNegative' => 2,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// '{"a" : "b"}'
            [
                'comment' => '"{"a" : "b"}"',
                'value' => '{"a" : "b"}',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 0,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 0,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 2,
                    'isNegative' => 2,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// '{"a":"b"}'
            [
                'comment' => '"{"a":"b"}"',
                'value' => '{"a":"b"}',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 0,
                    'notGraph' => 1,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 0,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 0,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 2,
                    'isNegative' => 2,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// 0
            [
                'comment' => '0',
                'value' => 0,
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 0,
                    'notEmpty' => 1,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 0,
                    'notInt' => 1,
                    //
                    'isJson' => 2,
                    'notJson' => 2,
                    //
                    'isNumeric' => 0,
                    'notNumeric' => 1,
                    //
                    'isMacAddress' => 2,
                    'notMacAddress' => 2,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// ''
            [
                'comment' => '""',
                'value' => '',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 0,
                    'notEmpty' => 1,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 2,
                    'isNegative' => 2,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// '01:02:03:a1:a2:a3'
            [
                'comment' => '"01:02:03:a1:a2:a3"',
                'value' => '01:02:03:a1:a2:a3',
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 0,
                    'notGraph' => 1,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 0,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 0,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 2,
                    'isNegative' => 2,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 0,
                    'notString' => 1,
                ]
            ],
// 15.25
            [
                'comment' => '15.25',
                'value' => 15.25,
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 0,
                    'notFloat' => 1,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 0,
                    'notNumeric' => 1,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 0,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// function () {}
            [
                'comment' => 'function () {}',
                'value' => function () {
                },
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 0,
                    'notCallable' => 1,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 1,
                    'notInt' => 0,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 1,
                    'notNumeric' => 0,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 0,
                    'notObject' => 1,
                    //
                    'isPositive' => 1,
                    'isNegative' => 1,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
// -8
            [
                'comment' => '-8',
                'value' => -8,
                'errors' => [
                    //
                    'isArray' => 1,
                    'notArray' => 0,
                    //
                    'isBool' => 1,
                    'notBool' => 0,
                    //
                    'isCallable' => 1,
                    'notCallable' => 0,
                    //
                    'isDigit' => 1,
                    'notDigit' => 0,
                    //
                    'isFloat' => 1,
                    'notFloat' => 0,
                    //
                    'isEmail' => 1,
                    'notEmail' => 0,
                    //
                    'isEmpty' => 1,
                    'notEmpty' => 0,
                    //
                    'isGraph' => 1,
                    'notGraph' => 0,
                    //
                    'isInt' => 0,
                    'notInt' => 1,
                    //
                    'isJson' => 1,
                    'notJson' => 1,
                    //
                    'isNumeric' => 0,
                    'notNumeric' => 1,
                    //
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    //
                    'isObject' => 1,
                    'notObject' => 0,
                    //
                    'isPositive' => 1,
                    'isNegative' => 0,
                    //
                    'isResource' => 1,
                    'notResource' => 0,
                    //
                    'isString' => 1,
                    'notString' => 0,
                ]
            ],
        ];

        return self::$fixtures;
    }

    /**
     * @param string $methodName
     *
     * @return array
     */
    private function getFixturesForMethod($methodName)
    {
        $result = [];
        foreach ($this->getFixtures() as $fixture) {
            if (!isset($fixture['errors'][$methodName])) {
                continue;
            }

            $fixture['errors'] = $fixture['errors'][$methodName];

            $result[] = $fixture;
        }

        return $result;
    }
}