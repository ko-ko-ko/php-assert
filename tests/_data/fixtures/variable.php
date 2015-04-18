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
            'isNotArray' => 1,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 1,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 0,
            'isNotEmpty' => 1,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 2,
            'isNotJson' => 2,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 1,
            'isNegative' => 1,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 1,
            'isNotString' => 0,
        ]
    ],
// true
    [
        'comment' => 'true',
        'value' => true,
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 0,
            'isNotBool' => 1,
            //
            'isDigit' => 1,
            'isNotDigit' => 1,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 1,
            'isNotJson' => 1,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 1,
            'isNegative' => 1,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 1,
            'isNotString' => 0,
        ]
    ],
// 10
    [
        'comment' => '10',
        'value' => 10,
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 1,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 0,
            'isNotInt' => 1,
            //
            'isJson' => 1,
            'isNotJson' => 1,
            //
            'isNumeric' => 0,
            'isNotNumeric' => 1,
            //
            'isPositive' => 0,
            'isNegative' => 1,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 1,
            'isNotString' => 0,
        ]
    ],
// '10'
    [
        'comment' => '"10"',
        'value' => '10',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 0,
            'isNotDigit' => 1,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 0,
            'isNotJson' => 1,
            //
            'isNumeric' => 0,
            'isNotNumeric' => 1,
            //
            'isPositive' => 1,
            'isNegative' => 1,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// '10.25'
    [
        'comment' => '"10.25"',
        'value' => '10.25',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 0,
            'isNotJson' => 1,
            //
            'isNumeric' => 0,
            'isNotNumeric' => 1,
            //
            'isPositive' => 1,
            'isNegative' => 1,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// tmpfile()
    [
        'comment' => 'tmpfile()',
        'value' => tmpfile(),
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 1,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 1,
            'isNotJson' => 1,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 1,
            'isNegative' => 1,
            //
            'isResource' => 0,
            'isNotResource' => 1,
            //
            'isString' => 1,
            'isNotString' => 0,
        ]
    ],
// 'some_string'
    [
        'comment' => '"some_string"',
        'value' => 'some_string',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 1,
            'isNotJson' => 0,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 2,
            'isNegative' => 2,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// 'email@example.com'
    [
        'comment' => '"email@example.com"',
        'value' => 'email@example.com',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 1,
            'isNotJson' => 0,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 2,
            'isNegative' => 2,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// "a\t\r\n"
    [
        'comment' => '"a\t\r\n"',
        'value' => "a\t\r\n",
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 1,
            'isNotJson' => 0,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 2,
            'isNegative' => 2,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// '{"a" : "b"}'
    [
        'comment' => '"{"a" : "b"}"',
        'value' => '{"a" : "b"}',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 0,
            'isNotJson' => 1,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 2,
            'isNegative' => 2,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// '{"a":"b"}'
    [
        'comment' => '"{"a":"b"}"',
        'value' => '{"a":"b"}',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 0,
            'isNotJson' => 1,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 2,
            'isNegative' => 2,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// 0
    [
        'comment' => '0',
        'value' => 0,
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 1,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 0,
            'isNotEmpty' => 1,
            //
            'isInt' => 0,
            'isNotInt' => 1,
            //
            'isJson' => 2,
            'isNotJson' => 2,
            //
            'isNumeric' => 0,
            'isNotNumeric' => 1,
            //
            'isPositive' => 1,
            'isNegative' => 1,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 1,
            'isNotString' => 0,
        ]
    ],
// ''
    [
        'comment' => '""',
        'value' => '',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 0,
            'isNotEmpty' => 1,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 0,
            'isNotJson' => 1,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 2,
            'isNegative' => 2,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// '01:02:03:a1:a2:a3'
    [
        'comment' => '"01:02:03:a1:a2:a3"',
        'value' => '01:02:03:a1:a2:a3',
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 0,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 1,
            'isNotJson' => 0,
            //
            'isNumeric' => 1,
            'isNotNumeric' => 0,
            //
            'isPositive' => 2,
            'isNegative' => 2,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 0,
            'isNotString' => 1,
        ]
    ],
// 15.25
    [
        'comment' => '15.25',
        'value' => 15.25,
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 1,
            //
            'isFloat' => 0,
            'isNotFloat' => 1,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 1,
            'isNotInt' => 0,
            //
            'isJson' => 1,
            'isNotJson' => 1,
            //
            'isNumeric' => 0,
            'isNotNumeric' => 1,
            //
            'isPositive' => 0,
            'isNegative' => 1,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 1,
            'isNotString' => 0,
        ]
    ],
// -8
    [
        'comment' => '-8',
        'value' => -8,
        'errors' => [
            //
            'isArray' => 1,
            'isNotArray' => 0,
            //
            'isBool' => 1,
            'isNotBool' => 0,
            //
            'isDigit' => 1,
            'isNotDigit' => 1,
            //
            'isFloat' => 1,
            'isNotFloat' => 0,
            //
            'isEmpty' => 1,
            'isNotEmpty' => 0,
            //
            'isInt' => 0,
            'isNotInt' => 1,
            //
            'isJson' => 1,
            'isNotJson' => 1,
            //
            'isNumeric' => 0,
            'isNotNumeric' => 1,
            //
            'isPositive' => 1,
            'isNegative' => 0,
            //
            'isResource' => 1,
            'isNotResource' => 0,
            //
            'isString' => 1,
            'isNotString' => 0,
        ]
    ],
// [1, 2] -> 1
    [
        'comment' => '[1, 2] -> 1',
        'arguments' => [[1, 2]],
        'value' => 1,
        'errors' => [
            'hasLength' => 1,
            'hasLengthNot' => 1,
            'hasLengthMore' => 1,
            'hasLengthLess' => 1,
            'isInArray' => 0,
            'isNotInArray' => 1
        ]
    ],
// [1, 2] -> 5
    [
        'comment' => '[1, 2] -> 5',
        'arguments' => [[1, 2]],
        'value' => 5,
        'errors' => [
            'hasLength' => 1,
            'hasLengthNot' => 1,
            'hasLengthMore' => 1,
            'hasLengthLess' => 1,
            'isInArray' => 1,
            'isNotInArray' => 0
        ]
    ],
// 'abc' -> length(4)
    [
        'comment' => '"abc" -> length(4)',
        'arguments' => [4],
        'value' => 'abc',
        'errors' => [
            'hasLength' => 1,
            'hasLengthNot' => 0,
            'hasLengthMore' => 1,
            'hasLengthLess' => 0
        ]
    ],
// 'abcdef' -> length(6)
    [
        'comment' => '"abcdef" -> length(6)',
        'arguments' => [6],
        'value' => 'abcdef',
        'errors' => [
            'hasLength' => 0,
            'hasLengthNot' => 1,
            'hasLengthMore' => 0,
            'hasLengthLess' => 0
        ]
    ],
// 'abcdefg' -> length(3)
    [
        'comment' => '"abcdefg" -> length(3)',
        'arguments' => [3],
        'value' => 'abcdefg',
        'errors' => [
            'hasLength' => 1,
            'hasLengthNot' => 0,
            'hasLengthMore' => 0,
            'hasLengthLess' => 1
        ]
    ],
// [] -> length(3)
    [
        'comment' => '[] -> length(3)',
        'arguments' => [3],
        'value' => [],
        'errors' => [
            'hasLength' => 2,
            'hasLengthNot' => 1,
            'hasLengthMore' => 2,
            'hasLengthLess' => 1
        ]
    ],
// 'abc' -> length(2, 5)
    [
        'comment' => '"abc" -> length(2, 5)',
        'arguments' => [2, 5],
        'value' => 'abc',
        'errors' => [
            'hasLengthBetween' => 0,
            'hasLengthNotBetween' => 1
        ]
    ],
// 'abcdef' -> length(3, 4)
    [
        'comment' => '"abcdef" -> length(3, 4)',
        'arguments' => [3, 4],
        'value' => 'abcdef',
        'errors' => [
            'hasLengthBetween' => 1,
            'hasLengthNotBetween' => 0
        ]
    ],
// 'abcdef' -> length(6, 8)
    [
        'comment' => '"abcdef" -> length(6, 8)',
        'arguments' => [6, 8],
        'value' => 'abcdef',
        'errors' => [
            'hasLengthBetween' => 0,
            'hasLengthNotBetween' => 0
        ]
    ],
// 'abcdef' -> length(1, 6)
    [
        'comment' => '"abcdef" -> length(1, 6)',
        'arguments' => [1, 6],
        'value' => 'abcdef',
        'errors' => [
            'hasLengthBetween' => 0,
            'hasLengthNotBetween' => 0
        ]
    ],
// 'abcdef' -> length(1, 2)
    [
        'comment' => '"abcdef" -> length(1, 2)',
        'arguments' => [1, 2],
        'value' => 'abcdef',
        'errors' => [
            'hasLengthBetween' => 1,
            'hasLengthNotBetween' => 0
        ]
    ],
// [] -> length(6, 8)
    [
        'comment' => '[] -> length(6, 8)',
        'arguments' => [1, 2],
        'value' => [],
        'errors' => [
            'hasLengthBetween' => 1,
            'hasLengthNotBetween' => 1
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
            'isNotBetween' => 1,
            'isNotBetweenStrict' => 1
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
            'isNotBetween' => 0,
            'isNotBetweenStrict' => 1
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
            'isNotBetween' => 0,
            'isNotBetweenStrict' => 1
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
            'isNotBetween' => 0,
            'isNotBetweenStrict' => 0
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
            'isNotBetween' => 2,
            'isNotBetweenStrict' => 2
        ]
    ],
// 'some string' -> regexp '/some/'
    [
        'comment' => '"some string" -> regexp "/some/"',
        'arguments' => ['/some/'],
        'value' => 'some string',
        'errors' => [
            'isMatchRegExp' => 0,
            'isNotMatchRegExp' => 1,
            'isMatchGlob' => 1,
            'isNotMatchGlob' => 0
        ]
    ],
// 'some string' -> regexp '/^\d$/'
    [
        'comment' => '"some string" -> regexp "/^\d$/"',
        'arguments' => ['/^\d$/'],
        'value' => 'some string',
        'errors' => [
            'isMatchRegExp' => 1,
            'isNotMatchRegExp' => 0,
            'isMatchGlob' => 1,
            'isNotMatchGlob' => 0
        ]
    ],
// 'some string' -> glob 'some*'
    [
        'comment' => '"some string" -> glob "some*"',
        'arguments' => ['some*'],
        'value' => 'some string',
        'errors' => [
            'isMatchRegExp' => 1,
            'isNotMatchRegExp' => 1,
            'isMatchGlob' => 0,
            'isNotMatchGlob' => 1
        ]
    ],
// 'not string' -> glob 'some*'
    [
        'comment' => '"not string" -> glob "some*"',
        'arguments' => ['some*'],
        'value' => 'not string',
        'errors' => [
            'isMatchRegExp' => 1,
            'isNotMatchRegExp' => 1,
            'isMatchGlob' => 1,
            'isNotMatchGlob' => 0
        ]
    ],
];