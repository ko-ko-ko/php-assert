<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
namespace index0h\validator\tests\unit;

use AspectMock\Test as test;
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
            Cast::validate('var', 'var', false)->toBool('WRONG_TYPE');
            $I->fail('Wrong default value type');
        } catch (\Exception $error) {
        }

        Cast::validate('var', 'var', false)->toBool(Cast::DEFAULT_CAST_BOOL);
    }

    /**
     * @param \UnitTester $I
     */
    public function toIntDefault(\UnitTester $I)
    {
        try {
            Cast::validate('var', 'var', false)->toInt('WRONG_TYPE');
            $I->fail('Wrong default value type');
        } catch (\Exception $error) {
        }

        Cast::validate('var', 'var', false)->toBool(Cast::DEFAULT_CAST_INT);
    }

    /**
     * @param \UnitTester $I
     */
    public function toFloatDefault(\UnitTester $I)
    {
        try {
            Cast::validate('var', 'var', false)->toFloat('WRONG_TYPE');
            $I->fail('Wrong default value type');
        } catch (\Exception $error) {
        }

        Cast::validate('var', 'var', false)->toBool(Cast::DEFAULT_CAST_FLOAT);
    }

    /**
     * @param \UnitTester $I
     */
    public function toStringDefault(\UnitTester $I)
    {
        try {
            Cast::validate('var', 'var', false)->toString(false);
            $I->fail('Wrong default value type');
        } catch (\Exception $error) {
        }

        Cast::validate('var', 'var', false)->toBool(Cast::DEFAULT_CAST_STRING);
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

            $validator = Cast::validate($fixture['value'], 'var', false);

            $aspect = test::double($validator);

            call_user_func_array([$validator, $methodName], $fixture['arguments']);

            $aspect->verifyInvokedMultipleTimes('processError', $fixture['errors']);

            test::clean();

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