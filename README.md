php-validator
=====

[![Build Status](https://travis-ci.org/index0h/php-validator.svg)](https://travis-ci.org/index0h/php-validator) [![Dependency Status](https://gemnasium.com/index0h/php-validator.svg)](https://gemnasium.com/index0h/php-validator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/index0h/php-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/index0h/php-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master)

## Yet another validator, WHY??

One answer is **SPEED**

There many other cool validators, but for their user-friendly you must pay by time & memory of execution.
This validator gives you very simple and fast API. You can see benchmark results at bottom of [build logs](https://travis-ci.org/index0h/php-validator).

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

#### `index0h\validator\Variable`

There are two ways of using:

* `Variable::assert` - It'll throw exception on first validation fail
    - mixed `$value` - checking variable
    - string `$name` - name of checking variable
    - string `$exceptionClass` (\InvalidArgumentException) - user specific exception class name
* `Variable::validate` - It'll check run of validations
    - mixed `$value` - checking variable
    - string `$name` - name of checking variable
    - bool `$skipOnError` (true) - by default - all validations after fail will be skiped, if false - it'll run all
        validations

#### Example

```php
// Throws exception: Param $var must be graph
Variable::assert("\nvar\t", 'var')->notEmpty()->isString()->isGraph();

// Throws exception: Param $var must be empty
Variable::assert('notEmpty', 'var')->isEmpty();

// Return: -15
Variable::assert(-15, 'var')->isInt()->isNegative()->getValue();

// It's ok :)
Variable::assert([], 'var')->isEmpty()->isArray();

// Return: ['Param $var must be graph']
Variable::validate("\nvar\t", 'var')->notEmpty()->isString()->isGraph()->getErrors();

// Return: true, param $var must be not empty
Variable::validate('', 'var')->notEmpty()->hasErrors();
```

#### Available validators

 * `inArray(array)`
 * `notInArray(array)`

-- --
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

#### `index0h\validator\Cast`

Class for type conversion, extends Variable. By design these methods `MAY` be called already after `assert`, or
`validate` methods, after them you can call any validations.

* `Cast::toBool` - converts value to `bool` type or processing an error
* `Cast::toFloat` - converts value to `float` type or processing an error
    - bool `$allowEmpty` (true) - if value is empty and param is true - it'll cast `(float)0` else - process an error
* `Cast::toInt` - converts value to `int` type or processing an error
    - bool `$allowEmpty` (true) - if value is empty and param is true - it'll cast `0` else - process an error
* `Cast::toString` - converts value to `string` type or processing an error
    - bool `$allowEmpty` (true) - if value is empty and param is true - it'll cast `''` else - process an error

#### Example

```php
// Return: '5'
Cast::assert(5, 'var')->toString()->getValue();

// Return: -15
Cast::assert('-15.12', 'var')->toInt()->getValue();

// Throws exception: Param $var must be positive
Cast::assert('-15.12', 'var')->toInt()->isPositive();

// Return: ['Can not cast $var to string']
Cast::validate(['a', 'b', 'c'], 'var')->toString()->getErrors();
```

#### `index0h\validator\request\RequestInterface`

Interface declares methods to get and validate data from HTTP request

* `index0h\validator\request\Symfony` for [`Symfony\Component\HttpFoundation\Request`][symfony-request]
* `index0h\validator\request\Yii1` for [`CHttpRequest`][yii1-request]
* `index0h\validator\request\Simple` for `$_POST`, `$_GET`, or any user arrays

#### Example

```php
// Url is `https://localhost/?uid=100&ie=UTF-8&q=some+data+here`

use Symfony\Component\HttpFoundation\Request;
use index0h\validator\request\Symfony as Req;

$req = new Req(Request::createFromGlobals());

$userId = $req->toInt('uid', -1)->isPositive()->getValue();
$encoding = $req->toString('ie', 'UTF-8')->inArray(mb_list_encodings())->getValue();
$query = $req->toString('q')->getValue();

// -------------------------------------------------------------------
// This is the same as (many extra-checks dropped for current example)
// -------------------------------------------------------------------

use Symfony\Component\HttpFoundation\Request;

$req = Request::createFromGlobals();

$userId = $req->get('uid', -1);

if (!is_int($userId)) {
    if (is_numeric($this->value) && is_bool($this->value)) {
        $userId = (int)$userId;
    } else {
        throw new \InvalidArgumentException('Can not cast $userId to int');
    }
}

if ($userId < 0) {
    throw new \InvalidArgumentException('Param $userId must be positive');
}

$encoding = $req->get('ie', 'UTF-8');

if (!is_string($encoding)) {
    throw new \InvalidArgumentException('Param $encoding must be string');
}

if (!in_array($encoding, mb_list_encodings())) {
    throw new \InvalidArgumentException('Param $encoding out of range');
}

$query = $req->get('q', false);

if (empty($query)) {
    $query = '';
}

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
