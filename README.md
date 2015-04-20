php-validator
=====

[![Build Status](https://travis-ci.org/index0h/php-validator.svg)](https://travis-ci.org/index0h/php-validator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/index0h/php-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/index0h/php-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master)

## Yet another validator, WHY??

**It's really fast, ugly inside, but fast**

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

v::assert($var, 'var')->notEmpty()->string();

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

* Antipode: **notEmpty**

```php
// OK
v::assert('', 'var')->isEmpty();
v::assert('5', 'var')->notEmpty();

// EXCEPTION
v::assert('5', 'var')->isEmpty();
v::assert([], 'var')->notEmpty();
```

#### isArray `Check if value is array`

* Antipode: **notArray**

```php
// OK
v::assert([], 'var')->isArray();
v::assert('5', 'var')->notArray();

// EXCEPTION
v::assert('5', 'var')->isArray();
v::assert([], 'var')->notArray();
```

#### bool `Check if value is bool`

* Antipode: **notBool**

```php
// OK
v::assert(false, 'var')->bool();
v::assert('5', 'var')->notBool();

// EXCEPTION
v::assert('5', 'var')->bool();
v::assert(true, 'var')->notBool();
```

#### float `Check if value is float`

* Antipode: **notFloat**

```php
// OK
v::assert(15.2, 'var')->float();
v::assert('15.2', 'var')->notFloat();
v::assert([], 'var')->notFloat();

// EXCEPTION
v::assert('15.2', 'var')->float();
v::assert([], 'var')->float();
v::assert(15.2, 'var')->notFloat();
```

#### int `Check if value is int`

* Antipode: **notInt**

```php
// OK
v::assert(15, 'var')->int();
v::assert(15.2, 'var')->notInt();
v::assert([], 'var')->notInt();

// EXCEPTION
v::assert(15.2, 'var')->int();
v::assert([], 'var')->int();
v::assert(5, 'var')->notInt();
```

#### numeric `Check if value is numeric`

```php
// OK
v::assert(15, 'var')->numeric();

// EXCEPTION
v::assert('*', 'var')->numeric();
```

#### isNull `Check if value is null`

* Antipode: **notNull**

```php
// OK
v::assert(null, 'var')->isNull();
v::assert('a', 'var')->notNull();

// EXCEPTION
v::assert('a', 'var')->isNull();
v::assert(null, 'var')->notNull();
```

#### string `Check if value is string`

* Antipode: **notString**

```php
// OK
v::assert('5', 'var')->string();
v::assert([], 'var')->notString();

// EXCEPTION
v::assert([], 'var')->string();
v::assert('-5', 'var')->notString();
```

#### resource `Check if value is resource`

* Antipode: **notResource**

```php
// OK
v::assert(tmpfile(), 'var')->resource();
v::assert(5, 'var')->notResource();

// EXCEPTION
v::assert(5, 'var')->resource();
v::assert(tmpfile(), 'var')->notResource();
```

-- --

Array validators
----------------

All array validators run previously:

* **isArray**

#### inArray($range) `Check if value is in array $range`

Arguments:

* `$range` MUST be array

```php
// OK
v::assert(['a'], 'var')->inArray(['a', 'b']);

// EXCEPTION
v::assert(['c'], 'var')->inArray(['a', 'b']);

// EXCEPTION: var MUST be array
v::assert('a', 'var')->inArray(['a', 'b']);

// EXCEPTION: $range MUST be array
v::assert(['a'], 'var')->inArray('a');
```

-- --

String validators
-----------------

All string validators run previously:

* **string**


#### digit `Check if value contains only digits`

```php
// OK
v::assert('5', 'var')->digit();

// EXCEPTION
v::assert('c', 'var')->digit();

// EXCEPTION: var MUST be string
v::assert(5, 'var')->digit();
```

#### match($pattern) `Check if value match RegExp pattern`

Arguments:

* `$pattern` MUST be correct RegExp pattern

```php
// OK
v::assert('a', 'var')->match('/a/');

// EXCEPTION
v::assert('b', 'var')->match('/a/');

// EXCEPTION: pattern MUST be not empty
v::assert('a', 'var')->match('');

// EXCEPTION: var MUST be string
v::assert(5, 'var')->match('/a/');

// EXCEPTION: pattern MUST be correct RegExp
v::assert('a', 'var')->match('/a');
```

#### glob($pattern) `Check if value match glob pattern`

```php
// OK
v::assert('aa', 'var')->glob('a*');

// EXCEPTION
v::assert('bb', 'var')->glob('a*');

// EXCEPTION: pattern MUST be not empty
v::assert('a', 'var')->glob('');

// EXCEPTION: pattern MUST be string
v::assert('a', 'var')->glob(false);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->glob('/a/');
```

#### length($length) `Check if value has length exactly $length`

Arguments:

* `$length` MUST be integer >= 0

```php
// OK
v::assert('aa', 'var')->length(2);

// EXCEPTION
v::assert('bb', 'var')->length(5);

// EXCEPTION: length MUST be int
v::assert('a', 'var')->length(null);

// EXCEPTION: length MUST be more >= 0
v::assert('a', 'var')->length(-2);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->length(1);
```

#### lengthLess($length) `Check if value has length less than $length`

* Antipode: **lengthMore**

Arguments:

* `$length` MUST be integer > 0

```php
// OK
v::assert('aa', 'var')->lengthLess(5);
v::assert('bb', 'var')->lengthMore(1);

// EXCEPTION
v::assert('bb', 'var')->lengthLess(1);
v::assert('aa', 'var')->lengthMore(5);

// ----------

// EXCEPTION: length MUST be int
v::assert('a', 'var')->lengthLess(null);
v::assert('a', 'var')->lengthMore(null);

// EXCEPTION: length MUST be more >= 0
v::assert('a', 'var')->lengthLess(-2);
v::assert('a', 'var')->lengthMore(-2);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->lengthLess(1);
v::assert([], 'var')->lengthMore(1);
```

#### lengthBetween($from, $to) `Check that value length is $from <= $value <= $to`

Arguments:

* `$from` MUST be integer >= 0
* `$to` MUST be integer >= 0
* `$from` MUST less than `$to`

```php
// OK
v::assert('aa', 'var')->lengthBetween(1, 5);

// EXCEPTION
v::assert('bb', 'var')->lengthBetween(3, 10);

// ----------

// EXCEPTION: form MUST be int
v::assert('a', 'var')->lengthBetween(null, 5);

// EXCEPTION: to MUST be int
v::assert('a', 'var')->lengthBetween(1, []);

// EXCEPTION: form MUST be more >= 0
v::assert('a', 'var')->lengthBetween(-2, 5);

// EXCEPTION: form MUST be more than to
v::assert('a', 'var')->lengthBetween(5, 1);

// EXCEPTION: var MUST be string
v::assert(5, 'var')->lengthBetween(1);
```

-- --

Number validators (int or float)
--------------------------------

All number validators run previously:

* **numeric**
* **notString**

#### positive `Check if value is positive (not 0)`

* Antipode: **negative** `Check if value is negative (not 0)`

```php
// OK
v::assert(1, 'var')->positive();
v::assert(-5, 'var')->negative();

// EXCEPTION
v::assert(-1, 'var')->positive();
v::assert(10, 'var')->positive();
v::assert(0, 'var')->negative();
v::assert(0, 'var')->negative();

// EXCEPTION: var MUST be int or float
v::assert('A', 'var')->positive();
v::assert([], 'var')->negative();
```

#### less($number) `Check if value is $value <= $number`

* Similar: **lessStrict** Check that value is `$value < $number`
* Antipode: **more** Check that value is `$value >= $number`
* Antipode: **moreStrict** Check that value is `$value > $number`

Arguments:

* `$number` MUST be integer or float

```php
// OK
v::assert(1, 'var')->less(2);
v::assert(10, 'var')->more(5);

// EXCEPTION
v::assert(10, 'var')->less(5);
v::assert(1, 'var')->more(2);

// EXCEPTION: length MUST be int or float
v::assert(1, 'var')->less(null);
v::assert(1, 'var')->more(null);

// EXCEPTION: var MUST be int or float
v::assert('A', 'var')->less(1);
v::assert([], 'var')->more(1);
```

#### between($from, $to) `Check that value is $from <= $value <= $to`

* Similar: **betweenStrict** Check that value is `$from < $value < $to`

Arguments:

* `$from` MUST be int or float
* `$to` MUST be int or float
* `$from` MUST less than `$to`

```php
// OK
v::assert(2, 'var')->between(1, 5);

// EXCEPTION
v::assert(2.5, 'var')->between(3, 10);

// ----------

// EXCEPTION: form MUST be int
v::assert(2, 'var')->between(null, 5);

// EXCEPTION: to MUST be int
v::assert(2, 'var')->between(1, []);

// EXCEPTION: form MUST be more than to
v::assert(2, 'var')->between(5, 1);

// EXCEPTION: var MUST be int or float
v::assert('A', 'var')->between(1);
```

-- --

CAST API
========

#### get `Returns value as is`

```php
// RETURN 'a'
v::assert('a', 'var')->get();
```

#### toBool `Converts any type to bool`

```php
// RETURN true
v::assert('a', 'var')->toBool()->get();
```

#### toFloat `Converts any type (except array) to float`

Run previously: **notArray**

```php
// RETURN 0.0
v::assert('a', 'var')->toFloat()->get();

// RETURN -15.2
v::assert('-15.2', 'var')->toFloat()->get();

// EXCEPTION: var MUST NOT be array
v::assert([], 'var')->toFloat()->get();
```

#### toInt `Converts any type (except array) to int`

Run previously: **notArray**

```php
// RETURN 0
v::assert('a', 'var')->toInt()->get();

// RETURN -15
v::assert('-15.2', 'var')->toInt()->get();

// EXCEPTION: var MUST NOT be array
v::assert([], 'var')->toInt()->get();
```

#### toString `Converts any type (except array) to string`

Run previously: **notArray**

```php
// RETURN ''
v::assert(false, 'var')->toString()->get();

// RETURN '-15'
v::assert(-15, 'var')->toString()->get();

// EXCEPTION: var MUST NOT be array
v::assert([], 'var')->toString()->get();
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
