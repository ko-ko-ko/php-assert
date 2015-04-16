<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use index0h\validator\Cast;

/**
 * Class CastCest
 */
class CastCest extends VariableCest
{
    /**
     * @param \UnitTester $I
     */
    public function toBoolDefault(\UnitTester $I)
    {
        try {
            Cast::assert('var', 'var')->toBool('WRONG_TYPE');
            $I->fail('Wrong default value type');
        } catch (\InvalidArgumentException $error) {
        }

        Cast::assert(Cast::DEFAULT_CAST_BOOL, 'var')->toBool(Cast::DEFAULT_CAST_BOOL);
    }

    /**
     * @param \UnitTester $I
     */
    public function toIntDefault(\UnitTester $I)
    {
        try {
            Cast::assert('var', 'var')->toInt('WRONG_TYPE');
            $I->fail('Wrong default value type');
        } catch (\InvalidArgumentException $error) {
        }

        Cast::assert(Cast::DEFAULT_CAST_INT, 'var')->toInt(Cast::DEFAULT_CAST_INT);
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloatDefault(\UnitTester $I)
    {
        try {
            Cast::assert('var', 'var')->toFloat('WRONG_TYPE');
            $I->fail('Wrong default value type');
        } catch (\InvalidArgumentException $error) {
        }

        Cast::assert(Cast::DEFAULT_CAST_FLOAT, 'var')->toFloat(Cast::DEFAULT_CAST_FLOAT);
    }

    /**
     * @param \UnitTester $I
     */
    public function toStringDefault(\UnitTester $I)
    {
        try {
            Cast::assert('var', 'var')->toString(false);
            $I->fail('Wrong default value type');
        } catch (\InvalidArgumentException $error) {
        }

        Cast::assert(Cast::DEFAULT_CAST_STRING, 'var')->toString(Cast::DEFAULT_CAST_STRING);
    }

    /**
     * @param \UnitTester $I
     */
    public function toBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloat(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function toInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param \UnitTester $I
     */
    public function toString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
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

            $validator = Cast::assert($fixture['value'], 'var');

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