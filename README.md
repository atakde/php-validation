# php-validation

A php package for validation.

## Installation

Install via composer

```bash 
composer require atakde/php-validation
```

## Usage

```php

require 'vendor/autoload.php';

use Atakde\PhpValidation\Validator;

$params = [
    'username' => 'TestUsername',
    'email' => 'me@atakann.com',
    'password' => '123'
];

$validateRules = [
    'email' => 'required|email',
    'username' => 'required|string|min:5|max:10',
    'password' => 'required|password'
];

$validator = new Validator();
$validator->validate($validateRules, $params);

var_dump($validator->fails());
var_dump($validator->getErrors());

```
