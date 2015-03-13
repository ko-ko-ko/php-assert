<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;use index0h\validator\Variable;

/**
 * Class VariableCest
 */
class VariableCest
{
    /**
     * @param \UnitTester $I
     */
    public function assert(\UnitTester $I)
    {
        try {
            Variable::assert('var', false);
            $I->fail('Second argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var', false);
            $I->fail('Third argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var', '\ArrayIterator');
            $I->fail('Third argument must be sub class of \Exception');
        } catch (\InvalidArgumentException $error) {
        }

        $I->assertTrue(is_object(Variable::assert('var', 'var', '\InvalidArgumentException')));
    }
    /**
     * @param \UnitTester $I
     */
    public function getExceptionClass(\UnitTester $I)
    {
        $I->assertEquals(Variable::EXCEPTION_CLASS, Variable::assert('var', 'var')->getExceptionClass());
    }

    /**
     * @param \UnitTester $I
     */
    public function getSkipOnErrors(\UnitTester $I)
    {
        $I->assertEquals(true, Variable::validate('var', 'var')->getSkipOnErrors());
    }

    /**
     * @param \UnitTester $I
     */
    public function clearErrors(\UnitTester $I)
    {
        $validator = Variable::validate('var', 'var');

        $property = new \ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, ['some-error']);

        $I->assertEquals(get_class($validator), get_class($validator->clearErrors()));
        $I->assertEquals([], $validator->getErrors());
    }

    /**
     * @param \UnitTester $I
     */
    public function getErrors(\UnitTester $I)
    {
        $errors = ['some-error'];

        $validator = Variable::validate('var', 'var');

        $property = new \ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, $errors);

        $I->assertEquals($errors, $validator->getErrors());
    }

    /**
     * @param \UnitTester $I
     */
    public function getValue(\UnitTester $I)
    {
        $expected = 'SOME_DATA_HERE';
        $actual = Variable::assert($expected, 'var')->getValue();

        $I->assertEquals($expected, $actual);
    }

    /**
     * @param \UnitTester $I
     */
    public function hasErrors(\UnitTester $I)
    {
        $validator = Variable::validate('var', 'var');

        $I->assertFalse($validator->hasErrors());

        $property = new \ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, ['some-error']);

        $I->assertTrue($validator->hasErrors());
    }

    /**
     * @param \UnitTester $I
     */
    public function inArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__, [[1]]);
    }

    /**
     * @param \UnitTester $I
     */
    public function isArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isCallable(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isEmail(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isFloat(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isGraph(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isJson(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isMacAddress(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNegative(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNumeric(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isObject(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isPositive(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notCallable(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notEmail(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notFloat(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notGraph(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notInArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__, [[1]]);
    }

    /**
     * @param \UnitTester $I
     */
    public function notInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notJson(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notMacAddress(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notNumeric(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notObject(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
        $this->checkSkipErrors($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function setExceptionClass(\UnitTester $I)
    {
        try {
            Variable::validate('var', 'var')->setExceptionClass(false);
            $I->fail('Argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::validate('var', 'var')->setExceptionClass('\ArrayIterator');
            $I->fail('Argument must be sub class of \Exception');
        } catch (\InvalidArgumentException $error) {
        }

        Variable::validate('var', 'var')->setExceptionClass('\InvalidArgumentException');
    }

    /**
     * @param \UnitTester $I
     */
    public function setSkipOnError(\UnitTester $I)
    {
        try {
            Variable::validate('var', 'var')->setSkipOnErrors('notBool');
            $I->fail('Argument must be bool');
        } catch (\InvalidArgumentException $error) {
        }

        Variable::validate('var', 'var')->setSkipOnErrors(true);
    }

    /**
     * @param \UnitTester $I
     */
    public function setThrowErrors(\UnitTester $I)
    {
        try {
            Variable::validate('var', 'var')->setThrowErrors('notBool');
            $I->fail('Argument must be bool');
        } catch (\InvalidArgumentException $error) {
        }

        Variable::validate('var', 'var')->setThrowErrors(true);
    }

    /**
     * @param \UnitTester $I
     */
    public function validate(\UnitTester $I)
    {
        try {
            Variable::validate('var', false);
            $I->fail('Second argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::validate('var', 'var', 'notBool');
            $I->fail('Third argument must be bool');
        } catch (\InvalidArgumentException $error) {
        }

        $I->assertTrue(is_object(Variable::validate('var', 'var')));
    }

    /**
     * @param \UnitTester $I
     * @param string      $methodName
     */
    protected function check(\UnitTester $I, $methodName)
    {
        $I->wantToTest($methodName);
        $fixtures = $I->getFixturesForMethod($methodName);

        foreach ($fixtures as $fixture) {
            $I->amGoingTo('check with fixture: ' . $fixture['comment']);

            $validator = Variable::validate($fixture['value'], 'var', false);

            $aspect = test::double($validator);

            call_user_func_array([$validator, $methodName], $fixture['arguments']);

            $aspect->verifyInvokedMultipleTimes('processError', $fixture['errors']);

            test::clean();

            $validator = Variable::assert($fixture['value'], 'var');

            if ($fixture['errors'] === 0) {
                call_user_func_array([$validator, $methodName], $fixture['arguments']);
            } else {
                try {
                    call_user_func_array([$validator, $methodName], $fixture['arguments']);
                    $I->fail('Test must throw exception');
                } catch (\InvalidArgumentException $error) {
                }
            }
        }
    }

    /**
     * @param \UnitTester $I
     * @param string      $methodName
     * @param array       $arguments
     */
    protected function checkSkipErrors(\UnitTester $I, $methodName, $arguments = [])
    {
        $I->amGoingTo('check with skipErrors');

        $validator = Variable::validate('var', 'var', true);

        $property = new \ReflectionProperty($validator, 'errors');
        $property->setAccessible(true);
        $property->setValue($validator, ['some-error']);

        $aspect = test::double($validator);

        call_user_func_array([$validator, $methodName], $arguments);

        $aspect->verifyNeverInvoked('processError');

        test::clean();
    }
}