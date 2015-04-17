php-validator
=====

[![Build Status](https://travis-ci.org/index0h/php-validator.svg)](https://travis-ci.org/index0h/php-validator) [![Dependency Status](https://gemnasium.com/index0h/php-validator.svg)](https://gemnasium.com/index0h/php-validator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/index0h/php-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/index0h/php-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master)

## Yet another validator, WHY??

One answer is **SPEED**

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

#### `index0h\validator\Variable`

* `Variable::assert` - It'll throw exception on first validation fail
    - mixed `$value` - checking variable
    - string `$name` - name of checking variable
    - string `$exceptionClass` (\InvalidArgumentException) - user specific exception class name

#### Example

```php
// Throws exception: Param $var must be empty
Variable::assert('notEmpty', 'var')->isEmpty();

// Return: -15
Variable::assert(-15, 'var')->isInt()->isNegative()->get();

// It's ok :)
Variable::assert([], 'var')->isEmpty()->isArray();
```

#### Available validators

 * `inArray($range)`
 * `notInArray($range)`
    - array `$range`

-- --
 * `isArray()`
 * `notArray()`

-- --
Both run only after internal check `isNumeric()` and `notString()`

 * `isBetween($from, $to)`
 * `isBetweenStrict($from, $to)`
 * `isNotBetween($from, $to)`
 * `isNotBetweenStrict($from, $to)`
    - int|float `$from`
    - int|float `$to`

-- --
 * `isBool()`
 * `isNotBool()`

-- --
 * `isDigit()`
 * `isNotDigit()`

-- --
 * `isFloat()`
 * `isNotFloat()`

-- --
 * `isEmpty()`
 * `isNotEmpty()`

-- --
 * `isInt()`
 * `isNotInt()`

-- --
Both run only after internal check `isNotEmpty()` and `isString()`

 * `isJson()`
 * `isNotJson()`

-- --
Both run only after internal check `isString()`

 * `isLengthBetween($from, $to)`
 * `isLengthNotBetween($from, $to)`
    - int|float `$from`
    - int|float `$to`

-- --
Both run only after internal check `isNotEmpty()` and `isString()`

 * `isLengthLess($maxLength)`
 * `isLengthLessStrict($maxLength)`
    - int `$maxLength`

-- --
Both run only after internal check `isString()`

 * `isLengthMore($minLength)`
 * `isLengthMoreStrict($minLength)`
    - int `$minLength`

-- --
 * `isNumeric()`
 * `isNotNumeric()`

-- --
Both run only after internal check `isNumeric()` and `isNotString()`

 * `isMore($min)`
 * `isMoreStrict($min)`
    - int|float `$min`

-- --
Both run only after internal check `isNumeric()` and `isNotString()`

 * `isLess($max)`
 * `isLessStrict($max)`
    - int|float `$max`

-- --
Both run only after internal check `isNumeric()` and `isNotString()`

 * `isPositive()`
 * `isNegative()`

-- --
 * `isResource()`
 * `isNotResource()`

-- --
 * `isString()`
 * `isNotString()`

#### Cast API

By design these methods `MAY` be called already after `assert`, after that you can call any validations.

* `Variable::toBool` - converts value to `bool` type or processing an error
    - float `$default` (false)
* `Variable::toFloat` - converts value to `float` type or processing an error
    - float `$default` (0.0)
* `Variable::toInt` - converts value to `int` type or processing an error
    - int `$default` (0)
* `Variable::toString` - converts value to `string` type or processing an error
    - string `$default` ('')

#### Example

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
