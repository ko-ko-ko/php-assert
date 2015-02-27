php-validator
=====

[![Build Status](https://travis-ci.org/index0h/php-validator.svg)](https://travis-ci.org/index0h/php-validator) [![Dependency Status](https://gemnasium.com/index0h/php-validator.svg)](https://gemnasium.com/index0h/php-validator) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/index0h/php-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/index0h/php-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/index0h/php-validator/?branch=master)

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


## Testing

#### Run tests from IDE (example for PhpStorm)

- Select Run/Debug Configuration -> Edit Configurations
- Select Add New Configuration -> PHP Script
- Type:
    * File: /path/to/yii-phar/.test.php
    * Arguments run: run  --coverage --html
- OK

#### Run tests from console

```sh
make test
```
