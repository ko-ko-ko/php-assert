<?php
/**
 * @link      https://github.com/index0h/php-validator
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/index0h/php-validator/master/LICENSE
 */

return [
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 1,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 1,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 1,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 1,
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
            //
            'toFloat' => 0,
            'toInt' => 0,
            'toBool' => 0,
            'toString' => 0,
        ]
    ],
// new ToString
    [
        'comment' => 'new ToString',
        'value' => new \index0h\validator\tests\_data\ToString,
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
            //
            'toFloat' => 1,
            'toInt' => 1,
            'toBool' => 0,
            'toString' => 0,
        ]
    ],
// [1, 2] -> 1
    [
        'comment' => '[1, 2] -> 1',
        'arguments' => [[1, 2]],
        'value' => 1,
        'errors' => [
            'inArray' => 0,
            'notInArray' => 1
        ]
    ],
// [1, 2] -> 5
    [
        'comment' => '[1, 2] -> 5',
        'arguments' => [[1, 2]],
        'value' => 5,
        'errors' => [
            'inArray' => 1,
            'notInArray' => 0
        ]
    ],
// 'abc' -> length(4)
    [
        'comment' => '"abc" -> length(4)',
        'arguments' => [4],
        'value' => 'abc',
        'errors' => [
            'isLengthMore' => 1,
            'isLengthLess' => 0
        ]
    ],
// 'abcd' -> length(4, false)
    [
        'comment' => '"abcd" -> length(4, false)',
        'arguments' => [4, false],
        'value' => 'abcd',
        'errors' => [
            'isLengthMore' => 1,
            'isLengthLess' => 1
        ]
    ],
// 'abcdef' -> length(3)
    [
        'comment' => '"abcdef" -> length(3)',
        'arguments' => [3],
        'value' => 'abcdef',
        'errors' => [
            'isLengthMore' => 0,
            'isLengthLess' => 1
        ]
    ],
// 'abcdef' -> length(3)
    [
        'comment' => '"abcdef" -> length(3, false)',
        'arguments' => [3, false],
        'value' => 'abcdef',
        'errors' => [
            'isLengthMore' => 0,
            'isLengthLess' => 1
        ]
    ],
// 'abcdef' -> length(7, false)
    [
        'comment' => '"abcdef" -> length(7, false)',
        'arguments' => [7, false],
        'value' => 'abcdef',
        'errors' => [
            'isLengthMore' => 1,
            'isLengthLess' => 0
        ]
    ],
// 'abc' -> length(2, 5)
    [
        'comment' => '"abc" -> length(2, 5)',
        'arguments' => [2, 5],
        'value' => 'abc',
        'errors' => [
            'isLengthBetween' => 0,
            'notLengthBetween' => 1
        ]
    ],
// 'abc' -> length(2, 5, false)
    [
        'comment' => '"abc" -> length(2, 5, false)',
        'arguments' => [2, 5, false],
        'value' => 'abc',
        'errors' => [
            'isLengthBetween' => 0,
            'notLengthBetween' => 1
        ]
    ],
// 'abc' -> length(3, 5, false)
    [
        'comment' => '"abc" -> length(3, 5, false)',
        'arguments' => [3, 5, false],
        'value' => 'abc',
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 1
        ]
    ],
// 'abcdef' -> length(10, 20)
    [
        'comment' => '"abcdef" -> length(10, 20)',
        'arguments' => [10, 20],
        'value' => 'abcdef',
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 0
        ]
    ],
// 'abcdef' -> length(10, 20, false)
    [
        'comment' => '"abcdef" -> length(10, 20, false)',
        'arguments' => [10, 20, false],
        'value' => 'abcdef',
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 0
        ]
    ],
// 'abcdef' -> length(6, 20, false)
    [
        'comment' => '"abcdef" -> length(6, 20, false)',
        'arguments' => [6, 20, false],
        'value' => 'abcdef',
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 1
        ]
    ],
// 5 ? (4)
    [
        'comment' => '5 ? (4)',
        'arguments' => [4],
        'value' => 5,
        'errors' => [
            'isMore' => 0,
            'isLess' => 1
        ]
    ],
// 5 ? (5, false)
    [
        'comment' => '5 ? (5, false)',
        'arguments' => [5, false],
        'value' => 5,
        'errors' => [
            'isMore' => 1,
            'isLess' => 1
        ]
    ],
// 2.5 ? (2.5)
    [
        'comment' => '2.5 ? (2.5)',
        'arguments' => [2.5],
        'value' => 2.5,
        'errors' => [
            'isMore' => 0,
            'isLess' => 0
        ]
    ],
// 3 ? (2)
    [
        'comment' => '3 ? (2)',
        'arguments' => [2],
        'value' => 3,
        'errors' => [
            'isMore' => 0,
            'isLess' => 1
        ]
    ],
// 1 ? (2)
    [
        'comment' => '1 ? (2)',
        'arguments' => [2],
        'value' => 1,
        'errors' => [
            'isMore' => 1,
            'isLess' => 0
        ]
    ],
// 3 ? (2, false)
    [
        'comment' => '3 ? (2, false)',
        'arguments' => [2, false],
        'value' => 3,
        'errors' => [
            'isMore' => 0,
            'isLess' => 1
        ]
    ],
// 1 ? (2, false)
    [
        'comment' => '1 ? (2, false)',
        'arguments' => [2, false],
        'value' => 1,
        'errors' => [
            'isMore' => 1,
            'isLess' => 0
        ]
    ],
// -3 ? (-5, false)
    [
        'comment' => '-3 ? (-5, false)',
        'arguments' => [-5, false],
        'value' => -3,
        'errors' => [
            'isMore' => 0,
            'isLess' => 1
        ]
    ],
// -3 ? (-5)
    [
        'comment' => '-3 ? (-5)',
        'arguments' => [-5],
        'value' => -3,
        'errors' => [
            'isMore' => 0,
            'isLess' => 1
        ]
    ],
// 10 ? (15, false)
    [
        'comment' => '10 ? (15, false)',
        'arguments' => [15, false],
        'value' => 10,
        'errors' => [
            'isMore' => 1,
            'isLess' => 0
        ]
    ],
// 15 ? (10)
    [
        'comment' => '15 ? (10)',
        'arguments' => [10],
        'value' => 15,
        'errors' => [
            'isMore' => 0,
            'isLess' => 1
        ]
    ],
// -3 ? (-5, 0, false)
    [
        'comment' => '-3 ? (-5, 0, false)',
        'arguments' => [-5, 0, false],
        'value' => -3,
        'errors' => [
            'isBetween' => 0,
            'notBetween' => 1
        ]
    ],
// 2 ? (0, 2)
    [
        'comment' => '2 ? (0, 2)',
        'arguments' => [0, 2],
        'value' => 2,
        'errors' => [
            'isBetween' => 0,
            'notBetween' => 0
        ]
    ],
// 1 ? (0, 2)
    [
        'comment' => '2 ? (0, 2)',
        'arguments' => [0, 2],
        'value' => 1,
        'errors' => [
            'isBetween' => 0,
            'notBetween' => 1
        ]
    ],
// 5 ? (10, 18, false)
    [
        'comment' => '5 ? (10, 18, false)',
        'arguments' => [10, 18, false],
        'value' => 5,
        'errors' => [
            'isBetween' => 1,
            'notBetween' => 0
        ]
    ],
// 5 ? (10, 18)
    [
        'comment' => '5 ? (10, 18)',
        'arguments' => [10, 18],
        'value' => 5,
        'errors' => [
            'isBetween' => 1,
            'notBetween' => 0
        ]
    ],
// 'string' ? (1, 2)
    [
        'comment' => '"string" ? (1, 2)',
        'arguments' => [1, 2],
        'value' => 'string',
        'errors' => [
            'isBetween' => 2,
            'notBetween' => 2
        ]
    ],
// '1.5' ? (1, 2)
    [
        'comment' => '"1.5" ? (1, 2)',
        'arguments' => [1, 2],
        'value' => '1.5',
        'errors' => [
            'isBetween' => 1,
            'notBetween' => 1
        ]
    ],
// 5 -> length(1, 2)
    [
        'comment' => '5 -> length(1, 2)',
        'arguments' => [1, 2],
        'value' => 5,
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 1
        ]
    ],
// [] -> length(1, 2)
    [
        'comment' => '[] -> length(1, 2)',
        'arguments' => [1, 2],
        'value' => [],
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 1
        ]
    ],
// 'string' ? (1)
    [
        'comment' => '"string" ? (1)',
        'arguments' => [1],
        'value' => 'string',
        'errors' => [
            'isMore' => 2,
            'isLess' => 2
        ]
    ],
// '1.5' ? (1)
    [
        'comment' => '"1.5" ? (1)',
        'arguments' => [1],
        'value' => '1.5',
        'errors' => [
            'isMore' => 1,
            'isLess' => 1
        ]
    ],
// 5 -> length(1)
    [
        'comment' => '5 -> length(1)',
        'arguments' => [1],
        'value' => 5,
        'errors' => [
            'isLengthMore' => 1,
            'isLengthLess' => 1
        ]
    ],
// [] -> length(1)
    [
        'comment' => '[] -> length(1)',
        'arguments' => [1],
        'value' => [],
        'errors' => [
            'isLengthMore' => 2,
            'isLengthLess' => 2
        ]
    ],
];