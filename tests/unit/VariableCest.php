<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use index0h\validator\Variable;

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
            Variable::assert(new \stdClass(), 'var');
            $I->fail('First argument must not object');
        } catch (\InvalidArgumentException $error) {
        }

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

        $I->assertTrue(is_object(Variable::assert('var', 'var', '\Exception')));
    }

    /**
     * @param \UnitTester $I
     */
    public function get(\UnitTester $I)
    {
        $expected = 'SOME_DATA_HERE';
        $actual = Variable::assert($expected, 'var')->get();

        $I->assertEquals($expected, $actual);
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
    public function hasLength(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->hasLength('a');
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLength(-1);
            $I->fail('First argument must be >= 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthNot(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthNotArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->hasLengthNot('a');
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthNot(-1);
            $I->fail('First argument must be >= 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthBetween(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthBetweenArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->hasLengthBetween('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthBetween(1, 'b');
            $I->fail('Second argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthBetween(5, 2);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthBetween(-1, 2);
            $I->fail('First argument must be more than 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthLess(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthLessArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->hasLengthLess('a');
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthLess(-1);
            $I->fail('First argument must be more than 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthMore(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthMoreArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->hasLengthMore('a');
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthMore(-1);
            $I->fail('First argument must be more than 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthNotBetween(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function hasLengthNotBetweenArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->hasLengthNotBetween('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthNotBetween(1, 'b');
            $I->fail('Second argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthNotBetween(5, 2);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->hasLengthNotBetween(-1, 2);
            $I->fail('First argument must be more than 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isBetween(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isBetweenArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isBetween('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isBetween('a', 5.1);
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isBetween(1.2, 'b');
            $I->fail('Second argument must be  int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isBetween(100, 50);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isBetweenStrict(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isBetweenStrictArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isBetweenStrict('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isBetweenStrict('a', 5.1);
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isBetweenStrict(1.2, 'b');
            $I->fail('Second argument must be  int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isBetweenStrict(100, 50);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isFloat(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isInArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isJson(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isLess(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isLessArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isLess('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isLessStrict(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isLessStrictArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isLessStrict('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isMatchRegExp(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isMatchRegExpArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isMatchRegExp('');
            $I->fail('First argument must be not empty');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isMatchRegExp(5);
            $I->fail('First argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isMatchRegExp('a');
            $I->fail('First argument must be correct RegExp');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotMatchRegExp(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotMatchRegExpArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isNotMatchRegExp('');
            $I->fail('First argument must be not empty');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotMatchRegExp(5);
            $I->fail('First argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotMatchRegExp('a');
            $I->fail('First argument must be correct RegExp');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isMatchGlob(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isMatchGlobArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isMatchGlob('');
            $I->fail('First argument must be not empty');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isMatchGlob(5);
            $I->fail('First argument must be string');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotMatchGlob(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotMatchGlobArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isNotMatchGlob('');
            $I->fail('First argument must be not empty');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotMatchGlob(5);
            $I->fail('First argument must be string');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isMore(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isMoreArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isMore('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isMoreStrict(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isMoreStrictArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isMoreStrict('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isNegative(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotBetween(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotBetweenArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isNotBetween('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotBetween('a', 5.1);
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotBetween(1.2, 'b');
            $I->fail('Second argument must be  int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotBetween(100, 50);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotBetweenStrict(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotBetweenStrictArguments(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->isNotBetweenStrict('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotBetweenStrict('a', 5.1);
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotBetweenStrict(1.2, 'b');
            $I->fail('Second argument must be  int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->isNotBetweenStrict(100, 50);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotFloat(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotInArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotJson(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotNumeric(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNotString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNumeric(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isPositive(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function setExceptionClass(\UnitTester $I)
    {
        try {
            Variable::assert('var', 'var')->setExceptionClass(false);
            $I->fail('Argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Variable::assert('var', 'var')->setExceptionClass('\ArrayIterator');
            $I->fail('Argument must be sub class of \Exception');
        } catch (\InvalidArgumentException $error) {
        }

        Variable::assert('var', 'var')->setExceptionClass('\InvalidArgumentException');
    }

    /**
     * @param \UnitTester $I
     */
    public function toBool(\UnitTester $I)
    {
        $I->assertTrue(Variable::assert('var', 'var')->toBool()->get());
        $I->assertTrue(Variable::assert(5, 'var')->toBool()->get());
        $I->assertFalse(Variable::assert('', 'var')->toBool()->get());
        $I->assertFalse(Variable::assert(null, 'var')->toBool()->get());
        $I->assertFalse(Variable::assert(false, 'var')->toBool()->get());
        $I->assertFalse(Variable::assert([], 'var')->toBool()->get());
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloat(\UnitTester $I)
    {
        $I->assertEquals(0.0, Variable::assert('var', 'var')->toFloat()->get());
        $I->assertEquals(0.0, Variable::assert('', 'var')->toFloat()->get());
        $I->assertEquals(0.0, Variable::assert(null, 'var')->toFloat()->get());
        $I->assertEquals(0.0, Variable::assert(false, 'var')->toFloat()->get());
        $I->assertEquals(15.2, Variable::assert('15.2', 'var')->toFloat()->get());
        $I->assertEquals(2.0, Variable::assert(2, 'var')->toFloat()->get());
    }

    /**
     * @param \UnitTester $I
     */
    public function toInt(\UnitTester $I)
    {
        $I->assertEquals(0, Variable::assert('var', 'var')->toInt()->get());
        $I->assertEquals(0, Variable::assert('', 'var')->toInt()->get());
        $I->assertEquals(0, Variable::assert(null, 'var')->toInt()->get());
        $I->assertEquals(0, Variable::assert(false, 'var')->toInt()->get());
        $I->assertEquals(15, Variable::assert('15.2', 'var')->toInt()->get());
        $I->assertEquals(2, Variable::assert(2.1, 'var')->toInt()->get());
    }

    /**
     * @param \UnitTester $I
     */
    public function toString(\UnitTester $I)
    {
        $I->assertEquals('17', Variable::assert(17, 'var')->toString()->get());
        $I->assertEquals('2.1', Variable::assert(2.1, 'var')->toString()->get());
        $I->assertEquals('', Variable::assert(null, 'var')->toString()->get());
        $I->assertEquals('', Variable::assert(false, 'var')->toString()->get());
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
}