# WARNING: STILL IN DEVELOPMENT - DO NOT USE YET

# Laravel Ecommerce Nova Tools, Resources and Fields

[![Latest Version on Packagist](https://img.shields.io/packagist/v/weble/laravel-ecommerce-nova.svg?style=flat-square)](https://packagist.org/packages/weble/laravel-ecommerce-nova)
![CircleCI branch](https://img.shields.io/circleci/project/github/weble/laravel-ecommerce-nova/master.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/weble/laravel-ecommerce-nova/master.svg?style=flat-square)](https://travis-ci.org/weble/laravel-ecommerce-nova)
[![Quality Score](https://img.shields.io/scrutinizer/g/weble/laravel-ecommerce-nova.svg?style=flat-square)](https://scrutinizer-ci.com/g/weble/laravel-ecommerce-nova)
[![Total Downloads](https://img.shields.io/packagist/dt/weble/laravel-ecommerce-nova.svg?style=flat-square)](https://packagist.org/packages/weble/laravel-ecommerce-nova)

Nova Tools for Laravel Ecommerce package.

Add a screenshot of the tool here.

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require weble/laravel-ecommerce-nova
```

Next up, you must register the tool within your Nova resource.

```php
// in app/Nova/Order.php

// ...

public function fields()
{
    return [
        // ...
        \Weble\LaravelEcommerceNova\ManageOrderTool::make($this->resource),
    ];
}
```

## Usage

Click on the "laravel-ecommerce-nova" menu item in your Nova app to see the tool provided by this package.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email daniele@weble.it instead of using the issue tracker.

## Credits

- [Weble](https://github.com/Weble)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
