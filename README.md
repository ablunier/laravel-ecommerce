# Laravel e-commerce [![Build Status](https://travis-ci.org/ablunier/laravel-ecommerce.svg?branch=master)](https://travis-ci.org/ablunier/laravel-ecommerce)

This package is a full featured e-commerce platform written for the Laravel PHP framework. It is designed to make programming commerce applications easier by making several assumptions about what most developers needs to get started.

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

To publish the config settings and migrations in Laravel 5 use:

```php
php artisan vendor:publish
```

## Documentation

Visit the [wiki](https://github.com/ablunier/laravel-ecommerce/wiki) for more information about understanding the core concepts and how to use this package.

## License

This software is published under the MIT License
