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
    public function isArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isEmail(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isGraph(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isMacAddress(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isObject(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function isString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notArray(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notBool(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notDigit(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notEmail(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notEmpty(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notGraph(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notInt(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notMacAddress(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notObject(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notResource(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
    }

    /**
     * @param UnitTester $I
     */
    public function notString(\UnitTester $I)
    {
        $this->check($I, __FUNCTION__);
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
     * @return array
     */
    private function getFixtures()
    {
        if (!is_null(self::$fixtures)) {
            return self::$fixtures;
        }

        self::$fixtures = [
            [
                'comment' => '[]',
                'value' => [],
                'errors' => [
                    'isArray' => 0,
                    'isEmpty' => 0,
                    'isMacAddress' => 2,
                    'notArray' => 1,
                    'notMacAddress' => 2,
                    'notEmpty' => 1
                ]
            ],
            [
                'comment' => 'ArrayIterator',
                'value' => new \ArrayIterator,
                'errors' => [
                    'isArray' => 0,
                    'isObject' => 0,
                    'notArray' => 1,
                    'notObject' => 1,
                    'notMacAddress' => 1
                ]
            ],
            [
                'comment' => 'SplMinHeap',
                'value' => new \SplMinHeap,
                'errors' => [
                    'isObject' => 0,
                    'notObject' => 1,
                    'notMacAddress' => 1
                ]
            ],
            [
                'comment' => 'true',
                'value' => true,
                'errors' => [
                    'isBool' => 0,
                    'notBool' => 1,
                    'notMacAddress' => 1
                ]
            ],
            [
                'comment' => '10',
                'value' => 10,
                'errors' => [
                    'isInt' => 0,
                    'isNumeric' => 0,
                    'notInt' => 1,
                    'notMacAddress' => 1
                ]
            ],
            [
                'comment' => '"10"',
                'value' => '10',
                'errors' => [
                    'isNumeric' => 0,
                    'isDigit' => 0,
                    'isGraph' => 0,
                    'isString' => 0,
                    'notDigit' => 1,
                    'notString' => 1,
                    'notGraph' => 1
                ]
            ],
            [
                'comment' => '"10.25"',
                'value' => '10.25',
                'errors' => [
                    'isNumeric' => 0,
                    'isString' => 0,
                    'isGraph' => 0,
                    'notString' => 1,
                    'notGraph' => 1
                ]
            ],
            [
                'comment' => 'tmpfile()',
                'value' => tmpfile(),
                'errors' => [
                    'isResource' => 0,
                    'notResource' => 1,
                    'notMacAddress' => 1
                ]
            ],
            [
                'comment' => '"some_string"',
                'value' => 'some_string',
                'errors' => [
                    'isString' => 0,
                    'isGraph' => 0,
                    'notString' => 1,
                    'notGraph' => 1
                ]
            ],
            [
                'comment' => '"email@example.com"',
                'value' => 'email@example.com',
                'errors' => [
                    'isEmail' => 0,
                    'isString' => 0,
                    'isGraph' => 0,
                    'notString' => 1,
                    'notGraph' => 1,
                    'notEmail' => 1
                ]
            ],
            [
                'comment' => '"a\t\r\n"',
                'value' => "a\t\r\n",
                'errors' => [
                    'isString' => 0,
                    'notString' => 1
                ]
            ],
            [
                'comment' => '"{"a": "b"}"',
                'value' => '{"a": "b"}',
                'errors' => [
                    'isJson' => 0,
                    'isString' => 0,
                    'notString' => 1
                ]
            ],
            [
                'comment' => '"{"a":"b"}"',
                'value' => '{"a":"b"}',
                'errors' => [
                    'isJson' => 0,
                    'isString' => 0,
                    'isGraph' => 0,
                    'notString' => 1,
                    'notGraph' => 1
                ]
            ],
            [
                'comment' => '0',
                'value' => 0,
                'errors' => [
                    'isInt' => 0,
                    'isNumeric' => 0,
                    'isEmpty' => 0,
                    'isMacAddress' => 2,
                    'notMacAddress' => 2,
                    'notInt' => 1,
                    'notEmpty' => 1
                ]
            ],
            [
                'comment' => '""',
                'value' => '',
                'errors' => [
                    'isEmpty' => 0,
                    'isString' => 0,
                    'isMacAddress' => 1,
                    'notMacAddress' => 1,
                    'notEmpty' => 1,
                    'notString' => 1
                ]
            ],
            [
                'comment' => '"01:02:03:a1:a2:a3"',
                'value' => '01:02:03:a1:a2:a3',
                'errors' => [
                    'isString' => 0,
                    'isMacAddress' => 0,
                    'isGraph' => 0,
                    'notMacAddress' => 1,
                    'notString' => 1,
                    'notGraph' => 1
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
                $fixture['errors'] = (strpos($methodName, 'not') === 0)? 0 : 1;
            } else {
                $fixture['errors'] = $fixture['errors'][$methodName];
            }

            $result[] = $fixture;
        }

        return $result;
    }
}