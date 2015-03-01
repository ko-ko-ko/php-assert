<?php
use Codeception\Util\Stub;

/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */
class VariableCest
{

    private $fixtures;

    public function testIsArray(\UnitTester $I)
    {
        $this->check($I, 'isArray', 'isArray');
    }

    public function testIsBool(\UnitTester $I)
    {
        $this->check($I, 'notBool', 'isBool');
    }

    public function testIsDigit(\UnitTester $I)
    {
        $this->check($I, 'isDigit', 'isDigit');
    }

    public function testIsEmail(\UnitTester $I)
    {
        $this->check($I, 'isEmail', 'isEmail');
    }

    public function testIsEmpty(\UnitTester $I)
    {
        $this->check($I, 'isEmpty', 'isEmpty');
    }

    public function testIsGraph(\UnitTester $I)
    {
        $this->check($I, 'isGraph', 'isGraph');
    }

    public function testIsInt(\UnitTester $I)
    {
        $this->check($I, 'isInt', 'isInt');
    }

    public function testIsMacAddress(\UnitTester $I)
    {
        $this->check($I, 'isMacAddress', 'isMacAddress');
    }

    public function testIsObject(\UnitTester $I)
    {
        $this->check($I, 'isObject', 'isObject');
    }

    public function testIsResource(\UnitTester $I)
    {
        $this->check($I, 'isResource', 'isResource');
    }

    public function testIsString(\UnitTester $I)
    {
        $this->check($I, 'isString', 'isString');
    }

    public function testNotArray(\UnitTester $I)
    {
        $this->check($I, 'notArray', 'isArray');
    }

    public function testNotBool(\UnitTester $I)
    {
        $this->check($I, 'notBool', 'isBool');
    }

    public function testNotDigit(\UnitTester $I)
    {
        $this->check($I, 'notDigit', 'isDigit');
    }

    public function testNotEmail(\UnitTester $I)
    {
        $this->check($I, 'notEmail', 'isEmail');
    }

    public function testNotEmpty(\UnitTester $I)
    {
        $this->check($I, 'notEmpty', 'isEmpty');
    }

    public function testNotGraph(\UnitTester $I)
    {
        $this->check($I, 'notGraph', 'isGraph');
    }

    public function testNotInt(\UnitTester $I)
    {
        $this->check($I, 'notInt', 'isInt');
    }

    public function testNotMacAddress(\UnitTester $I)
    {
        $this->check($I, 'notMacAddress', 'isMacAddress');
    }

    public function testNotObject(\UnitTester $I)
    {
        $this->check($I, 'notObject', 'isObject');
    }

    public function testNotResource(\UnitTester $I)
    {
        $this->check($I, 'notResource', 'isResource');
    }

    public function testNotString(\UnitTester $I)
    {
        $this->check($I, 'notString', 'isString');
    }

    private function check(\UnitTester $I, $methodName, $okTagName)
    {
        $okIsPresented = true;
        if ($methodName !== $okTagName) {
            $okIsPresented = false;
        }

        $okFixtures = $this->getFixturesByTagName($okTagName, $okIsPresented);
        $errorFixtures = $this->getFixturesByTagName($okTagName, !$okIsPresented);

        $this->checkOk($I, $methodName, $okFixtures);
        $this->checkError($I, $methodName, $errorFixtures);
    }

    private function checkError(\UnitTester $I, $methodName, $fixtures)
    {
        foreach ($fixtures as $fixture) {
            $I->amGoingTo('check error with: ' . $fixture['comment']);
            $stub = $this->makeValidationStubNegative($fixture['value']);
            $stub->$methodName();
            $stub->__phpunit_getInvocationMocker()->verify();
        }
    }

    private function checkOk(\UnitTester $I, $methodName, $fixtures)
    {
        foreach ($fixtures as $fixture) {
            $I->amGoingTo('check ok with: ' . $fixture['comment']);
            $this->makeValidationStubPositive($fixture['value'])->$methodName();
        }
    }

    private function getFixtures()
    {
        if (!is_null($this->fixtures)) {
            return $this->fixtures;
        }

        $this->fixtures = [
            ['comment' => '[]', 'value' => [], 'ok' => ['isArray', 'isEmpty'], 'skip' => ['isMacAddress']],
            [
                'comment' => 'ArrayIterator',
                'value' => new \ArrayIterator,
                'ok' => ['isArray', 'isObject'],
                'skip' => ['notEmpty', 'isEmpty', 'notMacAddress', 'isMacAddress']
            ],
            [
                'comment' => 'SplMinHeap',
                'value' => new \SplMinHeap,
                'ok' => ['isObject'],
                'skip' => ['notEmpty', 'isEmpty']
            ],
            ['comment' => 'true', 'value' => true, 'ok' => ['isBool']],
            ['comment' => '10', 'value' => 10, 'ok' => ['isInt', 'isNumeric']],
            ['comment' => '"10"', 'value' => '10', 'ok' => ['isNumeric', 'isString', 'isDigit', 'isGraph']],
            ['comment' => '"10.25"', 'value' => '10.25', 'ok' => ['isNumeric', 'isString', 'isGraph']],
            ['comment' => 'tmpfile()', 'value' => tmpfile(), 'ok' => ['isResource']],
            ['comment' => '"some_string"', 'value' => 'some_string', 'ok' => ['isString', 'isGraph']],
            [
                'comment' => '"email@example.com"',
                'value' => 'email@example.com',
                'ok' => ['isEmail', 'isString', 'isGraph']
            ],
            ['comment' => '"a\t\r\n"', 'value' => "a\t\r\n", 'ok' => ['isString']],
            ['comment' => '"{"a": "b"}"', 'value' => '{"a": "b"}', 'ok' => ['isString', 'isJson']],
            ['comment' => '"{"a":"b"}"', 'value' => '{"a":"b"}', 'ok' => ['isString', 'isJson', 'isGraph']],
            ['comment' => '0', 'value' => 0, 'ok' => ['isInt', 'isNumeric', 'isEmpty']],
            [
                'comment' => '"aa-AA-bb-CC-dd-00"',
                'value' => 'aa-AA-bb-CC-dd-00',
                'ok' => ['isString', 'isMacAddress', 'isGraph']
            ],
        ];

        return $this->fixtures;
    }

    private function getFixturesByTagName($tagName, $isPresented)
    {
        $result = [];
        foreach ($this->getFixtures() as $fixture) {
            if (isset($fixture['skip']) && in_array($tagName, $fixture['skip'])) {
                continue;
            }

            $isFixturePositive = in_array($tagName, $fixture['ok']);

            if (($isFixturePositive && $isPresented) || (!$isFixturePositive && !$isPresented)) {
                $result[] = $fixture;
            }
        }

        return $result;
    }

    private function makeValidationStubNegative($value)
    {
        return Stub::make(
            'index0h\validator\Variable',
            ['processError' => Stub::once(), 'throwError' => false, 'skipOnErrors' => true, 'value' => $value],
            $this
        );
    }

    private function makeValidationStubPositive($value)
    {
        return Stub::make(
            'index0h\validator\Variable',
            ['processError' => Stub::never(), 'throwError' => false, 'skipOnErrors' => true, 'value' => $value]
        );
    }
}