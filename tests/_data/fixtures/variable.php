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
// 'abcdef' -> length(6)
    [
        'comment' => '"abcdef" -> length(6)',
        'arguments' => [6],
        'value' => 'abcdef',
        'errors' => [
            'isLengthMore' => 0,
            'isLengthLess' => 0
        ]
    ],
// 'abcdefg' -> length(3)
    [
        'comment' => '"abcdefg" -> length(3)',
        'arguments' => [3],
        'value' => 'abcdefg',
        'errors' => [
            'isLengthMore' => 0,
            'isLengthLess' => 1
        ]
    ],
// [] -> length(3)
    [
        'comment' => '[] -> length(3)',
        'arguments' => [3],
        'value' => [],
        'errors' => [
            'isLengthMore' => 2,
            'isLengthLess' => 2
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
// 'abcdef' -> length(3, 4)
    [
        'comment' => '"abcdef" -> length(3, 4)',
        'arguments' => [3, 4],
        'value' => 'abcdef',
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 0
        ]
    ],
// 'abcdef' -> length(6, 8)
    [
        'comment' => '"abcdef" -> length(6, 8)',
        'arguments' => [6, 8],
        'value' => 'abcdef',
        'errors' => [
            'isLengthBetween' => 0,
            'notLengthBetween' => 0
        ]
    ],
// 'abcdef' -> length(1, 6)
    [
        'comment' => '"abcdef" -> length(1, 6)',
        'arguments' => [1, 6],
        'value' => 'abcdef',
        'errors' => [
            'isLengthBetween' => 0,
            'notLengthBetween' => 0
        ]
    ],
// 'abcdef' -> length(1, 2)
    [
        'comment' => '"abcdef" -> length(1, 2)',
        'arguments' => [1, 2],
        'value' => 'abcdef',
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 0
        ]
    ],
// [] -> length(6, 8)
    [
        'comment' => '[] -> length(6, 8)',
        'arguments' => [1, 2],
        'value' => [],
        'errors' => [
            'isLengthBetween' => 1,
            'notLengthBetween' => 1
        ]
    ],
// 5 ? (3)
    [
        'comment' => '5 ? (3)',
        'arguments' => [3],
        'value' => 5,
        'errors' => [
            'isMore' => 0,
            'isMoreStrict' => 0,
            'isLess' => 1,
            'isLessStrict' => 1
        ]
    ],
// 2.5 ? (2.5)
    [
        'comment' => '2.5 ? (2.5)',
        'arguments' => [2.5],
        'value' => 2.5,
        'errors' => [
            'isMore' => 0,
            'isMoreStrict' => 1,
            'isLess' => 0,
            'isLessStrict' => 1
        ]
    ],
// 1 ? (3)
    [
        'comment' => '1 ? (3)',
        'arguments' => [3],
        'value' => 1,
        'errors' => [
            'isMore' => 1,
            'isMoreStrict' => 1,
            'isLess' => 0,
            'isLessStrict' => 0
        ]
    ],
// 'a' ? (3)
    [
        'comment' => '"a" ? (3)',
        'arguments' => [3],
        'value' => 'a',
        'errors' => [
            'isMore' => 2,
            'isMoreStrict' => 2,
            'isLess' => 2,
            'isLessStrict' => 2
        ]
    ],
// -3 ? (-5, 0)
    [
        'comment' => '-3 ? (-5, 0)',
        'arguments' => [-5, 0],
        'value' => -3,
        'errors' => [
            'isBetween' => 0,
            'isBetweenStrict' => 0,
            'notBetween' => 1,
            'notBetweenStrict' => 1
        ]
    ],
// 2 ? (0, 2)
    [
        'comment' => '2 ? (0, 2)',
        'arguments' => [0, 2],
        'value' => 2,
        'errors' => [
            'isBetween' => 0,
            'isBetweenStrict' => 1,
            'notBetween' => 0,
            'notBetweenStrict' => 1
        ]
    ],
// 1 ? (1, 7)
    [
        'comment' => '1 ? (1, 7)',
        'arguments' => [1, 7],
        'value' => 1,
        'errors' => [
            'isBetween' => 0,
            'isBetweenStrict' => 1,
            'notBetween' => 0,
            'notBetweenStrict' => 1
        ]
    ],
// 5 ? (10, 18)
    [
        'comment' => '5 ? (10, 18)',
        'arguments' => [10, 18],
        'value' => 5,
        'errors' => [
            'isBetween' => 1,
            'isBetweenStrict' => 1,
            'notBetween' => 0,
            'notBetweenStrict' => 0
        ]
    ],
// 'a' ? (10, 18)
    [
        'comment' => '"a" ? (10, 18)',
        'arguments' => [10, 18],
        'value' => 'a',
        'errors' => [
            'isBetween' => 2,
            'isBetweenStrict' => 2,
            'notBetween' => 2,
            'notBetweenStrict' => 2
        ]
    ],
// new \InvalidArgumentException ('\Exception')
    [
        'comment' => 'new \InvalidArgumentException ("\\Exception")',
        'arguments' => ['\Exception'],
        'value' => new \InvalidArgumentException,
        'errors' => [
            'isSubClassOf' => 0,
            'notSubClassOf' => 1,
        ]
    ],
// '\InvalidArgumentException' ('\Exception')
    [
        'comment' => 'new \InvalidArgumentException ("\\Exception")',
        'arguments' => ['\Exception'],
        'value' => '\InvalidArgumentException',
        'errors' => [
            'isSubClassOf' => 0,
            'notSubClassOf' => 1,
        ]
    ],
// new \Exception ('\InvalidArgumentException')
    [
        'comment' => 'new \Exception ("\\InvalidArgumentException")',
        'arguments' => ['\InvalidArgumentException'],
        'value' => new \Exception,
        'errors' => [
            'isSubClassOf' => 1,
            'notSubClassOf' => 0,
        ]
    ],
// '\Exception' ('\InvalidArgumentException')
    [
        'comment' => 'new \Exception ("\\InvalidArgumentException")',
        'arguments' => ['\InvalidArgumentException'],
        'value' => '\Exception',
        'errors' => [
            'isSubClassOf' => 1,
            'notSubClassOf' => 0,
        ]
    ],
];