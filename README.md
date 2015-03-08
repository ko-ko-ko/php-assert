php-validator
=====

[![Build Status](https://travis-ci.org/index0h/php-validator.svg)](https://travis-ci.org/index0h/php-validator) [![Dependency Status](https://gemnasium.com/index0h/php-validator.svg)](https://gemnasium.com/index0h/php-validator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/index0h/php-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/index0h/php-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master)

## Yet another validator, WHY??

One answer is **SPEED**

There many other cool validators, but for their user-friendly you must pay by time & memory of execution.
This validator give very simple API and it's fast. You can see benchmark results at bottom of [build logs](https://travis-ci.org/index0h/php-validator).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```sh
php composer.phar require --prefer-dist index0h/validator *
```

or add line to require section of `composer.json`

```json
"index0h/validator": *
```

## Usage

```php
use index0h\validator\Variable as v;

v::assert($var, 'var')->notEmpty()->isString()->isGraph();

// It's the same as

if (empty($var)) {
    throw new \InvalidArgumentException('Param $var must be not empty');
}

if (!is_string($var)) {
    throw new \InvalidArgumentException('Param $var must be string');
}

if (!ctype_graph($var)) {
    throw new \InvalidArgumentException('Param $var must be graph');
}
```

#### There are two ways of using `index0h\validator\Variable`:

* `v::assert` - It'll throw exception on first validation fail
    - mixed `$value` - checking variable
    - string `$name` - name of checking variable
    - string `$exceptionClass` (\InvalidArgumentException) - user specific exception class name
* `v::validate` - It'll check run of validations
    - mixed `$value` - checking variable
    - string `$name` - name of checking variable
    - bool `$skipOnError` (true) - by default - all validations after fail will be skiped, if false - it'll run all validations

#### Available validators

 * `isArray()`
 * `notArray()`

-- --
 * `isBool()`
 * `notBool()`

-- --
  * `isCallable()`
  * `notCallable()`

-- --
 * `isDigit()`
 * `notDigit()`

-- --
  * `isFloat()`
  * `notFloat()`

-- --
 * `isEmail()`
 * `notEmail()`

-- --
 * `isEmpty()`
 * `notEmpty()`

-- --
 * `isGraph()`
 * `notGraph()`

-- --
 * `isInt()`
 * `notInt()`

-- --
Both run only after internal check `notEmpty()` and `isString()`

 * `isJson()`
 * `notJson()`

-- --
 * `isNumeric()`
 * `notNumeric()`

-- --
Both run only after internal check `notEmpty()` and `isString()`

 * `isMacAddress()`
 * `notMacAddress()`

-- --
 * `isObject()`
 * `notObject()`

-- --
Both run only after internal check `isNumeric()` and `notString()`

 * `isPositive()`
 * `isNegative()`

-- --
 * `isResource()`
 * `notResource()`

-- --
 * `isString()`
 * `notString()`


## Testing

#### Run tests from console

```sh
make test
```

#### Run benchmark from console

```sh
make benchmark
```
