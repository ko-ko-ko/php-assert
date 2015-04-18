php-validator
=====

[![Build Status](https://travis-ci.org/index0h/php-validator.svg)](https://travis-ci.org/index0h/php-validator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/index0h/php-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/index0h/php-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master)

## Yet another validator, WHY??

**Inside it's really ugly, but it's very fast**

There are many other cool validators, but for their user-friendly you must pay by time & memory of execution.
This validator gives you very simple and fast API. You can see benchmark results at bottom of [build logs](https://travis-ci.org/index0h/php-validator).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```sh
php composer.phar require --prefer-dist index0h/validator "0.2.x"
```

or add line to require section of `composer.json`

```json
"index0h/validator": "0.2.x"
```

## Usage

```php
use index0h\validator\Variable as v;

v::assert($var, 'var')->isNotEmpty()->isString();

// It's the same as

if (empty($var)) {
    throw new \InvalidArgumentException('Param $var must be not empty');
}

if (!is_string($var)) {
    throw new \InvalidArgumentException('Param $var must be string');
}
```

-- --

BASIC API
=========

#### assert($value, $name, $exceptionClass = '\InvalidArgumentException')

Build validation object

* `$value` checking value. MUST be: array, bool, float, int, null, string
* `$name` name of variable, used in exception message. MUST be string
* `$exceptionClass` user specific exception class name. MUST be \Exception, or it's child

```php
// OK
v::assert('', 'var')->isEmpty();
v::assert(5, 'var', '\LogicException');

// EXCEPTION: var MUST NOT be an object
v::assert(new stdClass(), 'var');

// EXCEPTION: exceptionClass MUST be \Exception, or it's child
v::assert(5, 'var', '\ArrayIterator');
```

#### getExceptionClass

Return name of exception class that will be thrown on validation fail

#### setExceptionClass($exceptionClass)

* `$exceptionClass` user specific exception class name. MUST be \Exception, or it's child


-- --

VALIDATION API
==============

General validators
------------------

#### isEmpty `Check if value empty`

Antipode: **isNotEmpty**

```php
// OK
v::assert('', 'var')->isEmpty();
v::assert('5', 'var')->isNotEmpty();

// EXCEPTION
v::assert('5', 'var')->isEmpty();
v::assert('5', 'var')->isNotEmpty();
```

#### isArray `Check if value is array`

Antipode: **isNotArray**

```php
// OK
v::assert([], 'var')->isArray();
v::assert('5', 'var')->isNotArray();

// EXCEPTION
v::assert('5', 'var')->isArray();
v::assert([], 'var')->isNotArray();
```

#### isBool `Check if value is bool`

Antipode: **isNotBool**

```php
// OK
v::assert(false, 'var')->isBool();
v::assert('5', 'var')->isNotBool();

// EXCEPTION
v::assert('5', 'var')->isBool();
v::assert(true, 'var')->isNotBool();
```

#### isFloat `Check if value is float`

Antipode: **isNotFloat**

```php
// OK
v::assert(15.2, 'var')->isFloat();
v::assert('15.2', 'var')->isNotFloat();
v::assert([], 'var')->isNotFloat();

// EXCEPTION
v::assert('15.2', 'var')->isFloat();
v::assert([], 'var')->isFloat();
v::assert(15.2, 'var')->isNotFloat();
```

#### isInt `Check if value is int`

Antipode: **isNotInt**

```php
// OK
v::assert(15, 'var')->isInt();
v::assert(15.2, 'var')->isNotInt();
v::assert([], 'var')->isNotInt();

// EXCEPTION
v::assert(15.2, 'var')->isInt();
v::assert([], 'var')->isInt();
v::assert(5, 'var')->isNotInt();
```

#### isNumeric `Check if value is numeric`

Antipode: **isNotNumeric**

```php
// OK
v::assert(15, 'var')->isNumeric();
v::assert('a', 'var')->isNotNumeric();
v::assert([], 'var')->isNotNumeric();

// EXCEPTION
v::assert('*', 'var')->isNumeric();
v::assert([], 'var')->isNumeric();
v::assert('-5', 'var')->isNotNumeric();
```

#### isString `Check if value is string`

Antipode: **isNotString**

```php
// OK
v::assert('5', 'var')->isString();
v::assert([], 'var')->isNotNumeric();

// EXCEPTION
v::assert([]', 'var')->isString();
v::assert('-5', 'var')->isNotNumeric();
```

#### isResource `Check if value is resource`

Antipode: **isNotResource**

```php
// OK
v::assert(tmpfile(), 'var')->isResource();
v::assert(5, 'var')->isNotResource();

// EXCEPTION
v::assert(5, 'var')->isResource();
v::assert(tmpfile(), 'var')->isNotResource();
```

-- --

Array validators
----------------

All array validators run previously:

* **isArray**

#### inArray($range) `Check if value is in array $range`

Antipode: **notInArray**

* `$range` MUST be array

```php
// OK
v::assert(['a'], 'var')->inArray(['a', 'b']);
v::assert(5, 'var')->notInArray();

// EXCEPTION
v::assert(['c'], 'var')->inArray(['a', 'b']);
v::assert(['a'], 'var')->notInArray(['a', 'b']);

// EXCEPTION: var MUST be array
v::assert('a', 'var')->inArray(['a', 'b']);
v::assert('a', 'var')->notInArray(['a', 'b']);

// EXCEPTION: $range MUST be array
v::assert(['a'], 'var')->inArray('a');
v::assert(['a'], 'var')->notInArray('a');
```

-- --

String validators
-----------------

All string validators run previously:

* **isString**


#### isDigit `Check if value contains only digits`

Antipode: **isNotDigit**

```php
// OK
v::assert('5', 'var')->isDigit();
v::assert('a', 'var')->isNotDigit();

// EXCEPTION
v::assert('c', 'var')->isDigit();
v::assert('5', 'var')->isNotDigit();

// EXCEPTION: var MUST be string
v::assert(5, 'var')->isDigit();
v::assert([], 'var')->isNotDigit();
```

#### isJson `Check if value is json string`

Antipode: **isNotJson**

```php
// OK
v::assert('{"a":"b"}', 'var')->isJson();
v::assert('--', 'var')->isNotJson();

// EXCEPTION
v::assert('--', 'var')->isJson();
v::assert('{"a":"b"}', 'var')->isNotJson();

// EXCEPTION: var MUST be string
v::assert(5, 'var')->isJson();
v::assert([], 'var')->isNotJson();
```

#### isMatchRegExp($pattern) `Check if value match RegExp pattern`

Antipode: **isNotMatchRegExp**

* `$pattern` MUST be correct RegExp pattern

```php
// OK
v::assert('a', 'var')->isMatchRegExp('/a/');
v::assert('b', 'var')->isNotMatchRegExp('/a/');

// EXCEPTION
v::assert('b', 'var')->isMatchRegExp('/a/');
v::assert('a', 'var')->isNotMatchRegExp('/a/');

// EXCEPTION: pattern MUST be not empty
v::assert('a', 'var')->isMatchRegExp('');
v::assert('a', 'var')->isNotMatchRegExp('');

// EXCEPTION: var MUST be string
v::assert(5, 'var')->isMatchRegExp('/a/');
v::assert([], 'var')->isNotMatchRegExp('/a/');

// EXCEPTION: pattern MUST be correct RegExp
v::assert('a', 'var')->isMatchRegExp('/a');
v::assert('a', 'var')->isNotMatchRegExp('/a');
```

#### isMatchGlob($pattern) `Check if value match glob pattern`

Antipode: **isNotMatchGlob**

```php
// OK
v::assert('aa', 'var')->isMatchGlob('a*');
v::assert('bb', 'var')->isNotMatchGlob('a*');

// EXCEPTION
v::assert('bb', 'var')->isMatchGlob('a*');
v::assert('aa', 'var')->isNotMatchGlob('a*');

// EXCEPTION: pattern MUST be not empty
v::assert('a', 'var')->isMatchGlob('');
v::assert('a', 'var')->isNotMatchGlob('');

// EXCEPTION: pattern MUST be string
v::assert('a', 'var')->isMatchRegExp(false);
v::assert('a', 'var')->isNotMatchRegExp(false);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->isMatchGlob('/a/');
v::assert([], 'var')->isNotMatchGlob('/a/');
```

#### hasLength($length) `Check if value has length exactly $length`

Antipode: **hasLengthNot**

* `$length` MUST be integer >= 0

```php
// OK
v::assert('aa', 'var')->hasLength(2);
v::assert('bb', 'var')->hasLengthNot(5);

// EXCEPTION
v::assert('bb', 'var')->hasLength(5);
v::assert('aa', 'var')->hasLengthNot(2);

// EXCEPTION: length MUST be int
v::assert('a', 'var')->hasLength(null);
v::assert('a', 'var')->hasLengthNot(null);

// EXCEPTION: length MUST be more >= 0
v::assert('a', 'var')->hasLength(-2);
v::assert('a', 'var')->hasLengthNot(-2);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->hasLength(1);
v::assert([], 'var')->hasLengthNot(1);
```

#### hasLengthLess($maxLength) `Check if value has length less than $maxLength`

Antipode: **hasLengthMore**

* `$length` MUST be integer > 0

```php
// OK
v::assert('aa', 'var')->hasLengthLess(5);
v::assert('bb', 'var')->hasLengthMore(1);

// EXCEPTION
v::assert('bb', 'var')->hasLengthLess(1);
v::assert('aa', 'var')->hasLengthMore(5);

// ----------

// EXCEPTION: length MUST be int
v::assert('a', 'var')->hasLengthLess(null);
v::assert('a', 'var')->hasLengthMore(null);

// EXCEPTION: length MUST be more >= 0
v::assert('a', 'var')->hasLengthLess(-2);
v::assert('a', 'var')->hasLengthMore(-2);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->hasLengthLess(1);
v::assert([], 'var')->hasLengthMore(1);
```

#### hasLengthBetween($from, $to) `Check that value length is $from <= $value <= $to`

Antipode: **hasLengthNotBetween** `$from > $value > $to`

* `$from` MUST be integer >= 0
* `$to` MUST be integer >= 0
* `$from` MUST less than `$to`

```php
// OK
v::assert('aa', 'var')->hasLengthBetween(1, 5);
v::assert('bb', 'var')->hasLengthNotBetween(3, 10);

// EXCEPTION
v::assert('bb', 'var')->hasLengthBetween(3, 10);
v::assert('aa', 'var')->hasLengthNotBetween(1, 5);

// ----------

// EXCEPTION: form MUST be int
v::assert('a', 'var')->hasLengthBetween(null, 5);
v::assert('a', 'var')->hasLengthNotBetween(null, 5);

// EXCEPTION: to MUST be int
v::assert('a', 'var')->hasLengthBetween(1, []);
v::assert('a', 'var')->hasLengthNotBetween(1, []);

// EXCEPTION: form MUST be more >= 0
v::assert('a', 'var')->hasLengthBetween(-2, 5);
v::assert('a', 'var')->hasLengthNotBetween(-2, 5);

// EXCEPTION: form MUST be more than to
v::assert('a', 'var')->hasLengthBetween(5, 1);
v::assert('a', 'var')->hasLengthNotBetween(5, 1);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->hasLengthBetween(1);
v::assert([], 'var')->hasLengthNotBetween(1);
```

-- --

Number validators (int or float)
--------------------------------

All number validators run previously:

* **isNumeric**
* **notString**

#### isPositive `Check if value is positive (not 0)`

Antipode: **isNegative** `Check if value is negative (not 0)`

```php
// OK
v::assert(1, 'var')->isPositive();
v::assert(-5, 'var')->isNegative();

// EXCEPTION
v::assert(-1, 'var')->isPositive();
v::assert(10, 'var')->isPositive();
v::assert(0, 'var')->isNegative();
v::assert(0, 'var')->isNegative();

// EXCEPTION: var MUST be int or float
v::assert('A', 'var')->isPositive();
v::assert([], 'var')->isNegative();
```

#### isLess($number) `Check if value is $value <= $number`

Similar: **isLessStrict** Check that value is `$value < $number`
Antipode: **isMore** Check that value is `$value >= $number`
Antipode: **isMoreStrict** Check that value is `$value > $number`

* `$number` MUST be integer or float

```php
// OK
v::assert(1, 'var')->isLess(2);
v::assert(10, 'var')->isMore(5);

// EXCEPTION
v::assert(10, 'var')->isLess(5);
v::assert(1, 'var')->isMore(2);

// EXCEPTION: length MUST be int or float
v::assert(1, 'var')->isLess(null);
v::assert(1, 'var')->isMore(null);

// EXCEPTION: var MUST be int or float
v::assert('A', 'var')->isLess(1);
v::assert([], 'var')->isMore(1);
```

#### isBetween($from, $to) `Check that value is $from <= $value <= $to`

Similar: **isBetweenStrict** Check that value is `$from < $value < $to`
Antipode: **isNotBetween** Check that value is `$from > $value > $to`
Antipode: **isNotBetweenStrict** Check that value is `$from >= $value >= $to`

* `$from` MUST be int or float
* `$to` MUST be int or float
* `$from` MUST less than `$to`

```php
// OK
v::assert(2, 'var')->isBetween(1, 5);
v::assert(2, 'var')->isNotBetween(3, 10);

// EXCEPTION
v::assert(2.5, 'var')->isBetween(3, 10);
v::assert(2.5, 'var')->isNotBetween(1, 5);

// ----------

// EXCEPTION: form MUST be int
v::assert(2, 'var')->isBetween(null, 5);
v::assert(2, 'var')->isNotBetween(null, 5);

// EXCEPTION: to MUST be int
v::assert(2, 'var')->isBetween(1, []);
v::assert(2, 'var')->isNotBetween(1, []);

// EXCEPTION: form MUST be more than to
v::assert(2, 'var')->isBetween(5, 1);
v::assert(2, 'var')->isNotBetween(5, 1);

// EXCEPTION: var MUST be int or float
v::assert('A', 'var')->isBetween(1);
v::assert([], 'var')->isNotBetween(1);
```

-- --

CAST API
========

#### get

Returns value as is

#### toBool

Converts any type to bool

#### toFloat

Run previously:

* **isNotArray**

Converts any type (except array) to float

#### toInt

Run previously:

* **isNotArray**

Converts any type (except array) to int

#### toString

Run previously:

* **isNotArray**

Converts any type (except array) to string

Examples
--------

```php
// Return: '5'
Variable::assert(5, 'var')->toString()->get();

// Return: -15
Variable::assert('-15.12', 'var')->toInt()->get();

// Throws exception: Param $var must be positive
Variable::assert('-15.12', 'var')->toInt()->isPositive();
```

## Testing

#### Run tests from console

```sh
make test
```

#### Run benchmark from console

```sh
make benchmark
```

[yii1-request]: https://github.com/yiisoft/yii/blob/master/framework/web/CHttpRequest.php
[symfony-request]: https://github.com/symfony/HttpFoundation/blob/master/Request.php
