<?php
/**
 * @link      https://github.com/ko-ko-ko/php-assert
 * @copyright Copyright (c) 2015 Roman Levishchenko <index.0h@gmail.com>
 * @license   https://raw.github.com/ko-ko-ko/php-assert/master/LICENSE
 */

return [
// null
    [
        'comment' => 'null',
        'value' => null,
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 0,
            'notEmpty' => 1,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 0,
            'notNull' => 1,
            //
            'positive' => 1,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 1,
        ]
    ],
// []
    [
        'comment' => '[]',
        'value' => [],
        'errors' => [
            //
            'isArray' => 0,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 0,
            'notEmpty' => 1,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 1,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 1,
        ]
    ],
// true
    [
        'comment' => 'true',
        'value' => true,
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 0,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 1,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 1,
        ]
    ],
// 10
    [
        'comment' => '10',
        'value' => 10,
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 0,
            //
            'numeric' => 0,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 0,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 1,
        ]
    ],
// '10'
    [
        'comment' => '"10"',
        'value' => '10',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 0,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 0,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 1,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// '10.25'
    [
        'comment' => '"10.25"',
        'value' => '10.25',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 0,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 1,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// tmpfile()
    [
        'comment' => 'tmpfile()',
        'value' => tmpfile(),
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 1,
            'negative' => 1,
            //
            'resource' => 0,
            //
            'string' => 1,
        ]
    ],
// 'some_string'
    [
        'comment' => '"some_string"',
        'value' => 'some_string',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 2,
            'negative' => 2,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// 'email@example.com'
    [
        'comment' => '"email@example.com"',
        'value' => 'email@example.com',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 2,
            'negative' => 2,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// "a\t\r\n"
    [
        'comment' => '"a\t\r\n"',
        'value' => "a\t\r\n",
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 2,
            'negative' => 2,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// '{"a" : "b"}'
    [
        'comment' => '"{"a" : "b"}"',
        'value' => '{"a" : "b"}',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 2,
            'negative' => 2,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// '{"a":"b"}'
    [
        'comment' => '"{"a":"b"}"',
        'value' => '{"a":"b"}',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 2,
            'negative' => 2,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// 0
    [
        'comment' => '0',
        'value' => 0,
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 0,
            'notEmpty' => 1,
            //
            'int' => 0,
            //
            'numeric' => 0,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 1,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 1,
        ]
    ],
// ''
    [
        'comment' => '""',
        'value' => '',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 0,
            'notEmpty' => 1,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 2,
            'negative' => 2,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// '01:02:03:a1:a2:a3'
    [
        'comment' => '"01:02:03:a1:a2:a3"',
        'value' => '01:02:03:a1:a2:a3',
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 1,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 2,
            'negative' => 2,
            //
            'resource' => 1,
            //
            'string' => 0,
        ]
    ],
// 15.25
    [
        'comment' => '15.25',
        'value' => 15.25,
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 0,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 1,
            //
            'numeric' => 0,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 0,
            'negative' => 1,
            //
            'resource' => 1,
            //
            'string' => 1,
        ]
    ],
// -8
    [
        'comment' => '-8',
        'value' => -8,
        'errors' => [
            //
            'isArray' => 1,
            //
            'bool' => 1,
            //
            'digit' => 1,
            //
            'float' => 1,
            //
            'isEmpty' => 1,
            'notEmpty' => 0,
            //
            'int' => 0,
            //
            'numeric' => 0,
            //
            'isNull' => 1,
            'notNull' => 0,
            //
            'positive' => 1,
            'negative' => 0,
            //
            'resource' => 1,
            //
            'string' => 1,
        ]
    ],
// [1, 2] -> 1
    [
        'comment' => '[1, 2] -> 1',
        'arguments' => [[1, 2]],
        'value' => 1,
        'errors' => [
            'length' => 1,
            'lengthMore' => 1,
            'lengthLess' => 1,
            'inArray' => 0,
        ]
    ],
// [1, 2] -> 5
    [
        'comment' => '[1, 2] -> 5',
        'arguments' => [[1, 2]],
        'value' => 5,
        'errors' => [
            'length' => 1,
            'lengthMore' => 1,
            'lengthLess' => 1,
            'inArray' => 1,
        ]
    ],
// 'abc' -> length(4)
    [
        'comment' => '"abc" -> length(4)',
        'arguments' => [4],
        'value' => 'abc',
        'errors' => [
            'length' => 1,
            'lengthMore' => 1,
            'lengthLess' => 0
        ]
    ],
// 'abcdef' -> length(6)
    [
        'comment' => '"abcdef" -> length(6)',
        'arguments' => [6],
        'value' => 'abcdef',
        'errors' => [
            'length' => 0,
            'lengthMore' => 0,
            'lengthLess' => 0
        ]
    ],
// 'abcdefg' -> length(3)
    [
        'comment' => '"abcdefg" -> length(3)',
        'arguments' => [3],
        'value' => 'abcdefg',
        'errors' => [
            'length' => 1,
            'lengthMore' => 0,
            'lengthLess' => 1
        ]
    ],
// [] -> length(3)
    [
        'comment' => '[] -> length(3)',
        'arguments' => [3],
        'value' => [],
        'errors' => [
            'length' => 2,
            'lengthMore' => 2,
            'lengthLess' => 1
        ]
    ],
// 'abc' -> length(2, 5)
    [
        'comment' => '"abc" -> length(2, 5)',
        'arguments' => [2, 5],
        'value' => 'abc',
        'errors' => [
            'lengthBetween' => 0,
        ]
    ],
// 'abcdef' -> length(3, 4)
    [
        'comment' => '"abcdef" -> length(3, 4)',
        'arguments' => [3, 4],
        'value' => 'abcdef',
        'errors' => [
            'lengthBetween' => 1,
        ]
    ],
// 'abcdef' -> length(6, 8)
    [
        'comment' => '"abcdef" -> length(6, 8)',
        'arguments' => [6, 8],
        'value' => 'abcdef',
        'errors' => [
            'lengthBetween' => 0,
        ]
    ],
// 'abcdef' -> length(1, 6)
    [
        'comment' => '"abcdef" -> length(1, 6)',
        'arguments' => [1, 6],
        'value' => 'abcdef',
        'errors' => [
            'lengthBetween' => 0,
        ]
    ],
// 'abcdef' -> length(1, 2)
    [
        'comment' => '"abcdef" -> length(1, 2)',
        'arguments' => [1, 2],
        'value' => 'abcdef',
        'errors' => [
            'lengthBetween' => 1,
        ]
    ],
// [] -> length(6, 8)
    [
        'comment' => '[] -> length(6, 8)',
        'arguments' => [1, 2],
        'value' => [],
        'errors' => [
            'lengthBetween' => 1,
        ]
    ],
// 5 ? (3)
    [
        'comment' => '5 ? (3)',
        'arguments' => [3],
        'value' => 5,
        'errors' => [
            'more' => 0,
            'moreStrict' => 0,
            'less' => 1,
            'lessStrict' => 1
        ]
    ],
// 2.5 ? (2.5)
    [
        'comment' => '2.5 ? (2.5)',
        'arguments' => [2.5],
        'value' => 2.5,
        'errors' => [
            'more' => 0,
            'moreStrict' => 1,
            'less' => 0,
            'lessStrict' => 1
        ]
    ],
// 1 ? (3)
    [
        'comment' => '1 ? (3)',
        'arguments' => [3],
        'value' => 1,
        'errors' => [
            'more' => 1,
            'moreStrict' => 1,
            'less' => 0,
            'lessStrict' => 0
        ]
    ],
// 'a' ? (3)
    [
        'comment' => '"a" ? (3)',
        'arguments' => [3],
        'value' => 'a',
        'errors' => [
            'more' => 2,
            'moreStrict' => 2,
            'less' => 2,
            'lessStrict' => 2
        ]
    ],
// -3 ? (-5, 0)
    [
        'comment' => '-3 ? (-5, 0)',
        'arguments' => [-5, 0],
        'value' => -3,
        'errors' => [
            'between' => 0,
            'betweenStrict' => 0,
        ]
    ],
// 2 ? (0, 2)
    [
        'comment' => '2 ? (0, 2)',
        'arguments' => [0, 2],
        'value' => 2,
        'errors' => [
            'between' => 0,
            'betweenStrict' => 1,
        ]
    ],
// 1 ? (1, 7)
    [
        'comment' => '1 ? (1, 7)',
        'arguments' => [1, 7],
        'value' => 1,
        'errors' => [
            'between' => 0,
            'betweenStrict' => 1,
        ]
    ],
// 5 ? (10, 18)
    [
        'comment' => '5 ? (10, 18)',
        'arguments' => [10, 18],
        'value' => 5,
        'errors' => [
            'between' => 1,
            'betweenStrict' => 1,
        ]
    ],
// 'a' ? (10, 18)
    [
        'comment' => '"a" ? (10, 18)',
        'arguments' => [10, 18],
        'value' => 'a',
        'errors' => [
            'between' => 2,
            'betweenStrict' => 2,
        ]
    ],
// 'some string' -> regexp '/some/'
    [
        'comment' => '"some string" -> regexp "/some/"',
        'arguments' => ['/some/'],
        'value' => 'some string',
        'errors' => [
            'match' => 0,
            'glob' => 1,
        ]
    ],
// 'some string' -> regexp '/^\d$/'
    [
        'comment' => '"some string" -> regexp "/^\d$/"',
        'arguments' => ['/^\d$/'],
        'value' => 'some string',
        'errors' => [
            'match' => 1,
            'glob' => 1,
        ]
    ],
// 'some string' -> glob 'some*'
    [
        'comment' => '"some string" -> glob "some*"',
        'arguments' => ['some*'],
        'value' => 'some string',
        'errors' => [
            'match' => 1,
            'glob' => 0,
        ]
    ],
// 'not string' -> glob 'some*'
    [
        'comment' => '"not string" -> glob "some*"',
        'arguments' => ['some*'],
        'value' => 'not string',
        'errors' => [
            'match' => 1,
            'glob' => 1,
        ]
    ],
];