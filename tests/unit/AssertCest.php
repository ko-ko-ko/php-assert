<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */
namespace KoKoKo\assert\tests\unit;

use KoKoKo\assert\Assert;

/**
 * Class AssertCest
 */
class AssertCest
{
    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function assert(\UnitTester $I)
    {
        try {
            Assert::assert(new \stdClass(), 'var');
            $I->fail('First argument must not object');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', false);
            $I->fail('Second argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var', false);
            $I->fail('Third argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var', '\ArrayIterator');
            $I->fail('Third argument must be sub class of \Exception');
        } catch (\InvalidArgumentException $error) {
        }

        $I->assertTrue(is_object(Assert::assert('var', 'var', '\Exception')));
    }

    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function get(\UnitTester $I)
    {
        $expected = 'SOME_DATA_HERE';
        $actual = Assert::assert($expected, 'var')->get();

        $I->assertEquals($expected, $actual);
    }

    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function getExceptionClass(\UnitTester $I)
    {
        $I->assertEquals(Assert::EXCEPTION_CLASS, Assert::assert('var', 'var')->getExceptionClass());
    }

    /**
     * @param \UnitTester $I
     */
    public function length(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function lengthArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->length('a');
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->length(-1);
            $I->fail('First argument must be >= 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function lengthBetween(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function lengthBetweenArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->lengthBetween('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->lengthBetween(1, 'b');
            $I->fail('Second argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->lengthBetween(5, 2);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->lengthBetween(-1, 2);
            $I->fail('First argument must be more than 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function lengthLess(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function lengthLessArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->lengthLess('a');
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->lengthLess(-1);
            $I->fail('First argument must be more than 0');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function lengthMore(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function lengthMoreArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->lengthMore('a');
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->lengthMore(-1);
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
    public function between(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function betweenArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->between('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->between('a', 5.1);
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->between(1.2, 'b');
            $I->fail('Second argument must be  int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->between(100, 50);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function betweenStrict(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function betweenStrictArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->betweenStrict('a', 5);
            $I->fail('First argument must be int');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->betweenStrict('a', 5.1);
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->betweenStrict(1.2, 'b');
            $I->fail('Second argument must be  int or float');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->betweenStrict(100, 50);
            $I->fail('First argument must be less than second');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function bool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function digit(\UnitTester $I)
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
    public function float(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function inArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function int(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function less(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function lessArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->less('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function lessStrict(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function lessStrictArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->lessStrict('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function glob(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function globArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->glob('');
            $I->fail('First argument must be not empty');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->glob(5);
            $I->fail('First argument must be string');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function match(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function matchArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->match('');
            $I->fail('First argument must be not empty');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->match(5);
            $I->fail('First argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->match('a');
            $I->fail('First argument must be correct RegExp');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function more(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function moreArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->more('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function moreStrict(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function moreStrictArguments(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->moreStrict('a');
            $I->fail('First argument must be int or float');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     */
    public function negative(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function notNull(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function isNull(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function numeric(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function positive(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function resource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function string(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function setExceptionClass(\UnitTester $I)
    {
        try {
            Assert::assert('var', 'var')->setExceptionClass(false);
            $I->fail('Argument must be string');
        } catch (\InvalidArgumentException $error) {
        }

        try {
            Assert::assert('var', 'var')->setExceptionClass('\ArrayIterator');
            $I->fail('Argument must be sub class of \Exception');
        } catch (\InvalidArgumentException $error) {
        }

        Assert::assert('var', 'var')->setExceptionClass('\InvalidArgumentException');
    }

    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function toBool(\UnitTester $I)
    {
        $I->assertTrue(Assert::assert('var', 'var')->toBool()->get());
        $I->assertTrue(Assert::assert(5, 'var')->toBool()->get());
        $I->assertFalse(Assert::assert('', 'var')->toBool()->get());
        $I->assertFalse(Assert::assert(null, 'var')->toBool()->get());
        $I->assertFalse(Assert::assert(false, 'var')->toBool()->get());
        $I->assertFalse(Assert::assert([], 'var')->toBool()->get());
    }

    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function toFloat(\UnitTester $I)
    {
        $I->assertEquals(0.0, Assert::assert('var', 'var')->toFloat()->get());
        $I->assertEquals(0.0, Assert::assert('', 'var')->toFloat()->get());
        $I->assertEquals(0.0, Assert::assert(null, 'var')->toFloat()->get());
        $I->assertEquals(0.0, Assert::assert(false, 'var')->toFloat()->get());
        $I->assertEquals(15.2, Assert::assert('15.2', 'var')->toFloat()->get());
        $I->assertEquals(2.0, Assert::assert(2, 'var')->toFloat()->get());

        try {
            Assert::assert([], 'var')->toFloat();
            $I->fail('Value must be not array');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function toInt(\UnitTester $I)
    {
        $I->assertEquals(0, Assert::assert('var', 'var')->toInt()->get());
        $I->assertEquals(0, Assert::assert('', 'var')->toInt()->get());
        $I->assertEquals(0, Assert::assert(null, 'var')->toInt()->get());
        $I->assertEquals(0, Assert::assert(false, 'var')->toInt()->get());
        $I->assertEquals(15, Assert::assert('15.2', 'var')->toInt()->get());
        $I->assertEquals(2, Assert::assert(2.1, 'var')->toInt()->get());

        try {
            Assert::assert([], 'var')->toInt();
            $I->fail('Value must be not array');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     *
     * @throws \InvalidArgumentException
     */
    public function toString(\UnitTester $I)
    {
        $I->assertEquals('17', Assert::assert(17, 'var')->toString()->get());
        $I->assertEquals('2.1', Assert::assert(2.1, 'var')->toString()->get());
        $I->assertEquals('', Assert::assert(null, 'var')->toString()->get());
        $I->assertEquals('', Assert::assert(false, 'var')->toString()->get());

        try {
            Assert::assert([], 'var')->toString();
            $I->fail('Value must be not array');
        } catch (\InvalidArgumentException $error) {
        }
    }

    /**
     * @param \UnitTester $I
     * @param string      $methodName
     *
     * @throws \InvalidArgumentException
     */
    protected function check(\UnitTester $I, $methodName)
    {
        $methodNameSplit = implode(' ', preg_split('/(?=[A-Z])/', $methodName));

        $I->wantToTest($methodNameSplit);
        $fixtures = $I->getFixturesForMethod($methodName);

        foreach ($fixtures as $fixture) {
            $I->amGoingTo('check with fixture: ' . $fixture['comment']);

            $validator = Assert::assert($fixture['value'], 'var');

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