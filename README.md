php-assert
=====

[![][build-img]][build-url] [![][quality-img]][quality-url] [![][coverage-img]][coverage-url] [![][stable-img]][package-url] [![][license-img]][package-url]

[build-url]: https://travis-ci.org/ko-ko-ko/php-assert
[build-img]: https://travis-ci.org/ko-ko-ko/php-assert.svg
[quality-url]: https://scrutinizer-ci.com/g/ko-ko-ko/php-assert/?branch=master
[quality-img]: https://scrutinizer-ci.com/g/ko-ko-ko/php-assert/badges/quality-score.png?b=master
[coverage-url]: https://scrutinizer-ci.com/g/ko-ko-ko/php-assert/?branch=master
[coverage-img]: https://scrutinizer-ci.com/g/ko-ko-ko/php-assert/badges/coverage.png?b=master
[stable-img]: https://poser.pugx.org/ko-ko-ko/php-assert/license.png
[license-img]: https://poser.pugx.org/ko-ko-ko/php-assert/license.png
[package-url]: https://packagist.org/packages/ko-ko-ko/php-assert

## Yet another assert, WHY??

**It's really fast, ugly inside, but fast**

There are many other cool asserts, but for their user-friendly you must pay by time & memory of execution.
This assert gives you very simple and fast API. You can see benchmark results at bottom of [build logs][build-url].

![](logo.jpg)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```sh
php composer.phar require --prefer-dist ko-ko-ko/assert "0.2.x"
```

or add line to require section of `composer.json`

```json
"ko-ko-ko/assert": "0.2.x"
```

## Usage

```php
use KoKoKo\assert\Assert;

Assert::assert($var, 'var')->notEmpty()->string();

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
Assert::assert('', 'var')->isEmpty();
Assert::assert(5, 'var', '\LogicException');

// EXCEPTION: var MUST NOT be an object
Assert::assert(new stdClass(), 'var');

// EXCEPTION: exceptionClass MUST be \Exception, or it's child
Assert::assert(5, 'var', '\ArrayIterator');
```

#### getExceptionClass

Return name of exception class that will be thrown on validation fail

#### setExceptionClass($exceptionClass)

* `$exceptionClass` user specific exception class name. MUST be \Exception, or it's child


-- --

VALIDATION API
==============

General asserts
------------------

#### isEmpty `Check if value empty`

* Antipode: **notEmpty**

```php
// OK
Assert::assert('', 'var')->isEmpty();
Assert::assert('5', 'var')->notEmpty();

// EXCEPTION
Assert::assert('5', 'var')->isEmpty();
Assert::assert([], 'var')->notEmpty();
```

#### isArray `Check if value is array`

```php
// OK
Assert::assert([], 'var')->isArray();

// EXCEPTION
Assert::assert('5', 'var')->isArray();
```

#### bool `Check if value is bool`

```php
// OK
Assert::assert(false, 'var')->bool();

// EXCEPTION
Assert::assert('5', 'var')->bool();
```

#### float `Check if value is float`

```php
// OK
Assert::assert(15.2, 'var')->float();

// EXCEPTION
Assert::assert('15.2', 'var')->float();
Assert::assert([], 'var')->float();
```

#### int `Check if value is int`

```php
// OK
Assert::assert(15, 'var')->int();

// EXCEPTION
Assert::assert(15.2, 'var')->int();
Assert::assert([], 'var')->int();
```

#### numeric `Check if value is numeric`

```php
// OK
Assert::assert(15, 'var')->numeric();

// EXCEPTION
Assert::assert('*', 'var')->numeric();
```

#### isNull `Check if value is null`

* Antipode: **notNull**

```php
// OK
Assert::assert(null, 'var')->isNull();
Assert::assert('a', 'var')->notNull();

// EXCEPTION
Assert::assert('a', 'var')->isNull();
Assert::assert(null, 'var')->notNull();
```

#### string `Check if value is string`

```php
// OK
Assert::assert('5', 'var')->string();

// EXCEPTION
Assert::assert([], 'var')->string();
```

#### resource `Check if value is resource`

```php
// OK
Assert::assert(tmpfile(), 'var')->resource();

// EXCEPTION
Assert::assert(5, 'var')->resource();
```

-- --

Array asserts
----------------

All array asserts run previously:

* **isArray**

#### inArray($range) `Check if value is in array $range`

Arguments:

* `$range` MUST be array

```php
// OK
Assert::assert(['a'], 'var')->inArray(['a', 'b']);

// EXCEPTION
Assert::assert(['c'], 'var')->inArray(['a', 'b']);

// ----------

// EXCEPTION: var MUST be array
Assert::assert('a', 'var')->inArray(['a', 'b']);

// EXCEPTION: $range MUST be array
Assert::assert(['a'], 'var')->inArray('a');
```

-- --

String asserts
-----------------

All string asserts run previously:

* **string**


#### digit `Check if value contains only digits`

```php
// OK
Assert::assert('5', 'var')->digit();

// EXCEPTION
Assert::assert('c', 'var')->digit();

// ----------

// EXCEPTION: var MUST be string
Assert::assert(5, 'var')->digit();
```

#### match($pattern) `Check if value match RegExp pattern`

Arguments:

* `$pattern` MUST be correct RegExp pattern

```php
// OK
Assert::assert('a', 'var')->match('/a/');

// EXCEPTION
Assert::assert('b', 'var')->match('/a/');

// ----------

// EXCEPTION: pattern MUST be not empty
Assert::assert('a', 'var')->match('');

// EXCEPTION: var MUST be string
Assert::assert(5, 'var')->match('/a/');

// EXCEPTION: pattern MUST be correct RegExp
Assert::assert('a', 'var')->match('/a');
```

#### glob($pattern) `Check if value match glob pattern`

```php
// OK
Assert::assert('aa', 'var')->glob('a*');

// EXCEPTION
Assert::assert('bb', 'var')->glob('a*');

// ----------

// EXCEPTION: pattern MUST be not empty
Assert::assert('a', 'var')->glob('');

// EXCEPTION: pattern MUST be string
Assert::assert('a', 'var')->glob(false);

// EXCEPTION: var MUST be string
Assert::assert(5, 'var')->glob('/a/');
```

#### length($length) `Check if value has length exactly $length`

Arguments:

* `$length` MUST be integer >= 0

```php
// OK
Assert::assert('aa', 'var')->length(2);

// EXCEPTION
Assert::assert('bb', 'var')->length(5);

// ----------

// EXCEPTION: length MUST be int
Assert::assert('a', 'var')->length(null);

// EXCEPTION: length MUST be more >= 0
Assert::assert('a', 'var')->length(-2);

// EXCEPTION: var MUST be string
Assert::assert(5, 'var')->length(1);
```

#### lengthLess($length) `Check if value has length less than $length`

* Antipode: **lengthMore**

Arguments:

* `$length` MUST be integer > 0

```php
// OK
Assert::assert('aa', 'var')->lengthLess(5);
Assert::assert('bb', 'var')->lengthMore(1);

// EXCEPTION
Assert::assert('bb', 'var')->lengthLess(1);
Assert::assert('aa', 'var')->lengthMore(5);

// ----------

// EXCEPTION: length MUST be int
Assert::assert('a', 'var')->lengthLess(null);
Assert::assert('a', 'var')->lengthMore(null);

// EXCEPTION: length MUST be more >= 0
Assert::assert('a', 'var')->lengthLess(-2);
Assert::assert('a', 'var')->lengthMore(-2);

// EXCEPTION: var MUST be string
Assert::assert(5, 'var')->lengthLess(1);
Assert::assert([], 'var')->lengthMore(1);
```

#### lengthBetween($from, $to) `Check that value length is $from <= $value <= $to`

Arguments:

* `$from` MUST be integer >= 0
* `$to` MUST be integer >= 0
* `$from` MUST less than `$to`

```php
// OK
Assert::assert('aa', 'var')->lengthBetween(1, 5);

// EXCEPTION
Assert::assert('bb', 'var')->lengthBetween(3, 10);

// ----------

// EXCEPTION: form MUST be int
Assert::assert('a', 'var')->lengthBetween(null, 5);

// EXCEPTION: to MUST be int
Assert::assert('a', 'var')->lengthBetween(1, []);

// EXCEPTION: form MUST be more >= 0
Assert::assert('a', 'var')->lengthBetween(-2, 5);

// EXCEPTION: form MUST be more than to
Assert::assert('a', 'var')->lengthBetween(5, 1);

// EXCEPTION: var MUST be string
Assert::assert(5, 'var')->lengthBetween(1);
```

-- --

Number asserts (int or float)
--------------------------------

**All number MUST be int or float** 

#### positive `Check if value is positive (not 0)`

* Antipode: **negative** `Check if value is negative (not 0)`

```php
// OK
Assert::assert(1, 'var')->positive();
Assert::assert(-5, 'var')->negative();

// EXCEPTION
Assert::assert(-1, 'var')->positive();
Assert::assert(10, 'var')->positive();
Assert::assert(0, 'var')->negative();
Assert::assert(0, 'var')->negative();

// ----------

// EXCEPTION: var MUST be int or float
Assert::assert('A', 'var')->positive();
Assert::assert([], 'var')->negative();
```

#### less($number) `Check if value is $value <= $number`

* Similar: **lessStrict** Check that value is `$value < $number`
* Antipode: **more** Check that value is `$value >= $number`
* Antipode: **moreStrict** Check that value is `$value > $number`

Arguments:

* `$number` MUST be integer or float

```php
// OK
Assert::assert(1, 'var')->less(2);
Assert::assert(10, 'var')->more(5);

// EXCEPTION
Assert::assert(10, 'var')->less(5);
Assert::assert(1, 'var')->more(2);

// ----------

// EXCEPTION: length MUST be int or float
Assert::assert(1, 'var')->less(null);
Assert::assert(1, 'var')->more(null);

// EXCEPTION: var MUST be int or float
Assert::assert('A', 'var')->less(1);
Assert::assert([], 'var')->more(1);
```

#### between($from, $to) `Check that value is $from <= $value <= $to`

* Similar: **betweenStrict** Check that value is `$from < $value < $to`

Arguments:

* `$from` MUST be int or float
* `$to` MUST be int or float
* `$from` MUST less than `$to`

```php
// OK
Assert::assert(2, 'var')->between(1, 5);

// EXCEPTION
Assert::assert(2.5, 'var')->between(3, 10);

// ----------

// EXCEPTION: form MUST be int
Assert::assert(2, 'var')->between(null, 5);

// EXCEPTION: to MUST be int
Assert::assert(2, 'var')->between(1, []);

// EXCEPTION: form MUST be more than to
Assert::assert(2, 'var')->between(5, 1);

// EXCEPTION: var MUST be int or float
Assert::assert('A', 'var')->between(1);
```

-- --

CAST API
========

#### get `Returns value as is`

```php
// RETURN 'a'
Assert::assert('a', 'var')->get();
```

#### toBool `Converts any type to bool`

```php
// RETURN true
Assert::assert('a', 'var')->toBool()->get();
```

#### toFloat `Converts any type (except array) to float`

**Value MUST NOT be array**

```php
// RETURN 0.0
Assert::assert('a', 'var')->toFloat()->get();

// RETURN -15.2
Assert::assert('-15.2', 'var')->toFloat()->get();

// ----------

// EXCEPTION: var MUST NOT be array
Assert::assert([], 'var')->toFloat()->get();
```

#### toInt `Converts any type (except array) to int`

**Value MUST NOT be array**

```php
// RETURN 0
Assert::assert('a', 'var')->toInt()->get();

// RETURN -15
Assert::assert('-15.2', 'var')->toInt()->get();

// ----------

// EXCEPTION: var MUST NOT be array
Assert::assert([], 'var')->toInt()->get();
```

#### toString `Converts any type (except array) to string`

**Value MUST NOT be array**

```php
// RETURN ''
Assert::assert(false, 'var')->toString()->get();

// RETURN '-15'
Assert::assert(-15, 'var')->toString()->get();

// ----------

// EXCEPTION: var MUST NOT be array
Assert::assert([], 'var')->toString()->get();
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
