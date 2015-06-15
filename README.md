# Laravel e-commerce [![Build Status](https://travis-ci.org/ablunier/laravel-ecommerce.svg?branch=master)](https://travis-ci.org/ablunier/laravel-ecommerce)

### Features
* Full featured flexible e-commerce.
* Simple API.

### Requirements
* PHP 5.4 or higher.
* Laravel 5.

## Installation

Require this package in your `composer.json` and update composer:

```json
"ablunier/laravel-ecommerce": "dev-master"
```

After updating composer, add the ServiceProvider to the providers array in `config/app.php`:

```php
'ANavallaSuiza\Ecommerce\StoreServiceProvider',
```

To publish the config settings in Laravel 5 use:

```php
php artisan vendor:publish
```

## Documentation

Visit the [wiki](https://github.com/ablunier/laravel-ecommerce/wiki) for more information about understanding the core concepts and how to use this package.

## License

This software is published under the MIT License
